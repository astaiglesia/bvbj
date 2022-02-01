<?php
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// Theme Support:
// Add or remove theme support for certain functionality specified
// by WP.
// Check here for more info:
// https://developer.wordpress.org/reference/functions/add_theme_support/
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', 'theme_supports' );
function theme_supports() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	add_image_size('author-single-post', 445, 430, true);

  // Custom thumbnail sizes.
  add_image_size('circle-img', 300, 300, true);
  add_image_size('event-card', 445, 311, true);

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support( 'html5',
    array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
    )
	);
}