<?php
$share_link = get_field('footer_share_link', 'option');?>

<?= get_component('newsletter-signup') ?>
<footer class="footer bg-pale-grey w-full py-10">
  <div class="container">
    <div class="flex flex-col lg:flex-row lg:justify-between mt-e70 lg:my-e60">
      <?= get_field('footer_description', 'option') ?>
      <?= get_field('footer_copyright', 'option') ?>
      <a href="<?= $share_link['url'] ?>" class="" title="<?= $share_link['title'] ?>" target=""><?= get_component('image', ['image' => get_field('footer_share_icon', 'option')]) ?><span class=""><?= $share_link['title'] ?></span></span></a>
    </div>
  </div>
</footer>