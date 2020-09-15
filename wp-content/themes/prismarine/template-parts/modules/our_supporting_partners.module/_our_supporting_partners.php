<?php
/**
 * Module Our Supporting Partners Section
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBOR = [
	'heading'   => get_sub_field('heading'),
]; ?>

<!-- Begin Our Supporting Partners Section -->
<section class="d-section ourSupportingP">
	<div class="container">

		<?php if ($acfDBOR['heading']): ?>
			<div class="heading">
				<h2> <?php print $acfDBOR['heading']; ?> </h2>
			</div>
		<?php endif; ?>

		<div class="logos d-flex -items-center -row -wrap -justify-center">
				<?php
					// Check rows exists.
					if( have_rows('logos') ):
							// Loop through rows.
							while( have_rows('logos') ) : the_row();
									// Load sub field value.
									$logo = get_sub_field('logo');
									$link_url = get_sub_field('link_url');
									?>
									<div class="logo">
										<a href="<?php echo $link_url; ?>" target="_blank" title="Open partner website">
											<img src="<?php echo $logo; ?>" alt="logo supporting partners">
										</a>
									</div>
							<?php
							// End loop.
							endwhile;
					endif;
				?>
		</div>



	</div>
</section>
<!-- End Our Supporting Partners Section -->
