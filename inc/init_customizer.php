<?php 

//frontend
add_action( 'customize_preview_init', 'uzel_customizer_js' );
function uzel_customizer_js() {
  wp_enqueue_script('uzel_customizer', get_template_directory_uri() . '/assets/customizer.js', [], '', true);
}

add_action( 'customize_register', 'uzel_customize' );
function uzel_customize($wp_customize) {

  // colors
  $wp_customize->add_section('colors', [
    'title' => 'Цвета',
    'priority' => 4,
  ]);
  $wp_customize->add_setting('primary_color', [
    'default' => '#DC8686',
    'sanitaze_callback' => function($input) {
      return $input;
    }
  ]);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', [ 
    'label'      => 'Основной цвет',
    'section'    => 'colors',
    'settings'   => 'primary_color',
  ]) 
  );







  //sidebar
  $wp_customize->add_section('sidebar', [
    'title' => 'Сайдбар',
    'priority' => 5,
  ]);
  $wp_customize->add_setting('uzel_show_sidebar', [
    'default' => true,
    'sanitaze_callback' => function($input) {
      return $input;
    }
  ]);
  $wp_customize->add_control('uzel_show_sidebar_checkbox', [
    'label' => 'Отобразить',
    'description' => 'Отображать сайдбар?',
    'section' => 'sidebar',
    'settings' => 'uzel_show_sidebar',
    'type' => 'checkbox',
  ]);
  $wp_customize->add_setting('uzel_show_sidebar_on_single', [
    'default'=> false,
    'sanitaze_callback' => function($input) {
      return $input;
    }
  ]);
  $wp_customize->add_control('uzel_show_sidebar_on_single_checkbox', [
    'label' => 'Отобразить',
    'description' => 'Отображать сайдбар на страницах с единичиным постом?',
    'section' => 'sidebar',
    'settings' => 'uzel_show_sidebar_on_single',
    'type' => 'checkbox',
  ]);





  //layout
  $wp_customize->add_section( 'layout' , [
    'title'      => 'Отображение',
    'priority'   => 2,
  ] );
  $wp_customize->add_setting( 'posts-layout' , [
    'default' => 'normal',
    'sanitaze_callback' => function($input) {
      return in_array($input, ['normal', 'list', 'grid']) ? $input : 'normal';
    }
  ] );
  $wp_customize->add_control('uzel_posts_grid_layout', [
    'label'        => 'Отображение постов',
    'description' => 'Меняет то, в какому виде будет отображаться список постов',
    'section'    => 'layout',
    'settings'   => 'posts-layout',
    'type' => 'select',
    'choices' => [
      'normal' => 'Стандарт',
      'list' => 'Список',
      'grid' => 'Сетка'
    ]
  ] );
  //custom header 
  $wp_customize->add_setting('uzel_identity_header', [
    'default' => true,
    'sanitaze_callback' => function($input) { return $input; }
  ]);
  $wp_customize->add_control('uzel_identity_header_checkbox', [
    'label' => 'Отображать',
    'description' => 'Отображать название и описание сайта в шапке',
    'section' => 'layout',
    'settings' => 'uzel_identity_header',
    'type' => 'checkbox',
  ]);



  //slider
  $wp_customize->add_section('slider', [
    'title' => 'Слайдер',
    'priority' => 3,
  ]);
  $wp_customize->add_setting('show_slider', [
    'default' => true,
    'sanitaze_callback' => function($input) {
      return $input;
    }
  ]);
  $wp_customize->add_control('uzel_slider_show_checkbox', [
    'label' => 'Отображать слайдер',
    'description' => 'Слайдер на главной странице для отображения избранных постов',
    'section' => 'slider',
    'settings' => 'show_slider',
    'type' => 'checkbox',
  ]);

  $wp_customize->add_setting('slides_to_show', [
    'default' => '3',
    'sanitaze_callback' => function($input) {
      return in_array($input, ['2','3','4','5','6', '7', '8']) ? $input : '3';
    }
  ]);
  $wp_customize->add_control('uzel_slides_to_show', [
    'label' => 'Количество обображаемых постов',
    'description' => 'Сколько постов будет отображаться в слайдере',
    'section' => 'slider',
    'settings' => 'slides_to_show',
    'type' => 'select',
    'choices' => [
      '2' => '2',
      '3' => '3',
      '4' => '4',
      '5' => '5',
      '6' => '6',
      '7' => '7',
      '8' => '8'
    ]
  ]);
  $wp_customize->add_setting('slider_content_type', [
    'default' => 'latest',
    'sanitaze_callback' => function($input) {
      return in_array($input, ['latest', 'random', 'first']) ? $input : 'latest';
    }
  ]);
  $wp_customize->add_control('uzel_slider_content_type', [
    'label' => 'Тип контента',
    'description' => 'Что будет отображаться в слайдере',
    'section' => 'slider',
    'settings' => 'slider_content_type',
    'type' => 'select',
    'choices' => [
      'latest' => 'Последние посты',
      'random' => 'Случайные посты',
      'first' => 'Первые посты',
    ]
  ]);
  // blog name and description
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
?>
