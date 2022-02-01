<?php
add_action('enqueue_block_editor_assets', function(){
  wp_enqueue_style( 'admin-core', get_stylesheet_directory_uri() . '/css/admin-blocks.css', [], '1.0.3' );
  // // wp_enqueue_style( 'block-demo', get_stylesheet_directory_uri() . '/css/block-editor/block-demo.css', [], '1.0.3' );
  wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), '1.0.3', true );
});
add_action('acf/init', 'init_block_types');

function init_block_types() {
  // Check function exists.
  if( function_exists('acf_register_block_type') ) {
    // block registration -- DO-NOT-DELETE-THIS-LINE
    // register demo block.
    acf_register_block_type(array(
      'name'              => 'block-demo',
      'title'             => __('Block Demo'),
      'description'       => __('A demo block.'),
      'render_template'   => 'components/block-demo.php',
      'category'          => 'formatting',
      'icon'              => 'admin-comments',
      'keywords'          => array('block demo'),
      'supports' =>[
        'align' => false
      ]
    ));
  }
}

