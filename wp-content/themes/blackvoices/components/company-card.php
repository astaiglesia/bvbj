<div class="company-card bg-white hover:bg-magenta">
  <div class="flex justify-center items-center h-full">
    <?php if ($logo): ?>
      <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
    <?php else: ?>
      <h4><?= $name ?></h4>
    <?php endif ?>
  </div>
  <p class="location"><?= $location ?></p>
</div>