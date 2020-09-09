<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bvbj
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $cssRouter = get_stylesheet_directory_uri(); ?>
	<style type="text/css" style-type="above-the-fold">
		@font-face {
			font-family: "Avenir-Book";
			font-display: block;
			font-style: normal;
			font-weight: 700;
			src: url(<?php echo $cssRouter.'/assets/fonts/Avenir-Book.woff2'; ?>)
				format("woff2"),
			url(<?php echo $cssRouter.'/assets/fonts/Avenir-Book.woff'; ?>)
				format("woff"),
			url(<?php echo $cssRouter.'/assets/fonts/Avenir-Book.ttf'; ?>)
				format("truetype");
		}

		body {
			font-family: "Avenir-Book";
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="page" class="site-main">
	<header id="masthead" class="d-flex -items-center -row -wrap -justify-normal header">
		<div class="d-flex -items-center -row -wrap -justify-normal header__container content-wrapper">
			<div class="mainMenu">
				<div class="mainMenu__burger">
					<button class="toggleMenu" aria-controls="primary-menu" aria-expanded="false" type="button">
						<span class="toggleMenu__bar"></span>
					</button>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<?php
						wp_nav_menu( array(
							'menu'           => 'header-menu',
							'container'      => 'ul',
							'theme_location' => 'header-menu',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'navbar',
						) );
					?>
				</nav><!-- #site-navigation -->
			</div>

			<?php
				$acfDBHeader = [
					'top_heading'   => get_field('top_heading', 'option'),
					'text_button_1'   => get_field('text_button_1', 'option'),
					'url_1'   => get_field('url_1', 'option'),
					'open_link_1'   => get_field('open_link_1', 'option'),
					'text_button_2'   => get_field('text_button_2', 'option'),
					'url_2'   => get_field('url_2', 'option'),
					'open_link_2'   => get_field('open_link_2', 'option'),
				];
			?>

			<?php if ($acfDBHeader['top_heading']): ?>
				<div class="th">
					<?php echo $acfDBHeader['top_heading']; ?>
				</div>
			<?php endif; ?>

			<div class="buttons-header">
				<?php if ($acfDBHeader['url_1']): ?>
					<a href="<?php echo $acfDBHeader['url_1']; ?>" class="d-flex -items-center -row -wrap -justify-center cta cta--darkblue" target="<?php echo $acfDBHeader['open_link_1']; ?>">
						<?php echo $acfDBHeader['text_button_1']; ?>
					</a>
				<?php endif; ?>
				<?php if ($acfDBHeader['url_2']): ?>
					<a href="<?php echo $acfDBHeader['url_2']; ?>" class="d-flex -items-center -row -wrap -justify-center cta cta--lightblue" target="<?php echo $acfDBHeader['open_link_2']; ?>">
						<?php echo $acfDBHeader['text_button_2']; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->
