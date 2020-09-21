<?php
/**
 * Module Thank you Section
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBT = [
	'heading'   => get_sub_field('heading'),
	'subheading'   => get_sub_field('subheading'),
	'button_text'   => get_sub_field('button_text'),
]; ?>

<!-- Begin Hero Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section thankyou">
	<div class="container">

		<?php if ($acfDBT['heading']): ?>
			<div class="heading">
				<h1>
					<?php print $acfDBT['heading']; ?>
				</h1>
			</div>
		<?php endif; ?>

		<?php if ($acfDBT['subheading']): ?>
			<p>
				<?php print $acfDBT['subheading']; ?>
			</p>
		<?php endif; ?>

		<?php if ($acfDBT['button_text']): ?>
			<a href="<?php echo get_home_url(); ?>"> <?php echo $acfDBT['button_text']; ?> </a>
		<?php endif; ?>

	</div>
</section>
<!-- End Hero Section -->
