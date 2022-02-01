<?php
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// Enqueue Scripts And Styles:
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
global $post;

add_action( 'wp_enqueue_scripts', function () {
  if (!is_admin()) {
    wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/app.css', [], '1.0.3' );
    wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/294f5b1765.js', [], '1.0.0', true );
    wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), '1.0.3', true );
  }
}, 999);