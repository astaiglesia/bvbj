<?php
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// Register Menus:
// These registered menus will be available in Appearance > Menus
// where the admin can add items such as posts and pages.
// They can be output in templates using wp_nav_menu. Examples
// can be found in the header and footer by default.
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', function() {
  register_nav_menus(
    array(
      'toolbar-menu' => 'The Toolbar Menu',
      'main-menu' => 'The Main Menu',
      'footer-menu' => 'Footer Menu',
    )
  );
});

function nav_menu_active_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'nav_menu_active_class' , 10 , 2);

function nav_menu_link_attributes_classes( $atts, $item, $args, $depth ){
  if( $args->theme_location === 'main-menu' ){
    $classes = ['nav-link'];
    if( in_array('menu-item-has-children', $item->classes) && $depth === 0 ){
      if( $depth === 0 ){
        // $atts['data-toggle'] = 'drawer';
        $atts['data-title'] = $item->post_title;
        $classes[] = 'drawer-toggle primary-toggle';
      }

    }
    if(in_array('menu-item-has-children', $item->classes) && $depth >= 1) $classes[] = 'drawer-toggle secondary-toggle';
    // if(in_array('menu-item-has-children', $item->classes) && $depth === 2) $classes[] = 'drawer-toggle';
    $atts['class'] = implode(' ', $classes);
  } else if( $args->theme_location === 'toolbar-menu' && $depth == 0 ) {
    $atts['class'] = 'toolbar-link';
  }

  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nav_menu_link_attributes_classes', 10, 4 );

function header_nav_menu_item_css_class( $classes, $item, $args, $depth ){
  // Adds .nav-item to li's
  if( $args->theme_location === 'main-menu' ){

    if( $depth === 0 ){
      /**
       * Returns true if css class '.drawer' should be added to menu item
       * If $classes contains '.menu-item-has-children', then add '.drawer' class ($boolAddDrawerClass: true)
       * If $classes contains '.menu-item-has-children' and 'expanded-drawer', then do not add '.drawer' class ($boolAddDrawerClass: false)
       * If $classes does not contain '.menu-item-has-children', then do not add '.drawer' class ($boolAddDrawerClass: null)
       *
       * Used array_reduce to search array for '.menu-item-has-children' and '.expanded-drawer' in one array traversal
       */
      $boolAddDrawerClass = array_reduce($classes, function($carry, $class){
        if( $class === 'menu-item-has-children' && $carry !== false ){
          $carry = true;
        } else if( $class === 'expanded-drawer' ){
          $carry = false;
        }
        return $carry;
      }, null);

      if( $boolAddDrawerClass === true ){
        $classes[] = 'drawer';
      }
    } else if( $depth === 1 ) {
      $classes[] = 'sub-menu--menu-item';
    }
    $classes[] = 'nav-item';
  } else if( $args->theme_location === 'toolbar-menu' && $depth == 0 ){
    $classes[] = 'toolbar-menu-item';
  }

  return $classes;
}
add_filter('nav_menu_css_class', 'header_nav_menu_item_css_class', 10, 4);

function header_nav_menu_sub_menu_css_class( $classes, $args, $depth ){
  if( $args->theme_location === 'main-menu'){
    if($depth === 0 ){
      $classes[] = 'drawer-menu';
      // $classes[] = 'justify-content-center';
    }
    if($depth === 1 ){
      $classes[] = 'drawer-menu';
      // $classes[] = 'justify-content-center';
    }
    if($depth === 2 ){
      $classes[] = 'drawer-menu';
      // $classes[] = 'justify-content-center';
    }
  }

  return $classes;
}
add_filter('nav_menu_submenu_css_class', 'header_nav_menu_sub_menu_css_class', 10, 3);