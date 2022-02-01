<?php
/*
Template Name: Styleguide
*/

get_header();?>

<main class="styleguide bg-white min-h-screen" id="main"><?php
  if(get_field('feat_post')) {
    echo get_component('featured-article', [
      'post' => get_field('feat_post')[0],
      'is_hero' => true
    ]);
    echo '<div class="w-full bg-sky">';
    echo get_component('featured-article', [
      'post' => get_field('feat_post')[0]
    ]);
    echo '</div>';
  }
  
  if(get_field('post_list')) {?>
    <div class="w-full py-e60 bg-sky"><?php
      echo get_component('post-list-featured', [
        'title' => get_field('section_title'),
        'posts' => get_field('post_list')
      ]);?>
    </div>
    <div class="w-full py-e60 bg-blue"><?php
      echo get_component('post-list-featured', [
        'title' => get_field('section_title'),
        'posts' => get_field('post_list')
      ]);?>
    </div><?php
  }
  echo get_component('double-feature', [
    'title' => get_field('double_feature_title'),
    'first' => get_field('first_post'),
    'second' => get_field('second_post'),
    'cta' => get_field('double_feature_cta')
  ])?>
  <div class="container">
    <div class="border-orange border-b py-e30 mb-e100">
      <span class="uppercase font-semibold text-orange">Typestyles</span>
    </div>
    <div class="pb-e100">
      <h1>We help scale up ambitious companies at every stage.</h1>
      <span class="uppercase text-orange font-semibold">homepage hero</span>
    </div>
    <div class="pb-e100">
      <h1>We scale ambition at every stage.</h1>
      <span class="uppercase text-orange font-semibold">h1</span>
    </div>
    <div class="pb-e100">
      <h2>Lorem ipsum dolor sit amet, consectetur lorem ipsum</h2>
      <span class="uppercase text-orange font-semibold">h2</span>
    </div>
    <div class="pb-e100">
      <h3>Lorem ipsum dolor sit amet, consectetur lorem ipsum</h3>
      <span class="uppercase text-orange font-semibold">h3</span>
    </div>
    <div class="pb-e100">
      <h4>Lorem ipsum dolor sit amet, consectetur lorem ipsum</h4>
      <span class="uppercase text-orange font-semibold">h4</span>
    </div>
    <div class="pb-e100">
      <h5>Lorem ipsum dolor sit amet, consectetur lorem ipsum</h5>
      <span class="uppercase text-orange font-semibold">h5</span>
    </div>
    <div class="pb-e100">
      <p>With connections to our network of 450+ global companies and founders, and our unparalleled operational expertise and capital across each stage of your journey we have what it takes to take your company to the next level and beyond.</p>
      <span class="uppercase text-orange font-semibold">body</span>
    </div>
    <div class="pb-e100">
      <p>With connections to our network of 450+ global companies and founders, and our unparalleled operational expertise and capital across each stage of your journey we have what it takes to take your company to the next level and beyond.</p>
      <span class="uppercase text-orange font-semibold">large body</span>
    </div>
    <div class="border-orange border-b py-e30 mb-e100">
      <span class="uppercase font-semibold text-orange">colors</span>
    </div>
    <div class="flex mb-e100">
      <div class="w-e150 mr-e10 h-e150 bg-white border border-sky"></div>
      <div class="w-e150 mr-e10 h-e150 bg-sky"></div>
      <div class="w-e150 mr-e10 h-e150 bg-blue"></div>
      <div class="w-e150 mr-e10 h-e150 bg-orange"></div>
    </div>
    <div class="border-orange border-b py-e30 mb-e100">
      <span class="uppercase font-semibold text-orange">buttons</span>
    </div>
    <div class="pb-20">
      <?= get_component('button', [
        'title' => 'view series',
        'attrs' => [
          'data-something' => 'some value',
          'data-something-else' => 'some other value'
        ],
        'classes' => 'mr-8',
        'arrow' => true
        ]) ?>
      <?= get_component('button', [
        'title' => 'Load More',
        'classes' => 'mr-8'
        ]) ?>
      <?= get_component('button', [
        'link' => [
          'url' => '#',
          'title' => 'view series',
        ],
        'classes' => 'mr-8',
        'arrow' => true
        ]) ?>
      <?= get_component('button', [
        'link' => [
          'url' => '#',
          'title' => 'view series',
        ],
        'classes' => 'mr-8'
        ]) ?>
    </div>
  </div>
  <div class="w-full bg-blue">
    <div class="container py-20">
      <?= get_component('button', [
        'title' => 'view series',
        'theme' => 'invert',
        'classes' => 'mr-8',
        'arrow' => true
        ]) ?>
      <?= get_component('button', [
        'title' => 'Load More',
        'theme' => 'invert',
        'classes' => 'mr-8'
        ]) ?>
      <?= get_component('button', [
        'title' => 'view series',
        'theme' => 'white',
        'classes' => 'mr-8',
        'arrow' => true
        ]) ?>
      <?= get_component('button', [
        'link' => [
          'title' => 'Load More',
          'url' => '#'
        ],
        'theme' => 'white',
        'classes' => 'mr-8',
        'attrs' => [
          'target' => '_blank',
        ]
        ]) ?>
    </div>
  </div>
  <div class="w-full pt-e60 pb-0">
    <div class="container mt-20">
      <div class="border-orange border-b py-e30 mb-e100">
        <span class="uppercase font-semibold text-orange">form elements</span>
      </div>
      <div class="py-8">
        <label for="search" class="search-wrap mr-12">
          <input class="searchterm" type="text" placeholder="Search Company Name" />
        </label>
        <input class="input ml-12 input--text" type="text" placeholder="Search Company Name" />
      </div>
      <div class="py-8">
        <label for="selectname">Dropdowns</label>
        <select class="select" name="selectname">
          <option>Option 1</option>
          <option>Option 2</option>
          <option>Option 3</option>
          <option>Option 4</option>
          <option>Option 5</option>
        </select>
      </div>
      <div class="py-8 flex flex-col">
        <label for="radioname">Radio Buttons</label>
        <input class="mb-8 radio" type="radio" name="radioname"/>
        <input class="mb-8 radio" type="radio" name="radioname"/>
        <input class="mb-8 radio" type="radio" name="radioname"/>
        <input class="mb-8 radio" type="radio" name="radioname"/>
      </div>
      <div class="py-8 flex flex-col">
        <label for="checkboxname">Checkboxes</label>
        <input class="mb-8 checkbox" type="checkbox" name="checkboxname"/>
        <input class="mb-8 checkbox" type="checkbox" name="checkboxname"/>
        <input class="mb-8 checkbox" type="checkbox" name="checkboxname"/>
        <input class="mb-8 checkbox" type="checkbox" name="checkboxname"/>
      </div>
      <div class="py-8 flex flex-col">
        <label for="radioname">Submit Buttons</label>
        <input class="submit" type="submit" name="form-submit"/>
      </div>
    </div>
  </div>
  <div class="w-full bg-sky pt-e60 pb-0">
    <div class="container mt-20">
      <div class="border-orange border-b py-e30 mb-e100">
        <span class="uppercase font-semibold text-orange">Video Trigger</span>
      </div>
      <div class="w-full items-center flex flex-wrap pb-e100">
        <?= get_component('image', [
            'image' => get_stylesheet_directory_uri().'/images/styleguide-video-img.png',
            'wrap_classes' => 'relative',
            'content' => '<div class="play-btn absolute top-0 left-0 h-full w-full flex justify-center items-center hover:opacity-50 transition-all duration-300 cursor-pointer">"'.get_component('svg', ['icon' => 'play', 'width' => 70, 'height' => 70]).'</div>'
          ])?>
      </div>
      <div class="border-orange border-b py-e30 mb-e100">
        <span class="uppercase font-semibold text-orange">CTA Card</span>
      </div>
      <div class="cta-card bg-white p-e60 w-1/2 mb-e100">
        <span class="text-md uppercase font-semibold mb-e30 block">PRIMARY TOPIC</span>
        <a href="#"><h3 class="mb-e30 block">The ScaleUp Guide to Analyst Relations: A Fast Track to Enterprise Credibility</h3>
        <?= get_component('arrow', ['size' => 'lg', 'inner_color' => 'bg-blue', 'border_color' => 'border-orange']) ?></a>
      </div>
      <div class="border-orange border-b py-e30 mb-e100">
        <span class="uppercase font-semibold text-orange">SVG/Icons</span>
      </div>
      <div class="w-full items-center flex flex-wrap">
        <span class="text-fiord hover:text-orange mx-4"><?= get_component('svg', ['icon' => 'twitter', 'width' => 18, 'height' => 18, 'viewbox' => '0 0 17 14']) ?></span>
        <span class="text-fiord hover:text-orange mx-4"><?= get_component('svg', ['icon' => 'facebook', 'width' => 18, 'height' => 18, 'viewbox' => '0 0 10 19']) ?></span>
        <span class="text-fiord hover:text-orange mx-4"><?= get_component('svg', ['icon' => 'linkedin', 'width' => 18, 'height' => 18, 'viewbox' => '0 0 17 17']) ?></span>
        <span class="text-fiord hover:text-orange mx-4"><?= get_component('svg', ['icon' => 'email', 'width' => 18, 'height' => 18, 'viewbox' => '0 0 20 16']) ?></span>
      </div>
      <div class="border-orange border-b py-e30 mb-e100">
        <span class="uppercase font-semibold text-orange">logos</span>
      </div>
      <div class="w-full items-center flex flex-wrap">
        <span class="text-white m-10"><?= get_component('svg', ['icon' => 'main-logo', 'width' => 145.771, 'height' => 49.904]) ?></span>
        <span class="text-white m-10"><?= get_component('svg', ['icon' => 'mini-logo', 'width' => 60, 'height' => 60]) ?></span>
        <span class="text-white m-10"><?= get_component('svg', ['icon' => 'footer-banner-logo', 'classes' => 'w-full', 'width' => 1440, 'height' => 246, 'viebox' => '0 0 1440 246']) ?></span>
      </div>      
    </div>
  </div>
</main>

<?php get_footer(); ?>