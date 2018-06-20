<?php

/* Import styling for ACF fields */
require 'styles.php';

/**
 * Set Up JSON Syncing
 */

add_filter('acf/settings/save_json', 'base_acf_json_save_point');

function base_acf_json_save_point( $path ) {
  // update path
  $path = get_stylesheet_directory() . '/inc/acf/json-sync';
  // return
  return $path;
}

add_filter('acf/settings/load_json', 'base_acf_json_load_point');

function base_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  $paths[] = get_stylesheet_directory() . '/inc/acf/json-sync';
  // return
  return $paths;
}

/* import google-maps key for ACF */
// require `google-maps.php`; // uncomment when key is provided

/* Import ACF Specific REST API endpoints */
require 'restapi.php';
