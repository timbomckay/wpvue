<?php
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
    acf_update_setting('google_api_key', 'PASTE_KEY_HERE');
  }

  add_action('acf/init', 'base_acf_init');
