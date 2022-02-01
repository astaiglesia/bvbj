<?php
$authors = false;
$classes = $classes ? $classes : null;

if($post) {
    $cat = yoast_get_primary_category($post);
    $image = $image ? $image : get_post_thumbnail_id($post);

    if($add_authors) {
        $authors = ['Author 1', 'Author 2'];
    }?>

    <article class="post-card <?= $classes ?>"><?php
        if($image) {
            echo get_component('image', ['image' => $image, 'contain' => true, 'wrap_classes' => 'post-card__image w-full mb-e20 lg:mb-e40']);
        }
        if($cat){?>
            <span class="block text-xs font-semibold uppercase mb-e10"><?= $cat->name ?></span><?php
        }?>
        <a href="<?= get_the_permalink($post) ?>"><h3 class="text-md lg:text-xl w-full lg:max-w-e330"><?= get_the_title($post) ?></h3></a><?php
        $i = 1;
        if($add_authors) {
            foreach($authors as $author) {?>
                <span class="inline-block text-sm mt-e15 lg:mt-e25"><?= $i < sizeof($authors) ? $author.', ' : $author ?></span><?php
                $i++;
            }
        }?>
    </article><?php
}