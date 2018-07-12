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
    $ver = (!defined('LOCAL_DEV')) ? $theme->get('Version') : time();

    // if local
    if ( defined('LOCAL_DEV') && LOCAL_DEV ) {
      // if webpack-dev-server is running
      if( @get_headers('http://localhost:8080/' . $theme->get('TextDomain')) ) {
        // Set path to webpack-dev-server
        $path = 'http://localhost:8080/' . $theme->get('TextDomain') . '/dist';
      } else if (!is_dir(get_template_directory() . '/dist')) {
				// local environment missing dist folder
				// create alert
        add_action('wp_footer', function(){
	        echo '<pre style="background-color:red;padding:1rem;color:white;font-weight:bold;position:fixed;right:1rem;top:1rem;margin:0;">Missing <i>"dist"</i> directory</pre>';
	      });
      }
    }

    // Enqueue the main Stylesheet
		wp_enqueue_style( 'main', $path . '/main.css', array(), $ver, 'all' );
    // Enqueue the main js
		wp_enqueue_script( 'main', $path . '/main.js', array(), $ver, true );

		// Deregister the jQuery version bundled with WordPress
		// Register a newer version if project requires jQuery
		wp_deregister_script( 'jquery' );

    wp_localize_script( 'main', 'site', array(
      'nonce' => wp_create_nonce( 'wp_rest' ),
      'name'	=> get_bloginfo( 'name' ),
			'baseURL' => get_option( 'home' ),
			'home'	=> get_post_field( 'post_name', get_option( 'page_on_front' ) ),
			'blog'	=> get_post_field( 'post_name', get_option( 'page_for_posts' ) ),
      'query'	=> ($p = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() )) ? $p : $GLOBALS['wp_the_query']->posts
    ) );

	}
}
add_action( 'wp_enqueue_scripts', 'base_scripts' );
