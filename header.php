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
<script src="<?php echo get_template_directory_uri();?>/assets/preloader.js?ver=1.2.3"></script>
<button class="hamburger hamburger--spring menu-toggle-btn" type="button">
   <span class="hamburger-box">
    <span class="hamburger-inner"></span>
   </span>
</button> 
<div class="main-container">
<div class="container-fluid">
<?php if(has_nav_menu('primary')) :
?>
<div class="sticky-menu">
  <?php wp_nav_menu([
    'menu' => 'primary',
    'container' => false,
    'items_wrap' => '<ul id="%1$s" class="%2$s">
    %3$s</ul>',
    'menu_class' => 'container-fluid menu-items'
  ]); ?>
</div>
<?php endif;?> 
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
