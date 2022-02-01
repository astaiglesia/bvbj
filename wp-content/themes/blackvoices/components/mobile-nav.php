<div class="mobile-nav z-200 pointer-events-none fixed top-0 left-0 w-full h-screen bg-lynch transition-all duration-500 opacity-0 flex flex-col justify-center items-center">
  <div class="w-full h-full max-h-e700 flex flex-col justify-between items-center px-e70 py-8">
    <span class="block text-white">
      <?= get_component('svg', ['icon' => 'main-logo-solid', 'viewbox' => '0 0 145.771 49.904', 'width' => '145.771', 'height' => '49.904']) ?>
    </span>
    <nav class="mobile-nav__nav flex flex-col items-center justify-center">
      <?php
      wp_nav_menu( array(
        'theme_location'  => 'main-menu',
        'container'       => '',
        'menu'            => 'Main Menu',
        'menu_class'      => 'nav-menu flex flex-col items-center justify-center mb-e30',
        'walker'          => new Nav_Menu()
      ));?>
      <div class="w-full border-t-2 border-white">
        <a href="" class="text-lg text-white uppercase w-full text-center block blcok mt-e50">Go Login</a>
      </div>
    </nav>
    <div class="w-full">
      <div class="w-full flex items-center justify-center mb-e20"><?php
        if(have_rows('social_links', 'option')) {
          while(have_rows('social_links', 'option')) {
            the_row();
            $height = 20;
            $width = 20;

            switch (get_sub_field('social_icon')) {
              case 'facebook':
                $height = 19.073;
                $width = 9.905;
                break;
              case 'twitter':
                $height = 13.802;
                $width = 16.982;
                break;
              case 'instagram':
                $height = 16.57;
                $width = 16.599;
                break;
            }
            echo get_component('link', ['link_obj' => get_sub_field('social_link'), 'classes' => 'mx-6 block', 'title' => 'go to our '.get_sub_field('social_icon'), 'html' => get_component('svg', ['icon' => get_sub_field('social_icon'), 'classes' => 'text-white', 'height' => $height, 'width' => $width, 'viewbox' => '0 0 '.$width.' '.$height])]);
          }
        }?>
      </div>
      <div class="w-full flex">
        <span class="text-white w-full text-center">&copy;<?= date('Y') ?> <?= get_bloginfo('name') ?></span>
      </div>
    </div>
  </div>
</div>