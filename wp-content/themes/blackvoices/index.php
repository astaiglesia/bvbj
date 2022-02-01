<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <main class="content"><?= get_the_content() ?></main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
