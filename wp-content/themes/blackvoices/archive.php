<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="content-archive">

  <div class="container">
    <h1><?php the_title(); ?></h1>
    <div class="content-inner">
      <?php the_content(); ?>
    </div>
  </div>

</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
