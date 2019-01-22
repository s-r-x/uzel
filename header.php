<!doctype html>
<html lang="ru">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<title><?php wp_title('-', true, 'right'); bloginfo('name'); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head()?>
</head>
<body <?php body_class(); ?>>
<div class="loader">
<img src="<?php echo get_template_directory_uri();?>/assets/loaders/oval.svg" alt="">
</div>
<script src="<?php echo get_template_directory_uri();?>/assets/preloader.js?ver=1.2.7"></script>
<div class="main-container" id="main-container">
<?php if(has_nav_menu('primary')) :
?>
<div class="top-menu-wrap">
<?php wp_nav_menu([
  'menu' => 'primary',
  'container' => false,
  'items_wrap' => '<ul id="%1$s" class="%2$s">
  %3$s</ul>',
'menu_class' => 'top-menu'
  ]); ?>
</div>
<?php endif;?> 
<div class="custom-search-form">
  <button class="cancel-search">&times</button>
<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
  <label for="">Искать на сайте</label>
  <input placeholder="Что ищем?" type="text" value name="s" id="s">
  <input type="submit" id="searchsubmit" class="button" value="Искать">
</form>
</div>
<div class="top-sticky">
  <div class="container">
  <div class="row top-sticky--inner">
    <button class="hamburger">
      <span class="hamburger--top"></span>
      <span class="hamburger--middle"></span>
      <span class="hamburger--bottom"></span>
    </button>
<div class="top-sticky--right">
<button class="top-search-btn" aria-hidden="открыть форму поиска">
  <i class="icon-search-1"></i>
</button>
<label class="theme-toggle">
  <input type="checkbox">
  <span class="theme-toggle--circle"></span>
  <i class="theme-toggle--ic icon-sun"></i>
  <i class="theme-toggle--ic icon-moon-inv"></i>
</label>
</div>
  </div>
</div>
</div>
<div class="container">
<?php if(get_theme_mod('uzel_identity_header', true)):
get_template_part('layouts/identity_header');
?>
<?php endif;?>
<?php if(get_theme_mod('show_slider', true) && is_front_page()):
  get_template_part('layouts/slider');
?>
<?php endif; ?>
</div>
<div class="container">
<div class="row">
