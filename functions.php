<?php 

include get_template_directory()."/inc/utils.php";

//content width
if ( ! isset ( $content_width) ) $content_width = 1440; 
// main setup
function uzel_setup() {
  // localization
  load_theme_textdomain( 'uzelkovoye_pismo', get_template_directory() . '/languages' );

  // menu
  register_nav_menus( [ 'primary'   => 'Primary Menu' ] );

  //thumbnails
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats',  array ('image', 'video' ) );
}
add_action('after_setup_theme', 'uzel_setup');
add_image_size( 'slider', 1440);
add_image_size( 'thumbnail-max', 1170);
add_image_size('thumbnail-list', 400);
add_image_size('thumbnail-grid', 730);
add_image_size( 'thumbnail-normal', 1170);


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

function uzel_add_assets() {

  wp_deregister_script('jquery');

  $assets_dir = get_template_directory_uri() . '/assets/';
  //styles
  wp_enqueue_style('bundle_css', $assets_dir . 'index.css', [], '1.3.0');


  //scripts
  wp_enqueue_script('index_js', $assets_dir . 'index.js', [], '1.2.4', true);
  // need to load post ajax loader script only on pages that contains posts. such as tag archive etc
  $page_type = null;
  if(is_category()) $page_type = 'category';
  elseif(is_tag()) $page_type = 'tag';
  elseif(is_archive()) $page_type = 'archive';
  elseif(is_date()) $page_type = 'date';
  elseif(is_home()) $page_type = 'home';
  elseif(is_search()) $page_type = 'search';
  if($page_type) {
    global $wp_query;
    wp_enqueue_script('post-loader', $assets_dir . 'post-loader.js', [], '1.2.4', true);
    wp_localize_script('post-loader', '__ajax__', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('uzel-security'),
      'query_vars' => json_encode($wp_query->query),
      'page_type' => $page_type
    ]);
  }
  if(is_single()) {
    wp_enqueue_script('like', $assets_dir . 'like.js', [], '1.2.4', true);
    wp_localize_script('like', '__ajax__', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('uzel-security'),
      'action' => 'set_like'
    ]);
  }
  if(get_theme_mod('show_slider', true)) {
    wp_enqueue_script('slider', $assets_dir . 'slider.js', [], '1.2.4', true);
  }
}
add_action( 'wp_enqueue_scripts', 'uzel_add_assets' );


//color styles
function uzel_add_color_styles() {
  $primary = get_theme_mod('primary_color', '#DC8686');
  $primary_hover = uzel_darken_color($primary, 0.1);
?>
<style>
.main-color {
  color: <?php echo $primary; ?>;
}
.button, 
.comment-respond .submit, 
.loader,
.bottom-footer {
  background-color: <?php echo $primary; ?>;
}
.button:hover, 
.comment-respond .submit:hover {
  background-color: <?php echo $primary_hover; ?>;
}
a, 
.required,
.search-section .query-search,
.post-category,
.top-header h1,
.error-page .error-code {
  color: <?php echo $primary; ?>;
}
.menu-item-home a {
  color: <?php echo $primary; ?> !important;
}
a:hover, 
.menu-item-home a {
  color: <?php echo $primary_hover; ?>;
}
.comment-respond input {
outline-color: <?php echo $primary; ?>;
}
</style>
<?php 
}
add_action('wp_head', 'uzel_add_color_styles');

//fonts
function uzel_add_fonts() {
?>
<link href="https://fonts.googleapis.com/css?family=Cormorant:500|Old+Standard+TT&amp;subset=cyrillic" rel="stylesheet">
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
include get_template_directory()."/inc/ajax_like.php";

// components
include get_template_directory()."/inc/components/social-links.php";
include get_template_directory()."/inc/components/related-posts.php";
include get_template_directory()."/inc/components/ajax-pagination.php";
?>
