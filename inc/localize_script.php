<?php
/**
 *  Localize Script
 */

function localize_script() {
	if (!is_admin()) {
		global $wp_query;

		$id = $wp_query->queried_object_id;

		if(is_category() || is_tag() || is_tax()) {
			$type = get_taxonomy($wp_query->queried_object->taxonomy);
		} else {
			$type = get_post_type_object($wp_query->queried_object->post_type);
		}

		$request = new WP_REST_Request( 'GET', "/wp/v2/$type->rest_base/$id" );
		$response = rest_do_request( $request );
		$rest_post = $response->get_data();

		if( !is_singular() ) {
			foreach ($wp_query->posts as $k => $p) {
				$type = get_post_type_object($p->post_type);
				$request = new WP_REST_Request( 'GET', "/wp/v2/$type->rest_base/$p->ID" );
				$response = rest_do_request( $request );
				$rest_archive[] = $response->get_data();
			}
		}

    wp_localize_script( 'main', 'site', array(
      'nonce' => wp_create_nonce( 'wp_rest' ),
      'name'	=> get_bloginfo( 'name' ),
			'baseURL' => get_option( 'home' ),
			'home'	=> get_post_field( 'post_name', get_option( 'page_on_front' ) ),
			'blog'	=> get_post_field( 'post_name', get_option( 'page_for_posts' ) ),
			'post' => $rest_post,
			'archive' => $rest_archive
    ) );

	}
}
add_action( 'wp_enqueue_scripts', 'localize_script' );
