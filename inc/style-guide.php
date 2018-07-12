<?php

add_action( 'init', function () {
	// redirect all style-guide urls to archive tempalte, vue router will take over from there
  add_rewrite_rule( 'style-guide/([^/]+)/?$', 'index.php?post_type=style-guide', 'top' );

	register_post_type( 'style-guide', array(
    'labels' => array(
      'name' => __( 'Style Guide' ),
      'singular_name' => __( 'Style Guide' ),
      'all_items' => __( 'All Style Guide' ),
      'add_new' => __( 'Add New Style Guide' ),
      'add_new_item' => __( 'Add New Style Guide' ),
      'edit' => __( 'Edit Style Guide' ),
      'edit_item' => __( 'Edit Style Guide' ),
      'new_item' => __( 'New Style Guide' ),
      'view_item' => __( 'View Style Guide' ),
      'search_items' => __( 'Search Style Guide' ),
      'not_found' =>  __( 'Nothing found in the Database.' ),
      'not_found_in_trash' => __( 'Nothing found in Trash' ),
      'parent_item_colon' => ''
    ), /* end of arrays */
    'description' => __( 'This is the Style Guide post type' ),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'query_var' => true,
    'menu_icon' => 'dashicons-sos',
    'rewrite'	=> array( 'slug' => 'style-guide', 'with_front' => false ),
    'has_archive' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array( 'title', 'thumbnail', 'revisions')
  ) );

	/*
	  Add Style-Guide Custom Post Type to REST API
	 */

	global $wp_post_types;

	$wp_post_types['style-guide']->show_in_rest = true;
	$wp_post_types['style-guide']->rest_base = 'style-guide';
	$wp_post_types['style-guide']->rest_controller_class = 'WP_REST_Posts_Controller';

} );
