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

$acfDBFoot = [
	'heading'   => get_field('heading', 'option'),
	'subheading'   => get_field('subheading', 'option'),
	'contact_heading'   => get_field('contact_heading', 'option'),
	'email'   => get_field('email', 'option'),
	'instagram_url'   => get_field('instagram_url', 'option'),
	'twitter_url'   => get_field('twitter_url', 'option'),
	'copyright_text'   => get_field('copyright_text', 'option'),
];
?>

	<!-- Begin Footer -->
	<footer id="colophon" class="site-footer footer">
		<div class="footer__container">
			<?php if ($acfDBFoot['heading']): ?>
				<div class="footer__heading">
					<h2> <?php echo $acfDBFoot['heading']; ?> </h2>
				</div>
			<?php endif; ?>
			<?php if ($acfDBFoot['subheading']): ?>
				<div class="footer__subheading">
					<span> <?php echo $acfDBFoot['subheading']; ?> </span>
				</div>
			<?php endif; ?>
			<div class="mailchimpForm">
			<?php
				echo do_shortcode( '[mc4wp_form id="156"]' );
			?>
			</div>
			<div class="contactUs">
				<?php if ($acfDBFoot['contact_heading']): ?>
					<div class="contactUs__heading">
						<span> <?php echo $acfDBFoot['contact_heading']; ?> </span>
					</div>
				<?php endif; ?>
				<?php if ($acfDBFoot['email']): ?>
					<div class="contactUs__email">
						<span> <?php echo $acfDBFoot['email']; ?> </span>
					</div>
				<?php endif; ?>
				<div class="contactUs__social-media">
					<?php if ($acfDBFoot['instagram_url']): ?>
						<a href="<?php echo $acfDBFoot['instagram_url']; ?>" target="_blank" class="social-icon">
							<div class="ins-svg svg-social"></div>
						</a>
					<?php endif; ?>
					<?php if ($acfDBFoot['twitter_url']): ?>
						<a href="<?php echo $acfDBFoot['twitter_url']; ?>" target="_blank" class="social-icon">
							<div class="tw-svg svg-social"></div>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="copyright">
				<?php if ($acfDBFoot['copyright_text']): ?>
					<div class="copyright__content">
						<span> <?php echo $acfDBFoot['copyright_text']; ?> </span>
					</div>
				<?php endif; ?>
		</div>
	</footer><!-- #colophon -->
	<!-- End Footer -->
</main><!-- #page -->

<?php wp_footer(); // Call footer actions ?>

</body>
</html>
