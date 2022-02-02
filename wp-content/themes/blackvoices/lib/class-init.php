<?php
include(  __DIR__ . '/class-cpt.php' );
include(  __DIR__ . '/class-taxonomy.php' );
include(  __DIR__ . '/class-user.php' );

class ThemeInit {
  public function __construct(){
    // Custom post types
    new Cpt('Awardees', 'Awardee', 'awardees');

    // Custom taoxnomies
    // new Taxonomy('Quote Voices', 'Quote Voice', 'quote_voice', ['quotes']);

    // Custom image sizes
    // add_image_size('post-thumbnail-wide', 658, 276, true);
  }
}