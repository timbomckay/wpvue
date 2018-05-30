<?php
/**
 * Base functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Base
 */

/** Various clean up functions */
require 'inc/cleanup.php';

/** Include Custom Post Types */
require 'inc/custom-post-types.php';

/** Implement the Custom Header feature */
require 'inc/custom-header.php';

/** Custom template tags for this theme */
require 'inc/template-tags.php';

/** Customizer additions */
require 'inc/customizer.php';

/** Reworking Pagination */
require 'inc/pagination.php';

/** Reworking Comments */
require 'inc/comments.php';

/** Register all menus */
require 'inc/menus.php';

/** Breadcrumbs function */
require 'inc/breadcrumbs.php';

/** Create widget areas in sidebar and footer */
require 'inc/widget-areas.php';

/** Enqueue scripts */
require 'inc/enqueue-scripts.php';

/** Add Images */
require 'inc/images.php';

/** Add theme support */
require 'inc/theme-support.php';

/** Include admin styling */
require 'inc/admin.php';

/** Include editor styling */
require 'inc/editor.php';

/** Custom functions that act independently of the theme templates */
require 'inc/extras.php';

require 'inc/favicon.php';

/** Include ACF */
require 'inc/acf/index.php';
