<?php
/*
Template Name: Home
*/

get_header();?>

<main class="home overflow-hidden bg-black" id="main" data-component="home">
  <section class="hero-video overflow-visible relative <?= $_COOKIE['hero'] === 'true' ? 'h-s90' : 'h-screen' ?>">
    <div class="hero-video__overlay absolute top-0 left-0 w-full h-screen bg-black z-100 opacity-0"></div>
    <video loop muted playsinline autoplay class="relative z-50 object-cover w-full h-screen" data-placeholder="<?= get_stylesheet_directory_uri() ?>/images/home-page-hero-image-scaled.jpg">
      <source src="<?= get_stylesheet_directory_uri() ?>/video/hp-hero.mp4" type="video/mp4">
    </video>
    <div class="absolute h-screen w-full top-0 left-0">
      <div class="container relative h-full">
        <h1 class="text-4xl md:text-6xl lg:text-8xl font-light font-sans text-white z-100 top-1/3 absolute hero-animated-text <?= $_COOKIE['hero'] === 'true' ? 'hidden' : ''?>"><?= get_field('first_title') ?></h1>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-light font-sans text-white z-100 top-1/3 absolute hero-animated-text <?= $_COOKIE['hero'] === 'true' ? 'opacity-100' : 'opacity-0'?>"><?= get_field('second_title') ?></h1>
      </div>
    </div>
  </section>
  <?= get_component('piano-key-carousel', ['keys' => get_field('piano_keys')]) ?>
  <section class="scroll-over bg-blue pt-e60 lg:pt-e120 pb-e80 md:pb-e110 lg:min-h-screen relative">
    <div class="scroll-over__bg opacity-0 bg-blue z-75 absolute top-0 left-0 bottom-0 right-0 pointer-events-none"></div>
    <div class="scroll-over__frame relative">
      <!-- <?= get_component('image', ['image' => get_stylesheet_directory_uri().'/images/scroll-img.png', 'alt' => 'cityscape', 'cover' => true, 'wrap_classes' => 'z-50 w-full h-e260 md:h-e530 lg:h-e600']) ?> -->
      <video muted loop playsinline paused class="scroll-over__video relative z-50 object-cover w-full h-e600" data-placeholder="<?= get_stylesheet_directory_uri() ?>/images/home-page-hero-image-scaled.jpg">
        <source src="<?= get_stylesheet_directory_uri() ?>/video/scrolltrigger-vid.mp4" type="video/mp4">
      </video>
      <div class="scroll-over__curtain scroll-over__curtain--right z-75 absolute right-0 top-0 h-full w-e240 bg-blue block"></div>
      <div class="scroll-over__curtain scroll-over__curtain--left z-75 absolute left-0 top-0 h-full w-e240 bg-blue block"></div>
    </div>
    <div class="scroll-over__content container relative z-100">
      <div class="flex flex-col md:flex-row md:justify-between md:items-center lg:mb-e120 w-full">
        <div id="panel-0" class="panel__content flex-1">
          <h2 class="h1 text-white mt-e75">We scale ambition at every stage.</h2>
          <p class="text-white text-md lg:text-lg mt-e36">For over <strong>25 years</strong>, Insight Partners has helped companies turn their vision into reality faster and more seamlessly than they every thought possible.</p>
          <p class="text-white mt-e10 mb-e40 lg:mb-0">With connections to our network of <strong>450+</strong> global companies and founders, and our unparalleled operational expertise and capital across each stage of your journey we have what it takes to take your company to the next level and beyond.</p>
        </div>
        <div id="panel-1" class="panel__content flex-1 hidden">
          <h2 class="h1 text-white mt-e75">Scale we at stage every ambition.</h2>
          <p class="text-white text-md lg:text-lg mt-e36">For over <strong>25 years</strong>, Insight Partners has helped companies turn their vision into reality faster and more seamlessly than they every thought possible.</p>
          <p class="text-white mt-e10 mb-e40 lg:mb-0">With connections to our network of <strong>350+</strong> global companies and founders, and our unparalleled operational expertise and capital across each stage of your journey we have what it takes to take your company to the next level and beyond.</p>
        </div>
        <div id="panel-2" class="panel__content flex-1 hidden">
          <h2 class="h1 text-white mt-e75">Stage we scale at every ambition.</h2>
          <p class="text-white text-md lg:text-lg mt-e36">For over <strong>25 years</strong>, Insight Partners has helped companies turn their vision into reality faster and more seamlessly than they every thought possible.</p>
          <p class="text-white mt-e10 mb-e40 lg:mb-0">With connections to our network of <strong>250+</strong> global companies and founders, and our unparalleled operational expertise and capital across each stage of your journey we have what it takes to take your company to the next level and beyond.</p>
        </div>
        <div class="flex-1 flex justify-end mb-e90 lg:mb-0">
          <?= get_component('button', [
              'link' => [
                'url' => '#',
                'title' => 'our team'
              ],
              'arrow' => true,
              'theme' => 'invert'
            ]) ?>
        </div>
      </div>
      <div class="panel-tabs w-full" >
        <div class="panel__btns">
          <button data-panel="panel-0" class="panel__btn pb-2 mr-12 text-sm font-semibold uppercase border-b-2 border-orange text-white">About Us</button>
          <button data-panel="panel-1" class="panel__btn pb-2 mr-12 text-sm font-semibold uppercase text-cadet-blue">Onsite</button>
          <button data-panel="panel-2" class="panel__btn pb-2 mr-12 text-sm font-semibold uppercase text-cadet-blue">Ignite</button>
        </div>
      </div>
    </div>
  </section>
  <?= get_component('image-copy-slider', ['wrap_classes' => 'relative z-100']) ?>
</main>

<?php get_footer(); ?>