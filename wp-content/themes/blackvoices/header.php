<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><?php
  global $post;
  $thumbnail = $post->post_type === 'post' ? get_field('post_image') : get_the_post_thumbnail_url();?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#fafafa">
  <link rel="manifest" href="site.webmanifest">
  <meta property="og:image" content="<?= $post->post_type === 'post' ? $thumbnail['url'] : $thumbnail ?>">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <!-- <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> -->
  <link rel="manifest" href="/site.webmanifest">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
  <?= get_component('svg-defs') ?>
  <?= get_component('header')?>