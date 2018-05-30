<?php

/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, and column width.
 */
add_editor_style( array( 'inc/editor.css' ) );

function base_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'mce_buttons_2', 'base_mce_buttons' );


/**
 * Add custom styles to the mce formats dropdown
 *
 * @url https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 */
function base_add_format_styles( $init_array ) {
	$style_formats = array(
		// Each array child is a format with it's own settings - add as many as you want
		array(
			'title'    => __( 'Button', 'text-domain' ), // Title for dropdown
			'selector' => 'a', // Element to target in editor
			'classes'  => 'button' // Class name used for CSS
		),
		// array(
		// 	'title'    => __( 'Highlight', 'text-domain' ), // Title for dropdown
		// 	'inline'   => 'span', // Wrap a span around the selected content
		// 	'classes'  => 'text-highlight' // Class name used for CSS
		// ),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'base_add_format_styles' );
