<?php
/**
 * Base Theme Customizer.
 *
 * @package Base
 */

 /*
   A good tutorial for creating your own Sections, Controls and Settings:
   http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

   Good articles on modifying the default options:
   http://natko.com/changing-default-wordpress-theme-customization-api-sections/
   http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

 */
function base_customize_register( $wp_customize ) {

  /*
    TODO - Add Color for theme color
  */

	/* Uncomment the below lines to remove the default customize sections */

  // $wp_customize->remove_section('title_tagline');
  $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );

}
add_action( 'customize_register', 'base_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function base_customize_preview_js() {
	wp_enqueue_script( 'base_customizer', get_theme_file_uri( '/assets/js/customizer.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'base_customize_preview_js' );
