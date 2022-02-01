<?php get_header(); ?>
<main class="content-page" id="main">
  <?= get_component('page-heading', [
    'title' => get_the_title()
  ])?>
  <div class="container wysiwyg pt--40"><?php
    the_content()?>  
  </div>
</main>
<?php get_footer(); ?>
