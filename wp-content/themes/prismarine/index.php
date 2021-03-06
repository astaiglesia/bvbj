<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bvbj
 */

get_header();
?>
	<section id="primary" class="content-area">
		<?php
		/**
			* Invoke the ACF template part generator
			*/
			require_once get_template_directory() . '/template-parts/_acf-renderer.php';
		?>
	</section><!-- #primary -->
<?php
get_footer();
