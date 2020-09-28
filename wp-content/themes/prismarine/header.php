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
	<link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet">
	<?php $cssRouter = get_stylesheet_directory_uri(); ?>
	<style type="text/css" style-type="above-the-fold">
		@font-face {
			font-family: "Helvetica LT W01 Roman";
			font-weight: normal;
			font-style: normal;
			src: url(<?php echo $cssRouter.'/assets/fonts/helvetica.woff2'; ?>)
				format("woff2"),
			url(<?php echo $cssRouter.'/assets/fonts/helvetica.woff'; ?>)
				format("woff"),
			url(<?php echo $cssRouter.'/assets/fonts/helvetica.ttf'; ?>)
				format("truetype");
		}
		@font-face {
			font-family: "Helvetica LT W01 Bold";
			font-weight: normal;
			font-style: normal;
			src: url(<?php echo $cssRouter.'/assets/fonts/helvetica_bold.woff2'; ?>)
				format("woff2"),
			url(<?php echo $cssRouter.'/assets/fonts/helvetica_bold.woff'; ?>)
				format("woff"),
			url(<?php echo $cssRouter.'/assets/fonts/helvetica_bold.ttf'; ?>)
				format("truetype");
		}

		body {
			font-family: "Helvetica LT W01 Roman";
			font-weight: normal;
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="page" class="site-main">
	<header id="masthead" class="d-flex -items-center -row -wrap -justify-normal header d-zidx-over">
		<div class="d-flex -items-center -row -wrap -justify-normal header__container content-wrapper">
			<div class="mainMenu">
				<div class="mainMenu__burger">
					<button class="toggleMenu" aria-controls="primary-menu" aria-expanded="false" type="button">
						<span class="toggleMenu__bar"></span>
					</button>
				</div>

				<div class="menuHeader">
					<div class="menuHeader__container d-flex -items-start -row -wrap -justify-between">
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
						</nav>
						<?php if (get_field('menu_image', 'option')): ?>
							<div class="image">
								<img src="<?php the_field('menu_image', 'option') ?>" alt="menu image">
							</div>
						<?php endif; ?>
					</div>
				</div>

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
				<div class="contTopHeading">
					<div class="topHeading">
						<a href="<?php echo get_home_url(); ?>">
							<h1><?php echo $acfDBHeader['top_heading']; ?></h1>
						</a>
					</div>
				</div>
			<?php endif; ?>

			<div class="buttonsHeader d-flex -items-start -row -wrap -justify-end">
				<?php if ($acfDBHeader['url_1']): ?>
					<a href="<?php echo $acfDBHeader['url_1']; ?>" class="cta cta__btn cta--darkblue" target="<?php echo $acfDBHeader['open_link_1']; ?>">
						<?php echo $acfDBHeader['text_button_1']; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->
