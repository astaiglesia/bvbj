<?php
/*
* Editted 404 template to bring in CMS Page Not Found
*/
?>

<?php get_header(); ?>

<?php
$nopage_query = new WP_Query( array( 'page_id' => 537 ) );
if ( $nopage_query->have_posts() ) : ?>
<?php while ( $nopage_query->have_posts() ) : $nopage_query->the_post(); ?>

<?php
$bottom_bk_color = get_field('bottom_background') ? get_field('bottom_background') : 'white';
$switch = get_field('use_language_switch') && get_field('language_link') ? get_field('use_language_switch') : false;
$eyebrow = false;
$hero_background = get_field('hero_background_image') ? get_field('hero_background_image') : null;

if ($switch && get_field('language_link')) {
  $eyebrow = '<div class="language-links">';
  $eyebrow .= get_component('link', [
    'url' => site_url().$_SERVER['REQUEST_URI'],
    'title' => get_the_title(),
    'html' => get_field('current_page_language_label'),
    'classes' => 'cta-link cta-link--white active'
  ]);

  $eyebrow .= get_component('link', [
    'link_obj' => get_field('language_link'),
    'classes' => 'cta-link cta-link--white'
  ]);
  $eyebrow .= '</div>';
}?>

<main class="standard-content" id="main">
  <?= get_component('hero-standard-content',[
    'title' => get_field('alternative_title') ? get_field('alternative_title') : get_the_title(),
    'cover' => true,
    'small' => true,
    'eyebrow_html' => $eyebrow,
    'background' => $hero_background ? $hero_background['url'] : null
  ]) ?>

  <div class="standard-content__content section">
    <div class="container">
      <div class="columns">
        <div class="column">
          <?= get_the_content() ?>
        </div>
      </div>
    </div>
  </div><?php

  if (get_field('bottom_cta')) {?>
    <section class="standard-content__cta section">
      <div class="container">
        <div class="columns">
          <div class="column is-align-items-center is-justify-content-center is-flex">
            <?= get_component('link', ['link_obj' => get_field('bottom_cta'), 'classes' => 'button']) ?>
          </div>
        </div>
      </div>
    </section><?php
  }?>

  <div class="standard-content__links bk--<?= $bottom_bk_color ?>">
    <?= get_component('helpful-links', [
      'title' => get_field('hl_title'),
      'links' => get_field('hl_links'),
    ]) ?>
  </div>
  <?php endwhile; ?>
  <?php else : //Adding in case anyone ever deletes the CMS page?>
    
    <section class="hero-standard-content section bk--black hero-standard-content--small hero-standard-content--cover hero-standard-content--bk"><div class="hero-standard-content__background hero-standard-content__background--small bk--black">
      <div class="container">
        <div class="hero-standard-content__content is-flex is-align-items-center is-justify-content-center is-flex-direction-column">
          <h1 class="h2 color--white has-text-centered mb-6 px-4">Page Not Found.</h1>          
        </div>
      </div>
    </section>
    <div class="standard-content__content section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <p>The page you are looking for cannot be found. Please click <a href="/">HERE</a> to go to the home page or use one of the helpful links below.</p>
          </div>
        </div>
      </div>
    </div>

  
</main>
<?php endif; ?>
  
</main>
<?php get_footer(); ?>