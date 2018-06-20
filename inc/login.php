<?php /************* CUSTOM LOGIN PAGE *****************/

// calling our own login css for custom styling
// http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/inc/login.css', false );
}

// changing the logo link from wordpress.org to this site
function login_url() {  return home_url(); }

// changing the alt text on the logo to show the site name
function login_title() { return get_option( 'blogname' ); }

// only calling on the login page
add_action( 'login_enqueue_scripts', 'login_css', 10 );
add_filter( 'login_headerurl', 'login_url' );
add_filter( 'login_headertitle', 'login_title' );
