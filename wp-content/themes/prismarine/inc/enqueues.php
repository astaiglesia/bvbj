<?php
/**
 * Styles & Scripts Enqueue Module
 *
 * @package     bvbj
 * @author      Very LLC - Frontend Software Engineer Esteban Rocha
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

/**
 * Dequeue gutenberg render blocking js 🤦🏻‍♂️
 * @return hook conditional add_action()
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'wp-block-library' );
}, 100 );

/**
 * λ $enqueueSripts => Enqueue a JS module. Registers the script if $src provided
 * (does NOT overwrite), and enqueues it.
 *
 * wp_enqueue_script( string $handle, string $src = '', array $deps = array(),
 *    string|bool|null $ver = false, bool $in_footer = false )
 *
 * @param       $handle (string) (Required) Name of the script. Should be unique.
 * @param       $src (string) (Optional) Full URL of the script.
 * @param       $deps (array) (Optional) Array of registered script handles this
 *                script depends on.
 * @param       $ver (string|bool|null) (Optional) script version number for cache.
 * @param       $media (string) (Optional) Whether to enqueue the script before
 *                </body> instead of in the <head>. Default 'false'.
 *
 * @return      null
 */

// Declare script handles.
$eHandle = [
	// 'Drawer-Menu'  => '/js/dist/drawer-menu.min.js',
	'Fade-Into-View' => '/js/fadein-load.min.js',
];

// Add handles dynamically per page.
// switch (true) {
// 		case '':
// 		break;

// 	default:
// 		# code...
// 		break;
// }

!is_admin() && $enqueueScripts = array_walk($eHandle, function(&$a, $b) {
	wp_enqueue_script( "$b", get_template_directory_uri() . "$a", array(), filemtime(get_stylesheet_directory() . "$a"), true );
});


// Slick Slider
function bvbj_enqueue_style() {
	if ( is_front_page() ) {
		wp_enqueue_style( 'slick-style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
		wp_enqueue_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );
		wp_enqueue_style( 'fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
	}
}

function bvbj_enqueue_script() {
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-1.12.4.min.js', array(), '1.12.4', 'true' );
	if ( is_front_page() ) {
		wp_enqueue_script( 'slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.0.0', 'true' );
		wp_enqueue_script( 'slick-scripts', get_template_directory_uri() . '/js/slick-scripts.min.js', array('jquery'), '1.0.0', 'true' );
		wp_enqueue_script( 'fancybox-script', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array('jquery'), '3.5.7', 'true' );
	}
}

add_action( 'wp_enqueue_scripts', 'bvbj_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'bvbj_enqueue_script' );
