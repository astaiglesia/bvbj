<?php
$logo = get_field('header_logo', 'option');?>

<header class="header z-150 w-full" data-component="header">

  <div class="container flex justify-between py-10">
    <a class="header__logo" href="<?= site_url() ?>" title="home">
      <span class="sr-only">Go to home page</span>
      <?= get_component('image', ['image' => $logo, 'classes' => 'logo', 'wrap_classes' => 'flex', 'content' => get_field('logo_copy', 'option')]) ?>
    </a><?php
    wp_nav_menu( array(
      'menu'           => 'header-menu',
      'container'      => 'ul',
      'theme_location' => 'header-menu',
      'menu_id'        => 'primary-menu',
      'menu_class'     => 'header__desktop-nav flex',
    ) );?>
    <!-- <span class="mobile-nav__trigger z-210 md:hidden"><?= get_component('arrow', ['direction' => 'top-right']) ?></span> -->
  </div>
  <?= get_component('mobile-nav') ?>
</header>