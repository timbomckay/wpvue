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
  // get blog slug to check url
  $blog_slug = get_post_field( 'post_name', get_option( 'page_for_posts' ) );

  // convert output if item url is internal
  $isIntertnal = strpos($item->url,$home_url) !== false;
  $isRelative = substr($item->url, 0, strlen("/")) === "/";

  if ( $isIntertnal || $isRelative ) {
    // remove home_url from links
    $link = str_replace($home_url, '', $item->url);

    $click = '';

    if($item->object === 'custom') {
      $store = "\"\$store.commit('postReplace', {})\"";
    } else {
      // pass ID to the store
      $store = "\"\$store.commit('postReplace', {id: $item->object_id, type: '$item->object'})\"";
    }

    $item_output = "<router-link class=\"nav-link\" to=\"$link\" @click.native=$store>$item->title</router-link>";
  } else {
    // link is external, open in new tab
    $item_output = str_replace('<a href', '<a target="_new" href', $item_output);
  }

  // echo '<pre>item_output: ';
  // print_r(htmlentities($item_output));
  // echo '</pre>';

  return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'walker_nav_menu_to_vue_router', 10, 4 );
