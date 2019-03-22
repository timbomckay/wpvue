<?php
/**
 *  Localize Script
 */

// TODO: Test Custom post_types


function localize_script() {
	if (!is_admin()) {
		global $wp_query;

		$rest_routes = [
			'taxonomies' => [
				'author' => 'users',
				'tag' => 'tags'
			]
		];

		// get rest_routes for post_types
		foreach (get_post_types() as $k => $type) {
			$t = get_post_type_object($type);

			if ($t->show_in_rest) {
				$rest_routes['post_types'][$k] = $t->rest_base;
			}
		}

		// get rest_routes for taxonomies
		foreach (get_taxonomies() as $k => $type) {
			$t = get_taxonomy($type);
			if ($t->show_in_rest) {
				$rest_routes['taxonomies'][$k] = $t->rest_base;
			}
		}

		// set route to post_type
		$route = $rest_routes['post_types'][$wp_query->queried_object->post_type];

		// if no route, assign to author or taxonomy
		if(!$route) {
			$route = is_author() ? 'users' : $rest_routes['taxonomies'][$wp_query->queried_object->taxonomy];
		}

		$request = new WP_REST_Request( 'GET', "/wp/v2/$route/$wp_query->queried_object_id" );
		$response = rest_do_request( $request );
		$rest_post = $response->get_data();

		if($rest_post['categories']) {
			foreach ($rest_post['categories'] as $categoryID) {
				$request = new WP_REST_Request( 'GET', "/wp/v2/categories/$categoryID" );
				$response = rest_do_request( $request );
				$rest_tax['categories'][$categoryID] = $response->get_data();
			}

			foreach ($rest_post['tags'] as $tagID) {
				$request = new WP_REST_Request( 'GET', "/wp/v2/tags/$tagID" );
				$response = rest_do_request( $request );
				$rest_tax['tags'][$tagID] = $response->get_data();
			}
		}

		$rest_archive = [
			'posts' => [],
			'page' => $wp_query->query['paged'] ? (int)$wp_query->query['paged'] : 1,
			'total' => (int)$wp_query->found_posts,
			'totalpages' => (int)$wp_query->max_num_pages
		];

		if( !is_singular() ) {
			foreach ($wp_query->posts as $k => $p) {
				$type = get_post_type_object($p->post_type);
				$request = new WP_REST_Request( 'GET', "/wp/v2/$type->rest_base/$p->ID" );
				$request->set_query_params([
				  '_fields' => 'title,id,link,type,excerpt,featured_image,modified'
				]);
				$response = rest_do_request( $request );
				$rest_archive['posts'][$k] = $response->get_data();
			}
		}

    wp_localize_script( 'main', 'site', array(
      'nonce' => wp_create_nonce( 'wp_rest' ),
      'name'	=> get_bloginfo( 'name' ),
			'description'	=> get_bloginfo( 'description' ),
			'baseURL' => get_option( 'home' ),
			'permalinks' => (object) [
				'base' => get_option( 'permalink_structure' ),
				'category' => get_option( 'category_base' ),
				'tag' => get_option( 'tag_base' ),
			],
			'home'	=> (object) [
				'id' => get_option( 'page_on_front' ),
				'slug' => get_post_field( 'post_name', get_option( 'page_on_front' ) )
			],
			'blog' => (object) [
				'id' => get_option( 'page_for_posts' ),
				'slug' => get_post_field( 'post_name', get_option( 'page_for_posts' ) )
			],
			'post' => $rest_post,
			'archive' => $rest_archive,
			'taxonomies' => $rest_tax,
			'rest_routes' => (object) $rest_routes
    ) );

	}
}
add_action( 'wp_enqueue_scripts', 'localize_script' );
