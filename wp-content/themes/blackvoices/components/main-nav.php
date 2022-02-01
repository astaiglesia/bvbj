<?php
$classes = 'main-nav relative hidden md:block opacity-0 top-28';?>
<nav class="<?= $classes ?>"><?php
  wp_nav_menu( array(
    'theme_location'  => 'main-menu',
    'container'       => '',
    'menu'            => 'Main Menu',
    'menu_class'      => 'nav-menu nav-menu--header',
    'walker'          => new Nav_Menu()
  ));?>
</nav>