<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bvbj
 */

// Get developer information on the template path
pageTemplate();

?>

	<!-- Begin Footer -->
	<footer id="colophon" class="site-footer container">
		<div class="site-info">
			<?php $heading = get_field( 'heading', 'option' );  ?>
			<h2> <?php echo $heading; ?> </h2>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<!-- End Footer -->
</main><!-- #page -->

<?php wp_footer(); // Call footer actions ?>

</body>
</html>
