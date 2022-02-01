<?php
class Nav_menu extends Walker_Nav_Menu{

  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = $depth === 0 ? 'top-level' : null;
		$clases = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );

    $link_classes = [];
    
    $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
    
    if($depth === 0) {
      $classes[] = 'nav-desktop__li';
    }

		if(in_array('prevent-default', $classes)){
			$link_classes[] = 'prevent-default';
			$link_classes[] = 'nav-link__header--'.$depth;
		}
    
		$class_names = join( ' ', $classes );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= '<li' . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';

		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}

		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
    $atts['aria-current'] = $item->current ? 'page' : '';

		// filter adds its own classes
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		//so here we add our own
		$atts['class'] = $link_classes ? join(' ', $link_classes) : $atts['class'];

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
    $title = apply_filters( 'the_title', $item->title, $item->ID );
    
    $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

    // Set up the output
    $item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= (in_array('menu-item-has-children', $classes)) ? '<span class="pr-2">' : '';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= (in_array('menu-item-has-children', $classes)) ? '</span>': '';
		$item_output .= ($depth === 0 && in_array('menu-item-has-children', $classes)) ? get_component('svg', ['icon' => 'angle-down', 'height' => 6, 'width' => 11, 'viewbox' => '0 0 21 11', 'classes' => 'ml-2', 'title' => '']) : null;
		$item_output .= ($depth > 0 && in_array('menu-item-has-children', $classes)) ? get_component('svg', ['icon' => 'angle-left', 'height' => 14, 'width' => 7, 'viewbox' => '0 0 9 17', 'title' => '']) : null;
    $item_output .= '</a>';

    $item_output .= $args->after;
    
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  
  /**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
    // print_r($args);

		// Default class.
    $classes = array( 'sub-menu', 'nav-desktop__ul' );
    
		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "<div class=\"nav-desktop__ul-wrap\"><ul$class_names>";
  }

  /**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '</ul></div>';
	}
} ?>