<?php
////////////////////////////////////////////////////////////////////
// Advanced Custom Field Plugin:
////////////////////////////////////////////////////////////////////

/**
 * Create default option pages.
 * Use ACF Pro to add fields.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// save/load ACF fields to/from json files
add_filter('acf/settings/load_json', 'acf_json_load_point');
add_filter('acf/settings/save_json', 'acf_json_save_point');

// return current_user_can('manage_options');
// disable the ACF menu if not in local dev mode
if($_SERVER['REMOTE_ADDR']!='127.0.0.1'){
    // add_filter('acf/settings/show_admin', '__return_false');
    // add_filter('acf/settings/show_updates', '__return_true');
}

function acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/lib/acf/acf-json';
    
    // return
    return $path;
    
}

function acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory() . '/lib/acf/acf-json';
    
    // return
    return $paths;
    
}