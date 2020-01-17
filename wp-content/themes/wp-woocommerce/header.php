<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php if (is_home()) { ?>
    <title><?php bloginfo('name'); ?> <?php wp_title('-'); ?><?php bloginfo('description'); ?> </title>
  <?php } else { ?>
    <title><?php bloginfo('name'); ?> <?php wp_title('-'); ?></title>
  <?php } ?>

  <!-- <link rel="icon" href="<?php //echo get_template_directory_uri(); ?>/favicon.png"> -->
  <!-- <script src="https://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> -->

  <!-- Inicio Header Wordpress -->
  <?php wp_head(); ?>
  <!-- Fim Header Wordpress -->
</head>

<body>

  <header class="header">
    
  </header>

  <main>