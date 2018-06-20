<?php

// Flush rewrite rules for custom post types
function base_flush_rewrite_rules() { flush_rewrite_rules(); }
add_action( 'after_switch_theme', 'base_flush_rewrite_rules' );

// https://codex.wordpress.org/Function_Reference/register_post_type

function new_post_type($pt_plural, $pt_singular = null, $pt_slug = null, $icon = 'dashicons-edit', $args = null) {

	if($pt_singular === null) {
		$pt_singular = $pt_plural;
	}

  if($pt_slug === null) {
		$pt_slug = strtolower(str_replace(' ', '_', $pt_plural));
	}

  $default = array(
    'labels' => array(
      'name' => __( $pt_plural, 'base' ),
      'singular_name' => __( $pt_singular, 'base' ),
      'all_items' => __( 'All '.$pt_plural, 'base' ),
      'add_new' => __( 'Add New '.$pt_singular, 'base' ),
      'add_new_item' => __( 'Add New '.$pt_singular, 'base' ),
      'edit' => __( 'Edit '.$pt_singular, 'base' ),
      'edit_item' => __( 'Edit '.$pt_singular, 'base' ),
      'new_item' => __( 'New '.$pt_singular, 'base' ),
      'view_item' => __( 'View '.$pt_singular, 'base' ),
      'search_items' => __( 'Search '.$pt_plural, 'base' ),
      'not_found' =>  __( 'Nothing found in the Database.', 'base' ),
      'not_found_in_trash' => __( 'Nothing found in Trash', 'base' ),
      'parent_item_colon' => ''
    ), /* end of arrays */
    'description' => __( 'This is the '.$pt_singular.' post type', 'base' ),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'query_var' => true,
    'menu_icon' => $icon,
    'rewrite'	=> array( 'slug' => $pt_slug, 'with_front' => false ),
    'has_archive' => false,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array( 'title', 'thumbnail', 'revisions')
  );

  $settings = $args ? array_merge($default, $args) : $default;

	register_post_type( $pt_slug, $settings );

}

function custom_posts() {

  new_post_type('Style Guide', 'Style Guide', 'style-guide', 'dashicons-sos', array(
    'has_archive' => true,
    'exclude_from_search' => true
  ));

}

add_action( 'init', 'custom_posts' );

add_action( 'init', function() {
  // redirect all style-guide urls to archive tempalte, vue router will take over from there
  add_rewrite_rule( 'style-guide/([^/]+)/?$', 'index.php?post_type=style-guide', 'top' );
} );

/*
  Add Custom Post Types to REST API
 */
// function add_cpt_rest() {
//     global $wp_post_types;
//
// 		$cptPosts = ['case-studies', 'team', 'testimonials'];
//
// 		foreach ($cptPosts as $posttype) {
// 			$wp_post_types[$posttype]->show_in_rest = true;
// 	    $wp_post_types[$posttype]->rest_base = $posttype;
// 	    $wp_post_types[$posttype]->rest_controller_class = 'WP_REST_Posts_Controller';
// 		}
//
// }
// add_action( 'init', 'add_cpt_rest', 30 );

?>
