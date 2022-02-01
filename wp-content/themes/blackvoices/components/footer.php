<footer class="footer bg-blue relative z-100">
  <?= get_component('footer-subscribe') ?>
  <div class="container">
    <div class="flex flex-col lg:flex-row lg:justify-between mt-e70 lg:my-e60"><?php
      wp_nav_menu( array(
        'theme_location'  => 'main-menu',
        'container'       => '',
        'menu'            => 'Footer Menu',
        'menu_class'      => 'nav-menu nav-menu--footer',
        'walker'          => new Nav_Menu()
      ));?>
      <div class="flex items-center my-e60 lg:my-0"><?php
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
            echo get_component('link', ['link_obj' => get_sub_field('social_link'), 'classes' => 'mr-6 block text-lg text-sky', 'title' => 'go to our '.get_sub_field('social_icon'), 'html' => get_component('svg', ['icon' => get_sub_field('social_icon'), 'classes' => 'text-sky', 'height' => $height, 'width' => $width, 'viewbox' => '0 0 '.$width.' '.$height])]);
          }
        }?>
      </div>
    </div>

    <span class="w-full block border-lynch border-b mb-e60 lg:mb-e30"></span>
    <span class="text-sky  block text-sm mb-e30 lg:mb-e60">
      <span class="">© 2021 Insight Partners</span>  /  <a href="#" title="test" class="">Terms of Use</a>  /  <a href="#" title="test" class="">Privacy Policy</a>  /  <a href="#" title="test" class="">Legal Disclaimer</a>  /  <a href="#" title="test" class="">Regulatory Notices </a> /  <a href="#" title="test" class="">CCPA Notice</a>
    </span>
  </div>
  <?= get_component('svg', ['icon' => 'footer-banner-logo', 'classes' => 'h-full w-full max-w-e1440 mx-auto block', 'width' => 1440, 'height' => 246, 'viebox' => '0 0 1440 246']) ?>
</footer>