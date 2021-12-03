<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset=<?php bloginfo( 'charset' ) ?>>
  <title><?php
    wp_title('|', true, 'right');
    bloginfo( 'title' );?>
  </title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php gora_nav_menu(); ?>
    </div>
  </div>
</nav>
