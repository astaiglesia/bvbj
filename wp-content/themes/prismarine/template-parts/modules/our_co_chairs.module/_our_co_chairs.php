<?php
/**
 * Module Our Co-Chairs Section
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

<!-- Begin Our Co-Chairs Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section our-co-chairs">
	<div class="container">

		<?php if ($acfDBOR['heading']): ?>
			<div class="heading">
				<h2> <?php print $acfDBOR['heading']; ?> </h2>
			</div>
		<?php endif; ?>

		<div class="cont-co-chairs">
			<?php
				// Check rows exists.
				if( have_rows('co_chairs') ):
						$i = 1;
						// Loop through rows.
						echo '<div class="first d-flex -items-start -row -wrap -justify-around">';
						while( have_rows('co_chairs') ) : the_row();

								// Load sub field value.
								$image_item = get_sub_field('image_item');
								$name = get_sub_field('name');
								$role = get_sub_field('role');
								$image_popup = get_sub_field('image_popup');
								$description = get_sub_field('description');
								$subheading = get_sub_field('subheading');
								$facebook_url = get_sub_field('facebook_url');
								$twitter_url = get_sub_field('twitter_url');
								$instagram_url = get_sub_field('instagram_url');
								$linkedin_url = get_sub_field('linkedin_url');
						?>
								<div class="recipient">
									<a data-fancybox data-src="#modal-cc<?php echo $i; ?>" href="javascript:;" class="btn btn-primary">
										<?php if ($image_item): ?>
											<img src="<?php echo $image_item; ?>">
										<?php endif; ?>
										<?php if ($name): ?>
											<h2><?php echo $name; ?></h2>
										<?php endif; ?>
										<?php if ($role): ?>
											<span><?php echo $role; ?></span>
										<?php endif; ?>
									</a>
									<div style="display: none;" id="modal-cc<?php echo $i; ?>">
										<?php if ($name): ?>
											<h2><?php echo $name; ?></h2>
										<?php endif; ?>
										<?php if ($subheading): ?>
											<span><?php echo $subheading; ?></span>
										<?php endif; ?>
										<?php if ($description): ?>
											<p><?php echo $description; ?></p>
										<?php endif; ?>
										<?php if ($image_popup): ?>
											<img src="<?php echo $image_popup; ?>">
										<?php endif; ?>

										<span>Social Media</span>
										<?php if ($facebook_url): ?>
										<a href="<?php echo $facebook_url; ?>" target="_blank" class="social-icon">
											<div class="fb-svg svg-social"></div>
										</a>
										<?php endif; ?>
										<?php if ($twitter_url): ?>
										<a href="<?php echo $twitter_url; ?>" target="_blank" class="social-icon">
											<div class="tw-svg svg-social"></div>
										</a>
										<?php endif; ?>
										<?php if ($instagram_url): ?>
										<a href="<?php echo $instagram_url; ?>" target="_blank" class="social-icon">
											<div class="ins-svg svg-social"></div>
										</a>
										<?php endif; ?>
										<?php if ($linkedin_url): ?>
										<a href="<?php echo $linkedin_url; ?>" target="_blank" class="social-icon">
											<div class="link-svg svg-social"></div>
										</a>
										<?php endif; ?>
									</div>
								</div>

						<?php


						if ($i === 3 ):
							echo '</div><div class="second d-flex -items-start -row -wrap -justify-around">';
						endif;
						if ($i === 7):
							echo '</div>';
						endif;

						$i++;
						// End loop.
						endwhile;

						echo '</div>';

				endif;
			?>
		</div>



	</div>
</section>
<!-- End Our Co-Chairs Section -->
