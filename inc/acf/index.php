<?php
/**
 * Register Advanced Custom Fields
 */

if( function_exists('acf_add_local_field_group') ):

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


  /**
   * ACF Google Map
   *
   * It may be necessary to register a Google API key in order to
   * allow the Google API to load correctly
   *
   * @link Google API Key - https://developers.google.com/maps/documentation/javascript/get-api-key
   *
   * @link ACF Map - https://www.advancedcustomfields.com/resources/google-map/
   *
   */

    function base_acf_init() {
      acf_update_setting('google_api_key', 'AIzaSyCjrZe1rylwzXJ49QhPfkr9R4DtdlWThao');
    }

    add_action('acf/init', 'base_acf_init');

  /**
   * Import ACF Files
   */

    require 'restapi.php';
    require 'styles.php';

endif;
