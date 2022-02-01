<?php
if($keys) {?>
  <section class="piano-key-carousel" data-component="piano-key-carousel">
    <div class="container relative z-100">
      <button class="piano-key__button piano-key__button--prev opacity-0">
        <?= get_component('svg', ['icon' => 'arrow-right', 'viewbox' => '0 0 45.947 45.658', 'height' => 45, 'width' => 45]) ?>
        <span class="sr-only">Previous slide</span>
      </button>
      <button class="piano-key__button piano-key__button--next opacity-0">
        <?= get_component('svg', ['icon' => 'arrow-left', 'viewbox' => '0 0 45.947 45.658', 'height' => 45, 'width' => 45]) ?>
        <span class="sr-only">Next slide</span>
      </button>
      <!--  h-e740 w-full flex relative z-100 -top-e240 -->
      <div class="piano-key-carousel__slide-container relative z-100 flex flex-nowrap overflow-visible"><?php
        foreach($keys as $key) {?>
          <div class="carousel__card carousel__card--<?= get_field('text_color', $key) ?>" data-post="<?= $key ?>">
            <div class="carousel__card-content">
              <div class="carousel__card-inner">
                <?= get_component('image', ['image' => get_field('key_logo', $key), 'alt' => 'company logo', 'wrap_classes' => 'carousel__card-logo']) ?>
                <?= get_component('svg', ['icon' => 'close', 'classes' => 'carousel__card-close', 'viewbox' => '0 0 20 20']) ?>
                <?= get_component('image', ['image' => get_stylesheet_directory_uri(). '/images/hp-bullhorn.jpg', 'alt' => 'company background image', 'cover' => true, 'wrap_classes' => 'carousel__card-bk', 'class' => 'object-left h-full']) ?>
                <span class="carousel__card-label absolute bottom-6 left-6 text-white text-xs font-semibold uppercase">Stage</span>
                <div class="carousel__subcard">
                  <div class="subcard__content">
                    <div class="subcard__inner"><?php
                      $link = get_field('portfolio_link', $key);
                      if($link) {?>
                        <a href="<?= $link['url'] ?>" class="subcard__modal-link" data-post="<?= $key ?>"><?= get_component('arrow', ['direction' => 'top-right', 'inner_color' => 'bg-purple-lt', 'wrap_classes' => 'subcard__icon pointer-events-none']) ?></a><?php
                      }?>
                      <span class="subcard__eyebrow"><?= get_field('study_eyebrow', $key) ?></span>
                      <div class="subcard__facts"><?php
                        $i = 0;
                        while(have_rows('case_studies', $key)) {
                          the_row();?>
                          <span class="subcard__fact <?= $i > 0 ? 'hidden' : null ?>"><?= get_sub_field('headline') ?></span><?php
                          $i++;
                        }?>
                      </div>
                      <span class="subcard__progress-track"><span class="subcard__progress">&nbsp;</span></span>
                      <div class="subcard__mid">
                        <span class="subcard__tags"><?= get_field('key_bottom_copy', $key) ?></span>
                        <span class="subcard__category"><?= get_field('location', $key) ?></span>
                      </div>
                    </div><?php
                      if($link) {?>
                        <a href="<?= $link['url'] ?>" class="subcard__bottom">
                          <span class="subcard__link-text"><?= $link['title'] ?></span>
                          <?= get_component('arrow', ['direction' => 'top-right', 'inner_color' => 'bg-purple-lt', 'wrap_classes' => 'subcard__icon subcard__icon--mobile']) ?>
                        </a><?php
                      }?>
                  </div>
                </div>
              </div>
            </div>
          </div><?php
        }?>
      </div>
    </div>
    <div class="container">
      <span class="piano-key-carousel__progress-track bg-sky-dk w-full h-e3 block mt-e50 mb-e100 lg:mt-e60 md:mb-e110 lg:mb-e150">
        <span class="piano-key-carousel__progress-handle bg-sky-lt h-e3 block w-0" style="transform: translate3d(0px, 0px, 0px); cursor: move; touch-action: pan-y; user-select: none; z-index: 1000;"></span>
      </span>
    </div>
    <?= get_component('piano-key-modal', ['id' => $key]) ?>
  </section><?php
}