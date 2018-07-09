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

function reset_nav_class( $classes, $item ) {
  // classes to remove
  $removeClasses = [
    'current-menu-ancestor',
    'current-menu-parent',
    'current_page_ancestor',
    'current_page_parent',
    'current-menu-item',
    'current_page_item'
  ];

  foreach ($removeClasses as $key => $value) {
    if (($k = array_search($value, $classes)) !== false) {
      unset($classes[$k]);
    }
  }

  $classes[] = 'nav-item';

	return $classes;
}
add_filter( 'nav_menu_css_class', 'reset_nav_class', 10, 2 );

// Convert Menu Links to Vue Router
function walker_nav_menu_to_vue_router( $item_output, $item, $depth, $args ) {

  // get home_url to detect internal links
  $home_url = home_url();
  // convert output if item url is internal
  if ( strpos($item->url,$home_url) !== false ) {
    // change opening anchor tag to router-link
    $item_output = str_replace('<a ', '<router-link class="nav-link"', $item_output);
    // change closing anchor tag to router-link
    $item_output = str_replace('</a>', '</router-link>', $item_output);
    // change href to specify the link by passing the `to` prop
    $item_output = str_replace('href', 'to', $item_output);
    // remove base url
    $item_output = str_replace($home_url, '', $item_output);
    if(!strpos($item_output,'to="/"')){
      // remove trailing slash
      $item_output = str_replace('/"', '"', $item_output);
    }
  } else {
    // link is external, open in new tab
    $item_output = str_replace('<a href', '<a target="_new" href', $item_output);
  }

  return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'walker_nav_menu_to_vue_router', 10, 4 );
