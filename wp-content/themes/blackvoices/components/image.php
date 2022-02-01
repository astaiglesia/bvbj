<?php
$srcset_sizes = !empty($srcset_sizes) ? $srcset_sizes : '(min-width: 1200px) 100vw, (min-width: 768px) 100vw, calc(100vw - 36px)';
$alt = !empty($alt) ? $alt : '';
$class = $class ?? '';

$wrap_classes = $wrap_classes ?? '';
if (!empty($classes)){
  $class .= ' '.$classes;
}

if (!empty($cover)) {
  $class .= ' image--cover';
}

if (!empty($contain)) {
  $class .= ' image--contain';
}

if (!empty($pos_center)) {
  $class .= ' image--pos-center';
}

if (!empty($ellipse)) {
  $class .= ' image--ellipse';
}

if (!empty($content)) {
  $class .= ' image--content';
}

if (empty($default_size)) {
  $default_size = 'medium,';
}

if (empty($attributes)) {
  $attributes = '';
}?>

<figure class="image <?= $class.' '.$wrap_classes ?>" data-component="image" <?= $attributes; ?>>
  <?php
  if (!empty($image)) {
    if( is_array($image) ) {
      $id = $image['ID'];
      $img = wp_get_attachment_image_src( $id, $default_size )[0];
    } elseif (is_numeric($image)) {
      $id = $image;
      $img = wp_get_attachment_image_src( $id, $default_size )[0];
    } else {
      $id = null;
      $img = $image;
    }

    if ( !empty( $id ) && empty( $alt ) ) {
      $alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    }

    if ( empty( $img ) ) {
      return;
    }

    $srcset = wp_get_attachment_image_srcset($id,array( 400, 200 )) ? wp_get_attachment_image_srcset($id,array( 400, 200 )) : $img;?>
    <img src="<?= $img ?>" class="image__img <?= $class ?>" srcset="<?= $srcset ?>" alt="<?= $alt?>" <?= $img !== $srcset ? 'sizes="'.$srcset_sizes.'"' : null ?> /><?php
  }

  if (!empty($content)) {
    echo $content;
  }?>
</figure>