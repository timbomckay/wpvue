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

  $page_map = ['slug', 'parent', 'grand', 'great', 'ancestor'];
  $post_map = ['slug', 'taxonomy'];

  // convert output if item url is internal
  if ( (strpos($item->url,$home_url) !== false) || (substr($item->url, 0, strlen("/")) === "/") ) {
    // <router-link :to="{ name: 'page', params: { slug: 'test', id: 123 }}">Page</router-link>

    // remove home_url from links
    $url = str_replace($home_url, '', $item->url);
    $path = array_reverse(array_filter(explode('/', $url)));

    switch ($item->object) {
      case 'page':
        $name = $item->object;

        if (!$path[0]) {
          $name = 'home';
        } elseif ($path[0] === $blog_slug) {
          $name = 'blog';
        }

        // reassign keys to router map
        foreach ($path as $k => $v) {
          if (is_int($k)) {
            $path[$page_map[$k]] = $v;
          }
          unset($path[$k]);
        }

        // assign ID to path parameters
        $path['id'] = $item->object_id;

        // stringify the object
        $params = str_replace('"', "'", json_encode((object)$path));

        // assign link
        $link = ":to=\"{ name: '$name', params: $params}\"";

        break;

      case 'post':

        // reassign keys to router map
        foreach ($path as $k => $v) {
          if (is_int($k)) {
            $path[$page_map[$k]] = $v;
          }
          unset($path[$k]);
        }

        // assign ID to path parameters
        $path['id'] = $item->object_id;

        // stringify the object
        $params = str_replace('"', "'", json_encode((object)$path));

        // assign link
        $link = ":to=\"{ name: 'post', params: $params}\"";

        break;

      default:
        // assign link
        $link = "to=\"$url\"";
        break;
    }

    $item_output = "<router-link class=\"nav-link\" $link>$item->title</router-link>";

    echo '<pre>';
    print_r([
      // 'args' => $args,
      'path' => $path['slug'],
      'item' => [
        'object' => $item->object,
        'type' => $item->type,
        'title' => $item->title,
        'url' => $item->url
      ],
      'pathParams' => isset($params) ? $params : false,
      'item_output' => htmlentities($item_output)
    ]);
    echo '</pre>';

  } else {
    // link is external, open in new tab
    $item_output = str_replace('<a href', '<a target="_new" href', $item_output);
  }

  return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'walker_nav_menu_to_vue_router', 10, 4 );
