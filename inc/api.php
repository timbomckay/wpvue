<?php
/**
 * ACF Data in Post Object Response
 */

$types = ['post', 'page'];

// Add elapsed time to articles
add_action( 'rest_api_init', function() use ($types) {

  register_rest_field( $types, 'featured_image', array(
		'get_callback'    => 'get_image_src',
		'update_callback' => null,
		'schema'          => null,
	));

  register_rest_field( $types, 'rest_base', array(
		'get_callback'    => 'wpvue_get_rest_base',
		'update_callback' => null,
		'schema'          => null,
	));

});

// Get featured image
function get_image_src( $object, $field_name, $request ) {

  foreach (['thumbnail','medium','medium_large','large','full'] as $size) {
    $img = wp_get_attachment_image_src( $object['featured_media'], $size, false );
    $feat_img_array[$size]['url'] = $img[0];
    $feat_img_array[$size]['width'] = $img[1];
    $feat_img_array[$size]['height'] = $img[2];
  }

	$feat_img_array['srcset'] = wp_get_attachment_image_srcset( $object['featured_media'] );
	$image = is_array( $feat_img_array ) ? $feat_img_array : false;
	return $image;
}

function wpvue_get_rest_base( $object, $field_name, $request ) {

  $response = get_post_type_object($object['post_type']);

	return $response->show_in_rest ? $response->rest_base : false;
}

$taxtypes = ['category', 'tag'];

// Add elapsed time to articles
add_action( 'rest_api_init', function() use ($taxtypes) {

  register_rest_field( $taxtypes, 'rest_base', array(
		'get_callback'    => 'wpvue_get_tax_rest_base',
		'update_callback' => null,
		'schema'          => null,
	));

});

function wpvue_get_tax_rest_base( $object, $field_name, $request ) {

  $response = get_taxonomy($object['taxonomy']);

	return $response->show_in_rest ? $response->rest_base : false;
}
