<?php
/**
 * ACF Module renderer generator
 *
 * @link        https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @author      Very LLC - Frontend Software Engineer Esteban Rocha
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

// ACF Module renderer generator
if ( have_rows('modules') ):
	while ( have_rows('modules') ) : the_row();
	// ACF get repeater
	$acf_Repeater = get_row_layout();

	// Select & recurse template modules
	switch ($acf_Repeater) {
		case 'hero':
			renderPart('modules/hero.module/_hero');
			break;

		case 'our_recipients':
			renderPart('modules/our_recipients.module/_our_recipients');
			break;

		default:
			# code...
			break;
		}
	endwhile;
	wp_reset_postdata();
endif;
