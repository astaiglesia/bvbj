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
		<div class="fullWidth_image" style="background-image: url(<?php echo $acfDBOG['full_width_image']; ?>">

		</div>
	<?php endif; ?>

	<div class="container">

		<?php if ($acfDBOG['heading']): ?>
			<div class="heading">
				<h2> <?php echo $acfDBOG['heading']; ?> </h2>
			</div>
		<?php endif; ?>

		<div class="goal">
			<?php if ($acfDBOG['heading_g1']): ?>
				<h3> <?php echo $acfDBOG['heading_g1']; ?> </h3>
			<?php endif; ?>
			<?php if ($acfDBOG['paragraph_g1']): ?>
				<p> <?php echo $acfDBOG['paragraph_g1']; ?> </p>
			<?php endif; ?>
			<?php if ($acfDBOG['button_url_g1']): ?>
				<a href="<?php echo $acfDBOG['button_url_g1']; ?>" target="_blank"> <?php echo $acfDBOG['button_text_g1']; ?> </a>
			<?php endif; ?>
		</div>

		<div class="goal">
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
</section>
<!-- End Our Goals Section -->
