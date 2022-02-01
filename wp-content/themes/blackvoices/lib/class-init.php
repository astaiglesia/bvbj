<?php
include(  __DIR__ . '/class-cpt.php' );
include(  __DIR__ . '/class-taxonomy.php' );
include(  __DIR__ . '/class-user.php' );

class ThemeInit {
  public function __construct(){

    // rename 'post' post type to 'story'
    add_action( 'init', [$this, 'change_default_post_type'] );


    // Custom post types
    new Cpt('Piano Keys', 'Piano Key', 'piano_keys', ['publicly_queryable'  => false]);

    // Custom taoxnomies
    // new Taxonomy('Quote Voices', 'Quote Voice', 'quote_voice', ['quotes']);

    // Custom image sizes
    // add_image_size('post-thumbnail-wide', 658, 276, true);

  }
  // Change dashboard Posts to News
  function change_default_post_type() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
  }
}