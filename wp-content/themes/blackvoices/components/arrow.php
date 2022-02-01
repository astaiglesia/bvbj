<?php
// directions available: left, right, top-right, top-left, bottom-right, bottom-left
$direction = $direction ?? 'top-right';
$wrap_classes = $wrap_classes ?? 'block relative';
$head_classes = $head_classes ?? '';
$inner_classes = $inner_classes ?? '';
$inner_color = $inner_color ?? '';
$border_color = $border_color ?? '';

$size = $size ?? false;
$head_classes .= '';
$inner_classes .= $inner_color ? $inner_color : ' bg-white';
$head_classes .= $border_color ? ' '.$border_color : ' border-white';

switch($direction) {
  case 'left':
    $wrap_classes .= ' -rotate-135';
    break;

  case 'right':
    $wrap_classes .= ' rotate-45';
    break;

  case 'top-right':
    $wrap_classes .= ' overflow-hidden';
    break;

  case 'top-left':
    $wrap_classes .= ' -rotate-90 overflow-hidden';
    break;

  case 'bottom-right':
    $wrap_classes .= ' rotate-90 overflow-hidden';
    break;

  case 'bottom-left':
    $wrap_classes .= ' rotate-180 overflow-hidden';
    break;
}?>

<div class="arrow <?= $size ? 'arrow--'.$size : null ?> arrow--<?= $direction ?> <?= $wrap_classes ?>">
  <div class="arrow__outter pointer-events-none transition-colors duration-500 border-t border-r transform <?= $head_classes ?>"></div>
  <div class="arrow__inner pointer-events-none transition-colors duration-500 -rotate-45 h-e1 block absolute <?= $inner_classes ?>"></div>
</div>