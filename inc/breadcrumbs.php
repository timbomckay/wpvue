<?php

/**
 * Adapted from http://thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 * @param bool $showhome should the breadcrumb be shown when on homepage (only one deactivated entry for home).
 * @param bool $separatorclass should a separator class be added (in case :before is not an option).
 */

if ( ! function_exists( 'base_breadcrumb' ) ) {
    function base_breadcrumb( $showhome = true, $separatorclass = false ) {

        // Settings
        $separator  = '&gt;';
        $id         = 'breadcrumbs';
        $class      = 'breadcrumbs';
        $home_title = 'Homepage';

        // Get the query & post information
        global $post,$wp_query;
        $category = get_the_category();

        // Build the breadcrums
        echo '<ul id="' . $id . '" class="' . $class . '">';

        // Do not display on the homepage
        if ( ! is_front_page() ) {

            // Home page
            echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
            if ( $separatorclass ) {
                echo '<li class="separator separator-home"> ' . $separator . ' </li>';
            }

            if ( is_single() ) {

                // Single post (Only display the first category)
                echo '<li class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a class="bread-cat bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '" href="' . get_category_link($category[0]->term_id) . '" title="' . $category[0]->cat_name . '">' . $category[0]->cat_name . '</a></li>';
                if ( $separatorclass ) {
                    echo '<li class="separator separator-' . $category[0]->term_id . '"> ' . $separator . ' </li>';
                }
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            } else if ( is_category() ) {

                // Category page
                echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';

            } else if ( is_page() ) {

                // Standard page
                if ( $post->post_parent ) {

                    // If child page, get parents
                    $anc = get_post_ancestors( $post->ID );

                    // Get parents in the right order
                    $anc = array_reverse( $anc );

                    // Parent page loop
                    $parents = '';
                    foreach ( $anc as $ancestor ) {
                        $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                        if ( $separatorclass ) {
                            $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                        }
                    }

                    // Display parent pages
                    echo $parents;

                    // Current page
                    echo '<li class="current item-' . $post->ID . '">' . get_the_title() . '</li>';

                } else {

                    // Just display current page if not parents
                    echo '<li class="current item-' . $post->ID . '"> ' . get_the_title() . '</li>';

                }
            } else if ( is_tag() ) {

                // Tag page
                // Get tag information
                $term_id = get_query_var('tag_id');
                $taxonomy = 'post_tag';
                $args = 'include=' . $term_id;
                $terms = get_terms($taxonomy, $args);

                // Display the tag name
                echo '<li class="current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</li>';

            } elseif ( is_day() ) {

                // Day archive
                // Year link
                echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                if ( $separatorclass ) {
                    echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                }

                // Month link
                echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
                if ( $separatorclass ) {
                    echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
                }

                // Day display
                echo '<li class="current item-' . get_the_time('j') . '">' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</li>';

            } else if ( is_month() ) {

                // Month Archive
                // Year link
                echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                if ( $separatorclass ) {
                    echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                }

                // Month display
                echo '<li class="item-month item-month-' . get_the_time('m') . '">' . get_the_time('M') . ' Archives</li>';

            } else if ( is_year() ) {

                // Display year archive
                echo '<li class="current item-current-' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</li>';

            } else if ( is_author() ) {

                // Auhor archive
                // Get the author information
                global $author;
                $userdata = get_userdata($author);

                // Display author name
                echo '<li class="current item-current-' . $userdata->user_nicename . '">Author: ' . $userdata->display_name . '</li>';

            } else if ( get_query_var('paged') ) {

                // Paginated archives
                echo '<li class="current item-current-' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</li>';

            } else if ( is_search() ) {

                // Search results page
                echo '<li class="current item-current-' . get_search_query() . '">Search results for: ' . get_search_query() . '</li>';

            } elseif ( is_404() ) {

                // 404 page
                echo '<li>Error 404</li>';
            }
        } else {
            if ( $showhome ) {
                echo '<li class="item-home current">' . $home_title . '</li>';
            }
        }
        echo '</ul>';
    }
}
?>
