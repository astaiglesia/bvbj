<?php
$add_authors = false;

if($post) {
    if($add_authors) {
        $authors = ['author 1', 'author 2'];
    }?>
    <div class="post-list-item w-full border-t lg:border-0 lg:border-b pt-e18 lg:pb-e20 lg:pt-e0 mb-e30"><?php
        if($eyebrow) {?>
            <span class="block text-xs font-semibold uppercase mb-e10"><?= $eyebrow ?></span><?php
        }?>
        <a href="<?= get_the_permalink($post) ?>"><h4 class="text-md lg:text-md-alt2"><?= get_the_title($post) ?></h4></a><?php
        $i = 1;
        if($add_authors) {
            foreach($authors as $author) {?>
                <span class=""><?= $i < sizeof($authors) ? $author.', ' : $author ?></span><?php
                $i++;
            }
        }?>
    </div><?php
}
