<section class="image-copy-slider pt-e80 lg:pt-e130 bg-sky<?= $wrap_classes ? ' '.$wrap_classes : null ?>" data-component="image-copy-slider">
  <div class="container flex md:justify-between items-end mb-e30 lg:mb-e60">
    <h2 class="h1 block w-full max-w-5xl">Our latest ideas and insights.</h2>
    <div class="hidden md:inline-flex">
      <?= get_component('button', [
        'link' => [
          'url' => '#',
          'title' => 'View All Ideas'
        ],
        'classes' => 'w-full lg:w-auto',
        'arrow' => true,
      ]) ?>
    </div>
  </div>
  <div class="container">
    <div class="glide pb-e70 lg:pb-e90">
      <div class="glide__track w-e240 lg:w-e990" data-glide-el="track">
        <ul class="glide__slides">
          <li class="glide__slide">
            <?= get_component('image', ['image' => get_stylesheet_directory_uri().'/images/idea-sld-1.png', 'wrap_classes' => 'h-e170 md:h-e275 lg:h-e350 w-full mb-e30 lg:mb-e40', 'cover' => true]) ?>
            <div class="w-full pr-6">
              <h3 class="mb-6 h4 block">Lorem ipsum dolor sit amet, consectetur lorem ipsum</h3>
              <p class="font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo ultrices mattis.</p>
          </li>
          <li class="glide__slide">
            <?= get_component('image', ['image' => get_stylesheet_directory_uri().'/images/idea-sld-2.png', 'wrap_classes' => 'h-e170 md:h-e275 lg:h-e350 w-full mb-e30 lg:mb-e40', 'cover' => true]) ?>
            <div class="w-full pr-6">
              <h3 class="mb-6 h4 block">Lorem ipsum dolor sit amet, consectetur lorem ipsum</h3>
              <p class="font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo ultrices mattis.</p>
          </li>
          <li class="glide__slide">
            <?= get_component('image', ['image' => get_stylesheet_directory_uri().'/images/idea-sld-3.png', 'wrap_classes' => 'h-e170 md:h-e275 lg:h-e350 w-full mb-e30 lg:mb-e40', 'cover' => true]) ?>
            <div class="w-full pr-6">
              <h3 class="mb-6 h4 block">Lorem ipsum dolor sit amet, consectetur lorem ipsum</h3>
              <p class="font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo ultrices mattis.</p>
          </li>
        </ul>
      </div>
    </div>
    <div class="image-copy-slider__buttons hidden md:flex items-center justify-end">
      <button class="slide-btn slide-btn--prev mr-e80"><?= get_component('arrow', ['size' => 'sm', 'border_color' => 'border-blue', 'inner_color' => 'bg-orange', 'direction' => 'left']) ?></button>
      <button class="slide-btn slide-btn--next mr-e80"><?= get_component('arrow', ['size' => 'sm', 'border_color' => 'border-blue', 'inner_color' => 'bg-orange', 'direction' => 'right']) ?></button>
    </div>
  </div>
  <div class="container pb-e120">
    <?= get_component('button', [
      'link' => [
        'url' => '#',
        'title' => 'View All Ideas'
      ],
      'classes' => 'w-full lg:w-auto md:hidden',
      'arrow' => true,
    ]) ?>
  </div>
</section>