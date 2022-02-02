<?php
/*
Template Name: Home
*/

get_header();?>

<main class="home overflow-hidden" id="main" data-component="home"><?php
	if(have_rows('home_page_layouts')) {
		while(have_rows('home_page_layouts')) {
			the_row();
			switch(get_row_layout()){
				case 'hero':
					echo get_component('awardee-slider', []);
					break;
				case 'description':
					echo get_component('description-block', ['description' => get_sub_field('description_copy')]);
					break;
			}?><?php
		}
	}?>
</main>

<?php get_footer(); ?>