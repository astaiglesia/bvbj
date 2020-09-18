<?php
/**
 * Module Nomination form
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBHero = [
	'heading_page'   => get_sub_field('heading_page'),
	'subheading'   => get_sub_field('subheading'),
	'contact_shortcode'   => get_sub_field('contact_shortcode'),
]; ?>

<!-- Begin Nomination form -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section nominationForm">
	<div class="container">

		<?php if ($acfDBHero['heading_page']): ?>
			<div class="heading">
				<h1>
					<?php print $acfDBHero['heading_page']; ?>
				</h1>
			</div>
		<?php endif; ?>

		<?php if ($acfDBHero['subheading']): ?>
			<div class="subHeading">
				<span>
					<?php print $acfDBHero['subheading']; ?>
				</span>
			</div>
		<?php endif; ?>

		<?php if ($acfDBHero['contact_shortcode']): ?>
			<div class="formContainer">
				<?php
					$contactShortC = $acfDBHero['contact_shortcode'];
					echo do_shortcode( '' . $contactShortC . '' );
					?>
			</div>
		<?php endif; ?>

	</div>
</section>
<!-- End Nomination form -->
