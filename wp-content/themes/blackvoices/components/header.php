<header class="header z-150 h-e100 fixed w-full top-0" data-component="header">
  <div class="container flex justify-between py-10">
    <a class="header__logo relative text-white" href="<?= site_url() ?>" title="home">
      <span class="sr-only">Go to home page</span>
      <?= get_component('svg', ['icon' => 'main-logo', 'width' => 145.771, 'height' => 49.904, 'classes' => 'logo logo--main opacity-0 absolute top-0']) ?>
      <?= get_component('svg', ['icon' => 'mini-logo', 'width' => 60, 'height' => 60, 'classes' => 'logo logo--scrolled opacity-0 absolute top-0']) ?>
      <?= get_component('image', ['image' => $logo ?? null, 'classes' => 'logo']) ?>
    </a>
    <?= get_component('main-nav') ?>
    <span class="mobile-nav__trigger z-210 md:hidden"><?= get_component('arrow', ['direction' => 'top-right']) ?></span>
  </div>
  <?= get_component('mobile-nav') ?>
</header>