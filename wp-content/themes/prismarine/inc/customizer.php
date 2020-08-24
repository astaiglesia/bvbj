<?php
/**
 * bvbj Theme Customizer
 *
 * @package bvbj
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bvbj_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'bvbj_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'bvbj_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'bvbj_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bvbj_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bvbj_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bvbj_customize_preview_js() {
	wp_enqueue_script( 'bvbj-customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bvbj_customize_preview_js' );

/**
 * λ () ~ Remove unused customizer settings and panels.
 *
 * @param   {void}
 * @return  {bool}
 */
is_admin() && add_action( "customize_register", function() {
	global $wp_customize;
	$eHandle = [
		'background_image'  => 'background_image',
		'colors'            => 'colors',
		'custom_css'        => 'custom_css',
		'fl-export-import'  => 'fl-export-import',
		'header_image'      => 'header_image',
		'nav_menus'         => 'nav_menus',
		'static_front_page' => 'static_front_page',
		'themes'            => 'themes',
		'widgets'           => 'widgets',
	];

	$disableCustomizer = array_walk($eHandle,
		function(&$a, $b) use ($wp_customize) {
			$wp_customize->remove_panel($b);
			$wp_customize->remove_section($b);
			$wp_customize->remove_setting($b);
		}
	);
}, 999, 1 );
