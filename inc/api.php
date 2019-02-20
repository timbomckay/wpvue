<?php
/**
 * ACF Data in Post Object Response
 */

// get post_types
foreach (get_post_types() as $k => $type) {
  $t = get_post_type_object($type);
  if ($t->show_in_rest) {
    $types[] = $type;
  }
}

// Add elapsed time to articles
add_action( 'rest_api_init', function() use ($types) {

  register_rest_field( $types, 'featured_image', array(
		'get_callback'    => 'get_image_src',
		'update_callback' => null,
		'schema'          => null,
	));

});

// Get featured image
function get_image_src( $object, $field_name, $request ) {
  if ($post_thumbnail_id = get_post_thumbnail_id( $post_id )) {
    foreach (['thumbnail','medium','medium_large','large','full'] as $size) {
      $img = wp_get_attachment_image_src( $post_thumbnail_id, $size, false );
      $feat_img_array[$size] = [
        'url' => $img[0],
        'width' => $img[1],
        'height' => $img[2]
      ];
    }

  	$feat_img_array['srcset'] = wp_get_attachment_image_srcset( $object[$field_name] );

  	return $feat_img_array;
  }

  return false;
}
