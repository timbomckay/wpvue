<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 */

/** Enqueue scripts and styles */
function base_scripts() {

	if (!is_admin()) {
    // get wp theme info from style.css
    $theme = wp_get_theme();
    // set default asset path
    $path = get_template_directory_uri() . '/dist';
    /** Cache busting **/
    // Use theme version number on production
    // Use time for version number everywhere else to never cache
    $ver = (function_exists('is_wpe') && is_wpe()) ? $theme->get('Version') : time();

    // if local
    if( !function_exists('is_wpe') ) {
      // if webpack-dev-server is running
      if( @get_headers('http://localhost:8080/') ) {
        // Set path to webpack-dev-server
        // $path = 'http://localhost:8080/' . $theme->get('TextDomain') . '/dist'; // this isn't working with HMR for some reason
        $path = 'http://localhost:8080/' . 'dist';
      } else if (!is_dir(get_template_directory() . '/dist')) {
        // local environment missing dist folder
        echo '<pre style="background-color:red;padding:1rem;color:white;font-weight:bold;position:fixed;right:1rem;top:1rem;margin:0;">Missing <i>"dist"</i> directory</pre>';
      }
    }

    // Enqueue the main Stylesheet
		wp_enqueue_style( 'main', $path . '/main.css', array(), $ver, 'all' );
    // Enqueue the main js
		wp_enqueue_script( 'main', $path . '/main.js', array(), $ver, true );

    if(is_archive('style-guide')) {
      // Enqueue the main Stylesheet
  		wp_enqueue_style( 'style-guide', $path . '/style-guide.css', array(), $ver, 'all' );
      // Enqueue the main js
  		wp_enqueue_script( 'style-guide', $path . '/style-guide.js', array(), $ver, true );
      // https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js
    }

		// Google Fonts
		wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700|Roboto:400,400i');

		// Deregister the jquery version bundled with WordPress.
		// We don't use jQuery anymore
		wp_deregister_script( 'jquery' );

    wp_localize_script( 'main', 'tmhu', array(
      // 'nonce'     => wp_create_nonce( 'wp_rest' ),
      'query' => ($p = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() )) ? $p : $GLOBALS['wp_the_query']->posts
    ) );

	}
}
add_action( 'wp_enqueue_scripts', 'base_scripts' );

?>
