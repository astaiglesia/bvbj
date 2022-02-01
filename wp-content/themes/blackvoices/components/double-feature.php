<section class="double-feature py-e40 lg:py-e60 w-full overflow-hidden" data-component="double-feature">
    <div class="container overflow-visible lg:overflow-hidden">
        <h2 class="lg:hidden text-lg block mb-e20"><?= $title ?></h2>
        <div class="justify-between pr-e110 hidden lg:flex">
            <div class="pr-e60"><?= get_component('post-card', ['post' => $first]) ?></div>
            <div class="pl-e60">
                <h2 class="mb-e30 text-3xl"><?= $title ?></h2>
                <?= get_component('post-card', ['post' => $second]) ?>
                <?= get_component('button', ['link' => $cta, 'arrow' => true, 'classes' => 'mt-e60']) ?>
            </div>
        </div>
        <!-- TODO: break this out into post-slider cmp -->
        <div class="glide lg:hidden mb-e40">
            <div class="glide__track max-w-e330" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide max-w-e330">
                        <?= get_component('post-card', ['post' => $first, 'add_authors' => true]) ?>
                    </li>
                    <li class="glide__slide max-w-e330">
                        <?= get_component('post-card', ['post' => $second, 'add_authors' => true]) ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end post-slider -->
        <?= get_component('button', ['link' => $cta, 'arrow' => true, 'classes' => 'lg:hidden w-full']) ?>
    </div>
</section>
