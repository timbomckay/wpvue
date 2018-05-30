<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package WordPress
 */

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'base' ),
) );


/**
 * Elaborate menu system : https://github.com/olefredrik/FoundationPress/blob/master/library/navigation.php
 */

/**
 * A fallback when no navigation is selected by default.
 */

if ( ! function_exists( 'base_menu_fallback' ) ) :
function base_menu_fallback() {
	echo '<div class="alert-box secondary">';
	// Translators 1: Link to Menus, 2: Link to Customize.
		printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'base' ),
			sprintf(  __( '<a href="%s">Menus</a>', 'base' ),
				get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			sprintf(  __( '<a href="%s">Customize</a>', 'base' ),
				get_admin_url( get_current_blog_id(), 'customize.php' )
			)
		);
		echo '</div>';
}
endif;

// Add Foundation 'active' class for the current menu item.
if ( ! function_exists( 'base_active_nav_class' ) ) :
function base_active_nav_class( $classes, $item ) {
	if ( 1 == $item->current || true == $item->current_item_ancestor ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'base_active_nav_class', 10, 2 );
endif;

?>
