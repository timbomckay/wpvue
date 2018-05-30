<?php
/**
 * ACF Data in Post Object Response
 */

$types = ['post', 'page', 'case-studies', 'team', 'testimonials', 'service-categories'];

// Add elapsed time to articles
add_action( 'rest_api_init', function() use ($types) {

  // all non-model post types
  register_rest_field( $types, 'acf', array(
    'get_callback' => function( $data ) use ($types) {

      if ($data['taxonomy']) {
        $result = get_fields($data['taxonomy'].'_'.$data['id']);
      } else {
        // get all fields
        $result = get_fields();
      }

      if($result) {

        array_walk_recursive( $result, 'deepIncludeACFFields', $types );

      }

      return $result;
    },
  ));

  register_rest_field( $types, 'featuredmedia', array(
    'get_callback' => function( $data ) {
      // get variety of sizes
      foreach (['thumbnail','medium','medium_large','large','full'] as $size) {
        $images[$size] = get_the_post_thumbnail_url( $data['id'], $size );
      }
      return $images;
    },
  ));

  // specific responses
  register_rest_field( 'page', 'acf', array(
    'get_callback' => function( $data ) {

      $fields = ['hero', 'bumper'];

      foreach ($fields as $field) {
        $result[$field] = get_field($field);
      }

      return $result;
    }
  ));

});

function deepIncludeACFFields( &$item, $key, $postTypes ) {

  // get fields from taxonomy
  if( isset( $item->taxonomy ) ) {

    $fields = get_fields($item->taxonomy . '_' . $item->term_id );

    $item->acf = $fields;

  }

  // get youtube data from video
  // Time Impact : Substantial
  if($key === 'video'){

    // use preg_match to find iframe src
    preg_match('/src="(.+?)"/', $item, $matches);

    if( empty($matches) ) {
      $item = false;
    } else {
      $src = $matches[1];

      // get video id
      preg_match('/embed(.*?)?feature/', $src, $matches_id );
      $id = $matches_id[1];
      $id = str_replace( str_split( '?/' ), '', $id );

      // get json data
      $data = file_get_contents('https://www.youtube.com/oembed?url=http://youtube.com/watch?v='. $id .'&format=json');
      $json = json_decode($data);

      $json->id = $id;

      $json->thumbnails = (object)[
        'default' => 'https://i.ytimg.com/vi/'.$id.'/default.jpg',
        'hq' => 'https://i.ytimg.com/vi/'.$id.'/hqdefault.jpg',
        'medium' => 'https://i.ytimg.com/vi/'.$id.'/mqdefault.jpg',
        'standard' => 'https://i.ytimg.com/vi/'.$id.'/sddefault.jpg',
        'max' => 'https://img.youtube.com/vi/'.$id.'/maxresdefault.jpg'
      ];

      $item = $json;
    }

  }

  // get info attached to nested post
  if ( isset( $item->post_type ) && in_array( $item->post_type, $postTypes ) ) {

    // add post permalink to response
    $item->link = get_permalink($item->ID);

    switch ($item->post_type) {
      case 'page':
        foreach (['hero', 'bumper'] as $field) {
          $array[$field] = get_field($field, $item->ID);
        }
        break;
      default:
        // get all fields for other non-declared post-types
        $fields = get_fields( $item->ID );
        if($fields) {
          foreach ($fields as $k => $value) {
            $array[$k] = $value;
          }
        }
        break;
    }

    $item->acf = $array;

    // get post thumbnail url
    foreach (['thumbnail','medium','medium_large','large','full'] as $size) {
      $images[$size] = get_the_post_thumbnail_url( $item->ID, $size );
    }

    $item->featuredmedia = $images;

  }

}

function get_post_fields( $data ) {

  $id = $data->get_param('id');
  $fields = explode('|', $data->get_param('fields'));

  foreach ($fields as $field) {
    $result[$field] = get_field($field, $id);
  }

  $types = ['post', 'page', 'case-studies', 'team', 'testimonials', 'service-categories'];

  if($result) {
    array_walk_recursive( $result, 'deepIncludeACFFields', $types );
  }

  return $result;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'tmhu/v1', '/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_post_fields',
  ) );
} );
