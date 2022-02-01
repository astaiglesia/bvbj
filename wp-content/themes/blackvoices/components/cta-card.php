<div class="cta-card bg-white px-e25 py-e30 lg:p-e60 w-full <?= $classes ?>">
    <span class="cta-card__eyebrow text-xs uppercase font-semibold mb-e18 lg:mb-e30 block"><?= $eyebrow ?></span>
    <a href="<?= $url ?>" title="<?= $title ?>">
        <h2 class="cta-card__title mb-e30 text-lg lg:text-2xl block mb-e25 lg:mb-e40"><?= $title ?></h2>
        <?= get_component('arrow', ['wrap_classes' => 'cta-card__arrow', 'size' => 'lg', 'inner_color' => 'bg-blue', 'border_color' => 'border-orange']) ?>
    </a>
</div>
