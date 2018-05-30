<?php

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/inc/admin.css');
}

add_action('admin_enqueue_scripts', 'admin_style');

/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/inc/login.css', false );
}

// changing the logo link from wordpress.org to your site
function login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'login_css', 10 );
add_filter( 'login_headerurl', 'login_url' );
add_filter( 'login_headertitle', 'login_title' );

?>
