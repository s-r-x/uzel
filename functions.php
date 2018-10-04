<?php 

include get_template_directory()."/inc/utils.php";

//content width
if ( ! isset ( $content_width) ) $content_width = 1440; 
// main setup
function uzel_setup() {
  // menu
  register_nav_menus( [ 'primary'   => 'Primary Menu' ] );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats',  array ('image', 'video' ) );
}
add_action('after_setup_theme', 'uzel_setup');
add_image_size( 'slider', 1440);
add_image_size( 'thumbnail-max', 1170);
add_image_size('thumbnail-list', 400);
add_image_size('thumbnail-grid', 730);
add_image_size( 'thumbnail-normal', 1170);

// images max size
/*
function uzel_post_thumbnail_sizes_attr($attr, $attachment, $size) {
  $sizes = [
    'thumbnail-list' => '(max-width: 991px) 100vw, 768px',
    'slider' => '(max-width: 1440px) 100vw, 1440px',
    'thumbnail-normal' => uzel_is_sidebar_active() ? '(max-width: 730px) 100vw, 768px' : '(max-width: 1170px) 100vw, 1170px',
    'thumbnail-grid' => uzel_is_sidebar_active() ? '(max-width: 991px) 768px, 400px' : '(max-width: 991px) 100vw, 768px',
  ];
  if(array_key_exists($size, $sizes)) {
    $attr['sizes'] = $sizes[$size];
  }
  return$attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'uzel_post_thumbnail_sizes_attr', 10 , 3 );
 */

// custom comment reply link class
function uzel_replace_reply_link_class($class) {
  $class = str_replace("class='comment-reply-link", "class='reply button button-small", $class);
  return $class;
}
add_filter('comment_reply_link', 'uzel_replace_reply_link_class');

// sidebar
function uzel_sidebar_init() {
  register_sidebar([
    'name' => 'Primary sidebar',
    'id' => 'sidebar-1',
    'before_widget' => '<aside class="uzel-widget">',
    'after_widget' => '</aside>',
    'before_title'  => '<h2 class="uzel-widget-title">',
    'after_title'   => '</h2>' ]);
}
add_action('widgets_init', 'uzel_sidebar_init');

// enqueue script is a simple wrapper around wp_enqueue_style. first arg - path to script, second - insert before body(default - true)
function uzel_add_assets() {

  $assets_dir = get_template_directory_uri() . '/assets/';
  //styles
  wp_enqueue_style('bundle_css', $assets_dir . 'index.css', [], '1.2.3');

  //scripts
  if(get_theme_mod('show_slider')) {
    wp_enqueue_script('slider', $assets_dir . 'slider.js', ['jquery'], '1.2.3', true);
  }
  uzel_enqueue_script($assets_dir . 'index.js');

  // need to load post ajax loader only on pages that contain posts. such as tag archive etc
  $page_type = null;
  if(is_category()) $page_type = 'category';
  elseif(is_tag()) $page_type = 'tag';
  elseif(is_archive()) $page_type = 'archive';
  elseif(is_date()) $page_type = 'date';
  elseif(is_home()) $page_type = 'home';
  elseif(is_search()) $page_type = 'search';

  if($page_type) {
    global $wp_query;
    wp_enqueue_script('post-loader', $assets_dir . 'post-loader.js', ['jquery'], '1.2.3', true);
    wp_localize_script('post-loader', '__ajax__', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('uzel-security'),
      'query_vars' => json_encode($wp_query->query),
      'page_type' => $page_type
    ]);
  }
  if(uzel_is_sidebar_active()) {
    uzel_enqueue_script($assets_dir . 'sticky-sidebar.js');
  }
}
add_action( 'wp_enqueue_scripts', 'uzel_add_assets' );


//colors
function uzel_add_colors() {
  $primary = get_theme_mod('primary_color', '#DC8686');
?>
<style>
:root {
  --primary-color: <?php echo $primary; ?>;
  --primary-hover-color: <?php echo uzel_darken_color($primary, 0.1);?>;
}
</style>
<?php 
}
add_action('wp_head', 'uzel_add_colors');

//fonts
function uzel_add_fonts() {
?>
  <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT&amp;subset=cyrillic" rel="stylesheet">
<?php
}
add_action('wp_head', 'uzel_add_fonts');

function uzel_custom_header_setup() {
  $args = [
    'default-image'      => get_template_directory_uri() . '/assets/header.jpg',
    'default-text-color' => '000',
    'width'              => 1440,
    'flex-width'         => true,
    'flex-height'        => true,
  ];
  add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'uzel_custom_header_setup' );

include get_template_directory()."/inc/custom_comments.php";
include get_template_directory()."/inc/init_customizer.php";
include get_template_directory()."/inc/init_widgets.php";
include get_template_directory()."/inc/excerpt.php";
include get_template_directory()."/inc/ajax.php";

// components
include get_template_directory()."/inc/components/social-links.php";
include get_template_directory()."/inc/components/related-posts.php";
include get_template_directory()."/inc/components/ajax-pagination.php";
?>
