<?php
if($id) {
  $link = get_field('portfolio_link', $id);?>

  <div class="piano-key-modal__inner opacity-0">
    <div class="piano-key-modal__bg" style="background-color:<?= get_field('key_background_color', $id) ?>">
    </div><?php
    if(have_rows('case_studies', $id)) {
      $index = 0;
      while(have_rows('case_studies', $id)) {
        the_row();
        $index++;?>
        <div class="piano-key-modal__container container relative z-150 flex items-center justify-center<?= $index === 1 ? ' block' : ' hidden' ?>" data-slide-index="<?= $index ?>">
          <div class="piano-key-modal__content flex flex-col items-start">
            <?= get_component('image', ['image' => get_field('key_logo', $id), 'alt' => 'company logo', 'wrap_classes' => 'piano-key-modal__logo']) ?>
            <span class="piano-key-modal__title"><?= get_sub_field('headline') ?></span>
            <div class="piano-key-modal__desc">
              <?= get_sub_field('description') ?>
            </div><?php
            if(have_rows('tag_columns', $id)) {
              echo '<div class="piano-key-modal__tags">';
              while(have_rows('tag_columns', $id)) {
                the_row();

                if(have_rows('column', $id)) {
                  echo '<div class="piano-key-modal__column">';
                  while(have_rows('column', $id)) {
                    the_row();?>
                    <span class="piano-key-modal__tag<?= get_sub_field('bold') ? ' font-bold' : null ?>"><?= get_sub_field('tag') ?></span><?php
                  }
                  echo '</div>';
                }
              }
              echo '</div>';
            }
            
            if($link) {?>
              <div>
                <?= get_component('button', [
                  'link' => [
                    'url' => $link['url'],
                    'title' => $link['title']
                  ],
                  'classes' => 'piano-key-modal__study-link',
                  'arrow' => true,
                  'theme' => 'white'
                ]) ?>
              </div><?php
            }?>
          </div>
          <div>
            <?= get_component('image', ['image' => get_sub_field('case_study_image'), 'alt' => 'company background image', 'cover' => true, 'wrap_classes' => 'piano-key-modal__image', 'class' => '']) ?>
          </div>
        </div><?php
      }
    }?>
    <div class="piano-key-modal__actions">
      <div class="piano-key-modal__close text-white"><?= get_component('svg', ['icon' => 'close', 'viewbox' => '0 0 20 20']) ?></div>
      <div class="piano-key-modal__actions-bottom">
        <span class="piano-key-modal__next"><?= get_component('arrow', ['direction' => 'right', 'inner_color' => 'bg-white', 'wrap_classes' => 'piano-key-modal__icon']) ?></span>
        <span class="piano-key-modal__position"><span class="piano-key-modal__index">1</span> / <span class="piano-key-modal__amount"></span><?= $index ?></span>
        <span class="piano-key-modal__prev"><?= get_component('arrow', ['direction' => 'left', 'inner_color' => 'bg-white', 'wrap_classes' => 'piano-key-modal__icon']) ?></span>
      </div>
    </div>
  </div><?php
}