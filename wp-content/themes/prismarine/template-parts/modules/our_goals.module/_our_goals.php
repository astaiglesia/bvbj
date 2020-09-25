<?php
/**
 * Module Our Goals Section
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBOG = [
	'heading'   => get_sub_field('heading'),
	'full_width_image'   => get_sub_field('full_width_image'),
	'full_width_image_mobile'   => get_sub_field('full_width_image_mobile'),
	'heading_g1'   => get_sub_field('heading_g1'),
	'paragraph_g1'   => get_sub_field('paragraph_g1'),
  'button_text_g1'   => get_sub_field('button_text_g1'),
	'button_url_g1'   => get_sub_field('button_url_g1'),
	'heading_g2'   => get_sub_field('heading_g2'),
	'paragraph_g2'   => get_sub_field('paragraph_g2'),
  'button_text_g2'   => get_sub_field('button_text_g2'),
  'button_url_g2'   => get_sub_field('button_url_g2'),
]; ?>

<!-- Begin Our Goals Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section ourGoals">

	<?php if ($acfDBOG['full_width_image']): ?>
		<div class="fullWidth_image --desktop" style="background-image: url(<?php echo $acfDBOG['full_width_image']; ?>)">
		</div>
		<div class="fullWidth_image --mobile" style="background-image: url(<?php echo $acfDBOG['full_width_image_mobile']; ?>)">
		</div>
	<?php endif; ?>

	<div class="container d-flex -items-center -row -wrap -justify-between d-section twoGoals">

		<?php if ($acfDBOG['heading']): ?>
			<div class="heading -row -wrap">
				<h2> <?php echo $acfDBOG['heading']; ?> </h2>
			</div>
		<?php endif; ?>

		<div class="goal g1">
			<div class="goal__content">
				<?php if ($acfDBOG['heading_g1']): ?>
					<h3> <?php echo $acfDBOG['heading_g1']; ?> </h3>
				<?php endif; ?>
				<?php if ($acfDBOG['paragraph_g1']): ?>
					<p> <?php echo $acfDBOG['paragraph_g1']; ?> </p>
				<?php endif; ?>
				<?php if ($acfDBOG['button_url_g1']): ?>
					<a href="<?php echo $acfDBOG['button_url_g1']; ?>"> <?php echo $acfDBOG['button_text_g1']; ?> </a>
				<?php endif; ?>
			</div>
		</div>

		<div class="goal g2">
			<div class="goal__content">
				<?php if ($acfDBOG['heading_g2']): ?>
					<h3> <?php echo $acfDBOG['heading_g2']; ?> </h3>
				<?php endif; ?>
				<?php if ($acfDBOG['paragraph_g2']): ?>
					<p> <?php echo $acfDBOG['paragraph_g2']; ?> </p>
				<?php endif; ?>
				<?php if ($acfDBOG['button_url_g2']): ?>
					<a href="<?php echo $acfDBOG['button_url_g2']; ?>" target="_blank"> <?php echo $acfDBOG['button_text_g2']; ?> </a>
				<?php endif; ?>
			</div>
		</div>


	</div>
</section>
<!-- End Our Goals Section -->
