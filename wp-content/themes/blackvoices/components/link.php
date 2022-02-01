<?php
// if an acf link object was passed
if (isset($link_obj)) {
  $url = $link_obj['url'];
  $title = $link_obj['title'];
  $html = $html ?? $link_obj['title'];
  $target = $link_obj['target'] ? $link_obj['target'] : false;
}

// these will override $link_obj if $link_obj is set
$url = $url ? $url : null;
$classes = isset($classes) ? 'link ' . $classes : 'link';
$html = $html ?? null;
$target = $target ?? false;
$title = $title ?? '';
$attributes = $attributes ?? '';

if ($url) { ?>
  <a href="<?= $url ?>" <?= ($target) ? 'target="'.$target.'"' : null ?> class="<?= $classes ?>" title="<?= $title ?>" <?= $attributes ?>><?= $html ? $html : $title ?></a><?php
}