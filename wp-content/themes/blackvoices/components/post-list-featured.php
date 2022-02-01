<?php
/*****
 * @param $posts: array -- An array of post IDs
 */

if($posts) {
    $featured = array_shift($posts);?>
    <section class="post-list-featured">
        <div class="container">
            <div class="flex flex-col lg:flex-row w-full lg:justify-between">
                <h2 class="text-lg block mb-e20 lg:text-3xl whitespace-nowrap"><?= $title ?></h2>
                <div class="post-list-featured__list order-3 lg:order-2 lg:max-w-e330 lg:pt-e30"><?php
                    foreach($posts as $post) {
                        $cat = yoast_get_primary_category($post);
                        echo get_component('post-list-item', ['post' => $post, 'eyebrow' => $cat ? $cat->name : false]);
                    }?>
                </div><?php

                echo get_component('post-card', ['post' => $featured, 'classes' => 'w-full order-2 lg:order-3 lg:w-1/3']);?>
            </div>
        </div>
    </section><?php
}
