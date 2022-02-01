<?php
global $wp_query;
$total = $wp_query->found_posts;
get_header();
?>

<main class="content-page" id="main">
  <section class="page-heading">
    <div class="bg-image is-hidden-desktop" style="background-image: url('<?= get_template_directory_uri() ?>/images/search-bg-mobile.png')"></div>
    <div class="bg-image is-hidden-touch" style="background-image: url('<?= get_template_directory_uri() ?>/images/search-bg-desktop.png')"></div>
    <div class="container">
      <div class="columns">
        <div class="column is-10-desktop is-offset-1-desktop is-8-widescreen is-offset-2-widescreen">
          <h1 class="is-sr-only">Search</h1>
          <?php get_search_form(); ?>
        </div>
      </div>
    </div>
  </section>

  <section class="search-results">
    <div class="container">
      <div class="columns">
        <div class="column is-10-desktop is-offset-1-desktop is-8-widescreen is-offset-2-widescreen">
          <h2 class="h4">Showing <?= $total ?> Result<?= $total != 1 ? 's' : '' ?> for:
            <span class="search-string">
              "<?php echo esc_attr(get_search_query()); ?>"
            </span>
          </h2>
          <?php if (have_posts()) :
            while (have_posts()) : the_post();
              $excerpt = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
              if(!$excerpt) {
                switch(get_post_type()) {
                  case 'materials':
                    $excerpt = get_field('description');
                    break;
                  default:
                    $excerpt = get_the_excerpt();
                    break;
                }
              } else {
                $excerpt = '<p>'. $excerpt.'</p>';
              }
              $link = get_the_permalink();
              $target = null;
              if(get_post_type() === 'msds' || get_post_type() === 'gradation' || get_post_type() === 'ebooks') {
                $link = get_field('download');
                $link = $link['url'];
                $target = ' target=_blank"';
              }?>
              <div class="search-result">
                <div class="eyebrow"><?= get_post_type() ?></div>
                <a href="<?= $link ?>" title="<?= get_the_title() ?>" <?= $target ?>>
                  <h3 class="h6"><?php the_title(); ?></h3>
                </a>
                <div class="excerpt">
                  <?= $excerpt ?>
                </div>
              </div>
            <?php endwhile;
            pagination_helper(); ?>
          <?php else : ?>
            <div class="no-results">
              No results were found.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>