<?php
/**
 * Module Our Recipients Section
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

<!-- Begin Our Recipients Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section our-recipients">
	<div class="container">

		<?php if ($acfDBOR['heading']): ?>
			<div class="heading">
				<p>
					<?php print $acfDBOR['heading']; ?>
				</p>
			</div>
		<?php endif; ?>

		<div class="wrapper">
			<div class="carousel-r">

				<?php
					// Check rows exists.
					if( have_rows('carousel_recipients') ):
							$i = 1;
							// Loop through rows.
							while( have_rows('carousel_recipients') ) : the_row();

									// Load sub field value.
									$image_carousel = get_sub_field('image_carousel');
									$name = get_sub_field('name');
									$location = get_sub_field('location');
									$image_popup = get_sub_field('image_popup');
									$description = get_sub_field('description');
									$video_url = get_sub_field('video_url');
									$facebook_url = get_sub_field('facebook_url');
									$twitter_url = get_sub_field('twitter_url');
									$instagram_url = get_sub_field('instagram_url');
									$linkedin_url = get_sub_field('linkedin_url');
							?>
									<div class="recipient">
										<a data-fancybox data-src="#modal<?php echo $i; ?>" href="javascript:;" class="btn btn-primary">
											<?php if ($image_carousel): ?>
												<img src="<?php echo $image_carousel; ?>">
											<?php endif; ?>
											<?php if ($name): ?>
												<h2><?php echo $name; ?></h2>
											<?php endif; ?>
											<?php if ($location): ?>
												<span><?php echo $location; ?></span>
											<?php endif; ?>
										</a>
										<div style="display: none;" id="modal<?php echo $i; ?>">
											<?php if ($name): ?>
												<h2><?php echo $name; ?></h2>
											<?php endif; ?>
											<?php if ($location): ?>
												<span><?php echo $location; ?></span>
											<?php endif; ?>
											<?php if ($description): ?>
												<p><?php echo $description; ?></p>
											<?php endif; ?>
											<?php if ($image_popup): ?>
												<img src="<?php echo $image_popup; ?>">
											<?php endif; ?>

											<?php if ($video_url): ?>
												<div class="yt-video">
													<?php echo $video_url; ?>
												</div>
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
							$i++;
							// End loop.
							endwhile;

					endif;
				?>

			</div>
		</div>



	</div>
</section>
<!-- End Our Recipients Section -->
