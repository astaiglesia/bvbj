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
	<header id="masthead" class="site-header container">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'bvbj' ); ?></button>
			<?php
				wp_nav_menu( array(
					'menu'           => 'menu-1',
					'container'      => 'ul',
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'd-flex -items-center -row -wrap -justify-between navbar',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
