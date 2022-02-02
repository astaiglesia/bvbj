<header class="header z-150 h-e100 fixed w-full top-0" data-component="header">
  <div class="container flex justify-between py-10">
    <a class="header__logo" href="<?= site_url() ?>" title="home">
      <span class="sr-only">Go to home page</span>
      <?= get_component('svg', ['icon' => 'main-logo', 'width' => 145.771, 'height' => 49.904, 'classes' => 'logo logo--main']) ?>
      <?= get_component('image', ['image' => $logo ?? null, 'classes' => 'logo']) ?>
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