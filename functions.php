<?php

/** Various clean up functions */
require 'inc/cleanup.php';

/** Add theme support */
require 'inc/theme-support.php';

/** Include Custom Post Types */
require 'inc/custom-post-types.php';

/** Register all menus */
require 'inc/menus.php';

/** Enqueue scripts */
require 'inc/enqueue-scripts.php';

/** Add Images */
require 'inc/images.php';

/** Include admin styling */
require 'inc/admin.php';

/** Include login styling */
require 'inc/login.php';

/** Include editor styling */
require 'inc/editor.php';

/** Create widget areas in sidebar and footer */
require 'inc/widget-areas.php';

/** Favicon tags **/
require 'inc/favicon.php';

/** Include ACF */
if( function_exists('acf_add_local_field_group') ):
  require 'inc/acf/index.php';
endif;
