<?php
/**
 * Module Hero Section
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
	'heading'   => get_sub_field('heading'),
	'subheading'   => get_sub_field('subheading'),
	'paragraph'   => get_sub_field('paragraph'),
]; ?>

<!-- Begin Hero Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section hero">
	<div class="container">

		<?php if ($acfDBHero['heading']): ?>
			<div class="heading">
				<p>
					<?php print $acfDBHero['heading']; ?>
				</p>
			</div>
		<?php endif; ?>

		<div class="verticalLine">
			<div class="verticalLine__content"></div>
		</div>

		<?php if ($acfDBHero['subheading']): ?>
			<h2>
				<?php print $acfDBHero['subheading']; ?>
			</h2>
		<?php endif; ?>

		<?php if ($acfDBHero['paragraph']): ?>
			<div class="paragraph">
				<p>
					<?php print $acfDBHero['paragraph']; ?>
				</p>
			</div>
		<?php endif; ?>

	</div>
</section>
<!-- End Hero Section -->
