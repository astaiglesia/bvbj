<?php
/**
 * Drawer Menu Module
 *
 * @link        https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @author      Very LLC - Frontend Software Engineer Esteban Rocha
 * @link        https://verypossible.com/
 * @since       1.0.0
 */
?>

<section class="d-flex -items-center -row -wrap -justify-center drawerMenu" style="opacity: 0;">
	<!-- Begin mobile navbar -->
	<nav class="drawerMenu-nav">
		<?php
		wp_nav_menu( array(
			'menu'           => 'menu-1',
			'container'      => 'ul',
			'theme_location' => 'menu-1',
			'menu_id'        => 'drawer-menu',
			'menu_class'     => 'd-flex -items-center -column -wrap -justify-between navbar',
		) );
		?>
	</nav>
	<!-- End mobile navbar -->
</section>
