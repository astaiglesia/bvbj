<?php
// Post Types, taxonomies, more
require_once( 'lib/class-init.php' );
new ThemeInit();

// Advanced Custom Field plugin.
require_once( 'lib/acf.php' );
require_once( 'lib/acf-block-registration.php' );
// // Enqueue scripts and styles.
require_once( 'lib/enqueue-scripts.php' );
// Register theme support for title tag, etc.
require_once( 'lib/theme-support.php' );
// Register menu locations to be used by Appearance > Menus.
require_once( 'lib/menus.php' );
// Clean up some WP stuff we don't want or need.
require_once( 'lib/cleanup.php' );
// Load component lib.
require_once( 'lib/components.php' );
// Load media lib.
require_once( 'lib/media.php' );
// Admin functions & modifications.
require_once( 'lib/admin.php' );
// Add handler for cURL requests and other wp-rest tasks
require_once( 'lib/rest-routes.php' );
// add svg support
require_once( 'lib/svg-support.php');
// additional functions for wp templates, etc.
require_once( 'lib/template-helpers.php');
// Add walkers for the main nav
require_once( 'lib/nav/nav-drawer.php' );
require_once( 'lib/nav/nav-menu.php' );
// add shortcodes
require_once( 'lib/shortcodes.php' );
// wp content editor
require_once( 'lib/admin-editor.php' );
// add a subdirectory for page templates
require_once( 'lib/page-template-subdirectory.php' );

/**
 * Allow WHERE clauses to access ACF repeater fields.
 */
function insight_replace_repeater_field( $where ) {
  $where = str_replace("meta_key = 'verticals_$'", "meta_key LIKE 'verticals_%_vertical'", $where );
  $where = str_replace("meta_key = 'regions_$'", "meta_key LIKE 'regions_%_region'", $where );
  return $where;
}
add_filter( 'posts_where', 'insight_replace_repeater_field' );