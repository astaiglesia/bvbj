<?php
/**** 
 * @param $post: int|str -- the post ID
 * @param $classes: str -- additional classes to wrap the component in
 * @param $is_hero: bool -- if true, will render out the page title. use in hero areas
*****/

if($post){
    $page_title = false;
    $post_title = get_the_title($post);
    $is_hero = $is_hero ? $is_hero : false;
    $image = get_field('feat_image') ? get_field('feat_image') : get_post_thumbnail_id($post);
    $cat = yoast_get_primary_category($post);
    $classes = $classes ? $classes : '';

    if($is_hero) {
        $page_title = get_field('feat_title', get_the_ID()) ? get_field('feat_title', get_the_ID()) : get_the_title();
    }?>

    <section class="featured-article <?= $is_hero ? 'pt-e100 bg-blue' : 'py-e60' ?>"><?php
        if($page_title) {?>
            <div class="featured-post__top">
                <div class="container">
                    <h1 class="text-4xl lg:text-8xl text-sky mb-e30"><?= $page_title ?></h1>
                </div>
            </div><?php
        }?>
        <div class="featured-post__content relative lg:flex <?= $is_hero ? 'lg:after:content-[] lg:after:h-1/2 after:w-full after:bg-sky after:block after:absolute after:left-0 after:bottom-0' : null ?>">
            <div class="block lg:hidden container relative z-100">
                <?= get_component('image', ['image' => $image, 'wrap_classes' => 'w-full lg:w-3/5']) ?>
            </div>
            <div class="container relative z-100 <?= $is_hero ? 'lg:after:hidden after:content-[] after:h-1/2 after:-left-full after:-right-full after:bg-sky after:block after:absolute after:left-0 after:bottom-0' : null ?>">
                <?= get_component('image', ['image' => $image, 'wrap_classes' => 'hidden lg:block w-full lg:w-3/5']) ?>
                <?= get_component('cta-card', ['eyebrow' => $cat ? $cat->name : false, 'title' => $post_title, 'url' => get_the_permalink($post), 'classes' => 'relative z-125 lg:w-1/2 lg:absolute lg:top-1/2 lg:right-e15 lg:-translate-y-1/2']) ?>
            </div>
        </div>
    </section><?php
}
