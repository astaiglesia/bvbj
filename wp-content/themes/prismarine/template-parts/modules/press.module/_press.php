<?php
/**
 * Module Press Section
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBP = [
	'heading_page'   => get_sub_field('heading_page'),
	'subheading'   => get_sub_field('subheading'),
	'caption_email'   => get_sub_field('caption_email'),
	'email'   => get_sub_field('email'),
]; ?>

<!-- Begin Press Section -->
<section class="d-section press">
	<div class="container">

		<div class="top">
			<?php if ($acfDBP['heading_page']): ?>
				<div class="press__heading">
					<h1> <?php print $acfDBP['heading_page']; ?> </h1>
				</div>
			<?php endif; ?>

			<div class="emailBlock">
				<?php if ($acfDBP['caption_email']): ?>
					<div class="press__captionEmail">
						<span><?php echo $acfDBP['caption_email']; ?></span>
					</div>
				<?php endif; ?>

				<?php if ($acfDBP['email']): ?>
					<div class="press__email">
						<a href="mailto: <?php echo $acfDBP['email']; ?>"><?php echo $acfDBP['email']; ?></a>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($acfDBP['subheading']): ?>
				<div class="press__subHeading">
					<h2> <?php print $acfDBP['subheading']; ?> </h2>
				</div>
			<?php endif; ?>
		</div>

		<?php

			// Check rows exists.
			if( have_rows('press_posts') ): ?>

				<div id="pressList" class="pressPosts d-flex -items-center -row -wrap -justify-between d-section">
					<?php
					// Loop through rows.
					while( have_rows('press_posts') ) : the_row();

							// Load sub field value.
							$image = get_sub_field('image');
							$headline = get_sub_field('headline');
							$short_description = get_sub_field('short_description');
							$external_link = get_sub_field('external_link');
							?>

							<div class="post">
								<?php if ($image): ?>
									<img src="<?php echo $image; ?>" alt="press">
								<?php endif; ?>
								<?php if ($headline): ?>
									<h3><?php echo $headline; ?></h3>
								<?php endif; ?>
								<?php if ($short_description): ?>
									<p><?php echo $short_description; ?></p>
								<?php endif; ?>
								<?php if ($external_link): ?>
									<a href="<?php echo $external_link; ?>" target="_blank">Read more</a>
								<?php endif; ?>
							</div>

					<?php
					// End loop.
					endwhile; ?>
				</div>
				<div class="btnContainer">
					<div id="loadMore">View more</div>
				</div>
			<?php
			endif;

		?>

	</div>
</section>
<!-- End Press Section -->
