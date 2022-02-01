<?php
/****** params
 * $title: string (required): the buttons copy
 * $link: array([url, title]): will add a link tag/href if added. defaults to 'button'. 
 * $arrow: bool: will add an arrow and button hover state if true. colors will be based on button theme
 * $attrs: array([attr => value]) any additional attributes for a link or a button 
 * $theme: str: if unset, use the default theme (orange borders, dark text) otherwise use the selected theme [white, invert]
 * */

// set up button classes
$class = 'button';
$class .= $theme ? ' button--'.$theme : '';
$class .= $arrow ? ' button--arrow' : '';
$class .= $classes ? ' '.$classes : '';

// set up a string of any attributes passed
if(isset($attrs) && is_array($attrs)) {
    $attributes = '';
    foreach($attrs as $k => $v) {
        $attributes .= $k.'="'.$v.'" ';
    }
}

// maybe add the arrow and style it to the given theme
if($arrow) {
    $arrow_args = [
        'size' => 'sm',
        'inner_color' => 'bg-blue',
        'border_color' => 'border-orange'
    ];

    if($theme === 'invert') {
        $arrow_args['inner_color'] = 'bg-white';
    }

    if($theme === 'white') {
        $arrow_args['inner_color'] = 'bg-white';
        $arrow_args['border_color'] = 'border-white';
    }
}

if($link['url']) {?>
    <a href="<?= $link['url'] ?>" class="<?= $class ?>" <?= $attributes ?>><?= $link['title'] ?> <?= $arrow ? get_component('arrow', $arrow_args) : null ?></a><?php
} else {?>
    <button class="<?= $class ?>" <?= $attributes ?>><?= $title ?> <?= $arrow ? get_component('arrow', $arrow_args) : null ?></button><?php
}

