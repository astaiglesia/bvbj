<?php
/*
* Callback function to filter the MCE settings
*/

// function add_style_select_buttons( $buttons ) {
//   array_unshift( $buttons, 'styleselect' );
//   return $buttons;
// }
// // Register our callback to the appropriate filter
// add_filter( 'mce_buttons_2', 'add_style_select_buttons' );

// function my_mce_before_init_insert_formats( $init_array ) {  

// // Define the style_formats array
// // die(print_r($init_array));
// 	$style_formats = array(  
// /*
// * Each array child is a format with it's own settings
// * Notice that each array has title, block, classes, and wrapper arguments
// * Title is the label which will be visible in Formats menu
// * Block defines whether it is a span, div, selector, or inline style
// * Classes allows you to define CSS classes
// * Wrapper whether or not to add a new block-level element around any selected elements
// */
// 		array(  
// 			'title' => 'Block quote',  
// 			'block' => 'blockquote',  
// 			'classes' => 'blockquote',
// 			'wrapper' => true,
			
// 		),  
// 		array(  
// 			'title' => 'Blue Button',  
// 			'block' => 'span',  
// 			'classes' => 'blue-button',
// 			'wrapper' => true,
// 		),
// 		array(  
// 			'title' => 'Red Button',  
// 			'block' => 'span',  
// 			'classes' => 'red-button',
// 			'wrapper' => true,
// 		),
// 	);  
// 	// Insert the array, JSON ENCODED, into 'style_formats'
// 	$init_array['style_formats'] = json_encode( $style_formats );  
	
// 	return $init_array;  
  
// } 
// // Attach callback to 'tiny_mce_before_init' 
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
  add_editor_style( 'css/admin.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );