<?php

/******************************
 *  CUSTOM POST TYPES
 ******************************/
$dir_custom_post_types = 'custom-post-types';


/******************************
 *  CUSTOM POST TYPES TAXONOMIES
 ******************************/

$dir_custom_post_types_taxonomies = 'custom-post-types/taxonomies';

/******************************
 *  ACF Página de opções
 ******************************/

require('custom-fields/option-fields.php');

if (function_exists('acf_add_options_page')) {

  // acf_add_options_page(array(
  //   'page_title'   => 'Informações do Cabeçalho e Rodapé',
  //   'menu_title'  => 'Cabeçalho/Rodapé',
  //   'menu_slug'   => 'header-footer',
  //   'capability'  => 'edit_posts',
  //   'icon_url'    => 'dashicons-admin-home',
  //   'redirect'    => false,
  // ));
}

/******************************
 *  ACF Página de produtos
 ******************************/

require('custom-fields/post-fields.php');

// Suporte para thumbs
add_theme_support('post-thumbnails');

// Remove as paginas da pesquisa
function query_post_conditional($query)
{
  if (!is_admin() && $query->is_main_query()) {
    if (is_search()) {
      $query->set('posts_per_page', 6);
      $query->set('post_type', array('post', 'produtos'));
      $query->set('category__not_in', 1);
      return;
    }
  }
}

add_action('pre_get_posts', 'query_post_conditional');

//========== Registrar os Scripts ==========//
function registerScripts()
{
  // Register Main
  wp_register_script('main', get_template_directory_uri() . '/dist/js/main.js', array(), false, true);
  // Register App
  wp_register_script('app', get_template_directory_uri() . '/dist/js/app.js', array(), false, true);
  // Register Slick
  wp_register_script('slick', get_template_directory_uri() . '/libs/slick/slick.js', array(), false, true);
  // Carrega todos os scripts
  wp_enqueue_script('main');
  wp_enqueue_script('slick');
  wp_enqueue_script('app');
}
add_action('wp_enqueue_scripts', 'registerScripts');

//========== Registrar Styles ==========//
function registerStyles()
{
  // Register style
  wp_register_style('style', get_template_directory_uri() . '/dist/css/style.css', array(), false, false);
  // Register slick css
  wp_register_style('slick', get_template_directory_uri() . '/libs/slick/slick.css', array(), false, false);
  wp_register_style('slick-theme', get_template_directory_uri() . '/libs/slick/slick-theme.css', array(), false, false);

  // Carrega todos as folhas de estilo
  wp_enqueue_style('style');
  wp_enqueue_style('slick');
  wp_enqueue_style('slick-theme');
}
add_action('wp_enqueue_scripts', 'registerStyles');
