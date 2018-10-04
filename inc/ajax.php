<?php
add_action( 'wp_ajax_fetch_posts', 'fetch_posts' );
add_action( 'wp_ajax_nopriv_fetch_posts', 'fetch_posts' );

function fetch_posts() {

  function construct_error_res($error) {
    return json_encode([status => 'FAIL', error => $error]);
  }

  $MAX_PAGE = 33333;
  if(!check_ajax_referer('uzel-security', 'security')) {
    echo construct_error_res('Wrong referer');
    wp_die();
    return;
  }

  $page;
  try {
    $page = intval($_GET['page'], 10);
  } catch(Exception $e) {
    $page = 1;
  }
  if($page < 1 || $page > $MAX_PAGE) {
    echo construct_error_res('wrong page');
    wp_die();
    return;
  }
  $query_vars;
  try {
    $query_vars = json_decode( stripslashes( $_GET['query_vars'] ), true );
  } catch(Exception $e) {
   $query_vars = []; 
  }

  $posts_per_page = get_option( 'posts_per_page' );
  $query_vars['offset'] = $page * $posts_per_page;
  $query_vars['posts_per_page'] = $posts_per_page;

  $query = new WP_Query($query_vars);
  $counter = 0;
  if($query->have_posts()) {
    ob_start();
    while($query->have_posts()) {
      $counter += 1;
      $query->the_post();
      get_template_part('layouts/posts-list/' . get_theme_mod('posts-layout', 'normal'));
    }
    wp_reset_postdata();
    $html = ob_get_contents();
    ob_end_clean();
    $res_json = json_encode([
      content => $html,
      more_posts => $counter >= $posts_per_page,
      status => 'OK'
    ]);
    echo $res_json;
    wp_die();
  }
  else {
    echo construct_error_res('no posts');
    wp_die();
  }
}
?>
