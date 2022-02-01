<?php
$height = (isset($height)) ? $height : 35;
$width = (isset($width)) ? $width : 35;
$viewbox = (isset($viewbox)) ? $viewbox : '0 0 '.$width.' '.$height;
$title = (isset($title)) ? $title : $icon;

if ($icon) { ?>
  <svg viewBox="<?= $viewbox ?>" data-component="svg" class="svg-icon svg-icon__<?= $icon ?> <?= isset($classes) ? $classes : null ?>" height="<?= $height ?>" width="<?= $width ?>">
    <?= $title ? '<title>'.$title.'</title>' : null ?>
    <use xlink:href="#<?= $icon ?>"></use>
  </svg><?php
}