<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
