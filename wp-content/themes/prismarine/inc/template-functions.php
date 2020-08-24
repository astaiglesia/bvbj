<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bvbj
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bvbj_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'bvbj_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bvbj_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bvbj_pingback_header' );

/**
* WYSIWG Editor Advanced Toolbar Always On
* @param string $Options
* @return callback tiny_mce_before_init
**/
add_filter( 'tiny_mce_before_init', function($in) {
	// customize the buttons
	$in['theme_advanced_buttons1'] = 'bold,italic,underline,bullist,numlist,hr,blockquote,link,unlink,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent';
	$in['theme_advanced_buttons2'] = 'formatselect,pastetext,pasteword,charmap,undo,redo';

	// Keep the "kitchen sink" open
	$in[ 'wordpress_adv_hidden' ] = FALSE;
	return $in;
});

/**
 * λ login_errors => Filters the error messages displayed above the login form.
 * Disable User Enumeration. Enhances Security.
 *
 * @param    $errors(string) Login error message.
 * @return   $error(mixed)
 */
add_filter( 'login_errors', function($error) {
	global $errors;
	$err_codes = $errors->get_error_codes();
	$error = $errors->get_error_message();

	$errorCodes = [
		'invalid_username',
		'invalid_email',
		'incorrect_password',
		'authentication_failed',
	];

	$loginSandBox = array_map( function($code) use (&$err_codes, &$error) {
			if( in_array( $code, $err_codes ) ) {
				$error = '<strong>ERROR</strong>: Wrong login information... <br/> <a href="wp-login.php?action=lostpassword">¿Forgot your password?</a>';
			}
		}, $errorCodes
	);

	return $error;
});


/**
 * λ deactivatePlugins => Hide the wp admin bar on dev environment specific url,
 * Deactivate non dev plugins on local
 *
 * @param       mixed $value -> array value
 * @return      null
 */
if ( defined('WP_LOCAL_M') ) {
	show_admin_bar( false );

	$localPlugins = [
		'akismet/akismet.php',
		'autoptimize/autoptimize.php',
		'hello.php',
		'login-lockdown/loginlockdown.php',
		'tiny-compress-images/tiny-compress-images.php',
		'wp-cerber/wp-cerber.php',
		'w3-total-cache/w3-total-cache.php',
	];

	$deactivatePlugins = array_map( function($value) {
			if( in_array( $value, apply_filters('active_plugins', get_option('active_plugins')) ) ) {
				require_once(ABSPATH . 'wp-admin/includes/plugin.php');
				deactivate_plugins($value);
			}
		}, $localPlugins
	);
}

/**
 * ƒ $isSlug => Check if a slug exist in the URL, and returns truthy || falsy
 *
 * @param       $postPage(bool) (Required) Perform regex for posts or pages.
 * @param       $slug(string) (Required) Slug of the URL to validate.
 * @return      $isMatch(bool)
 */
function isSlug(bool $postPage, string $slug) {
	$getUrl = $_SERVER["REQUEST_URI"];
	$postPage ? $slugs = '/'.$slug.'\/.+/m' : $slugs = '/'.$slug.'\/$/m';
	$isMatch = preg_match($slugs, $getUrl);
	return ($isMatch ? true : false);
}

/**
* Remove WYSIWYG editor on specific page
* @return remove_post_type_support
**/
add_action( 'init', function() {
	// If not in the admin, return.
	if ( ! is_admin() ) {
		return;
	} else {
		$onpage_ID = array( 19 );
		if ( isset($_GET['post']) ) {
			remove_post_type_support( 'page', 'editor' );
			remove_post_type_support( 'page', 'thumbnail' );
			$post_ida = $_GET['post'];
			// Don't do anything unless there is a post_id.
			if ( in_array($post_ida, $onpage_ID) ) {
				// Other features can also be removed in addition to the editor. See: https://codex.wordpress.org/Function_Reference/remove_post_type_support
			}
		}
	}
});

/**
 * Call in and render a template part
 *
 * @param       $part
 * @method      get_template_part();
 */
function renderPart($part) {
	get_template_part( 'template-parts/' . $part );
}

/**
 * λ () ~ Disables admin menu items for specified users.
 *
 * @param   {void}
 * @return  {void}
 */
// add_action( 'admin_init', function() {
// 	// Provide a list of usernames who can see admin pages here.
// 	global $current_user;
// 	get_currentuserinfo();

// 	$super_admons = [
// 		'erocha'
// 	];

// 	if ( !in_array($current_user->user_login, $super_admons) ) {
// 		// remove_menu_page('edit.php'); // Posts
// 		// remove_menu_page('upload.php'); // Media
// 		// remove_menu_page('link-manager.php'); // Links
// 		// remove_menu_page('edit-comments.php'); // Comments
// 		// remove_menu_page('edit.php?post_type=page'); // Pages
// 		// remove_menu_page('plugins.php'); // Plugins
// 		// remove_menu_page('themes.php'); // Appearance
// 		remove_submenu_page( 'index.php', 'update-core.php' ); //
// 		remove_submenu_page( 'themes.php', 'themes.php' ); //
// 		remove_submenu_page( 'themes.php', 'theme-editor.php' ); //
// 		remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); //
// 	}
// }, 999 );

/**
 * λ nav_menu_link_attributes
 * Filters the HTML attributes applied to a menu item’s anchor element.
 *
 * @param       $atts (array) The HTML attributes applied to the menu item's <a> element,
 *               empty strings are ignored.
 * @return      $atts
 */
add_filter( 'nav_menu_link_attributes', function($atts) {
	$atts['class'] = "bvbjNav-item";
	return $atts;
}, 100, 1 );

/**
 * Redirect user after successful logout.
 *
 * @return string
 */
add_action('wp_logout', function() {
	nocache_headers();
	wp_redirect( home_url() );
	exit();
});

/**
 * ⨏ debugTpLog() ~ Print useful info to debug.log file.
 *
 * @param   {mixed} $target
 * @return  {void}
 */
function debugToLog ($target) {
	if (!function_exists('write_log')) {
		function write_log($log) {
			if (true === WP_DEBUG) {
				if (is_array($log) || is_object($log)) {
						error_log(print_r($log, true));
				} else {
						error_log($log);
				}
			}
		}
	}
	write_log('print '.$target);
}
