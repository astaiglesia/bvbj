<?php
/**
 * Dev Functions for development and debugging
 *
 * @package     Primarine
 * @author      Very LLC - Frontend Software Engineer Esteban Rocha
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

defined('WP_LOCAL_M_OFF') && add_action( 'wp_footer', function() {
	$result = [];
	$result['scripts'] = [];
	$result['styles'] = [];

	// Create wrapper markup
	print('<pre style="background-color: #222; color: #fff; font-size: 1.2rem; font-weight: 500; margin: 0; padding: 35px;">');
	print('<h1 style="color: #f8a91a; text-align: center; text-decoration: overline underline double;">⚡ Enqueued Scripts =>> ⚡</h1>');

	// Print all loaded Scripts
	global $wp_scripts;
	array_map( function($script) use(&$wp_scripts, &$result) {
		$result['scripts']['handle'] = $wp_scripts->registered[$script]->handle;
		$result['scripts']['src'] = $wp_scripts->registered[$script]->src . ";";
		print("Script handle   =>\t".$result['scripts']['handle']."\n"."Script src\t=>\t".$result['scripts']['src']."\n");
		print('<hr style="border-color: #f8a91a">');
	}, $wp_scripts->queue);

	print('<h1 style="color: #f8a91a; text-align: center; text-decoration: overline underline double;">🎨 Enqueued Styles =>> 🎨</h1>');

	// Print all loaded Styles (CSS)
	global $wp_styles;
	array_map( function($script) use(&$wp_styles, &$result) {
		$result['scripts']['handle'] = $wp_styles->registered[$script]->handle;
		$result['scripts']['src'] = $wp_styles->registered[$script]->src . ";";
		print("Script handle   =>\t".$result['scripts']['handle']."\n"."Script src\t=>\t".$result['scripts']['src']."\n");
		print('<hr style="border-color: #f8a91a">');
	}, $wp_styles->queue);
	print('</pre>');
});

/**
 * ƒ consoleLog => Console.log implementation for PHP.
 * Prints out the Variables and PHP expressions to the DevTools JS Console.
 *
 * @echo     string $jsWrapper
 * @return   null
 */
function consoleLog( $phpLog = "" ) {
	$phpToJS = json_encode($phpLog);
	$jsConsoleLiteral = "`%c$phpToJS`, 'background-color: #5e26c6; border: 2px solid #f8a91a; border-radius: 4px; color: #fff; font-family: \"FuraCode Nerd Font\", \"SFMono-Regular\", \"Ubuntu Mono\", \"Consolas\", \"DejaVu Sans Mono\", \"Menlo\", \"monospace\"; font-size: 16px; font-weight: 400; padding: 2px 6px;'";
	$jsWrapper = "<script>console.log($jsConsoleLiteral);</script>";

	print $jsWrapper;
	return null;
}

//
/**
 * λ pageTemplate => Remove Bloat Code From Head
 * do_action( 'init' ) Fires after WordPress has finished loading,
 * but before any headers are sent.
 *
 * @return    null
 */
add_action( 'init', function() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
});

/**
 * ƒ pageTemplate => Get current page template file URI on dev env.
 * Prints out the template path to the DevTools calling consoleLog().
 * Runs only in DEV Env.
 *
 * @return    global consoleLog(templatePath(string))
 */
function pageTemplate() {
	// Run on Dev env only
	if ( defined('WP_LOCAL_M') ) {
		// Get template global
		$getTemplate = function() { global $template; return $template; };

		// Set var's with callbacks
		$url = $getTemplate();
		$mssg = 'Page template Is 🚀 ==> ';

		return consoleLog($mssg.$url);
	}
}

/**
 * ƒ debug => Print debug info on variables, arrays, objects and other constructs.
 *
 * @param       string -> $entity, defaults to empty string.
 * @return      null
 */
function debug( $entity ) {
	print "<pre>";
	print var_dump($entity);
	print "</pre>";
}

/**
 * Disable Gutenberg editor
 *
 */

add_filter('use_block_editor_for_post', '__return_false', 10);


/**
 * Add page class to Body tag
 *
 */
add_filter( 'body_class', 'my_class_names' );
	function my_class_names( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
