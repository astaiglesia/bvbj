<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// print_r($block);
// print_r($content);
// print_r($is_preview);
// print_r($post_id);
$id = 'block-demo__' . $block['id'];

// Load values and assign defaults.
$text = get_field('test_text') ?: 'Your text...';
$image = get_field('test_image') ?: false;?>

<div id="<?php echo esc_attr($id); ?>" class="block-demo" data-component="block-demo">
    <span class="block-demo__text text-orange md:text-white text-3xl lg:text-4xl"><?= $text; ?></span>
    <?= $image ? get_component('image', ['image' => $image, 'wrap_classes' => 'block-demo__image', 'cover' => true]) : null ?>
    <style>
        <?= '#'.$id ?> {
            background-color: <?= get_field('test_background_color'); ?>
        }
    </style>
</div>