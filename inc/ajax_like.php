<?php
add_action( 'wp_ajax_set_like', 'set_like' );
add_action( 'wp_ajax_nopriv_set_like', 'set_like' );

function set_like() {
  if(!check_ajax_referer('uzel-security', 'security')) {
    echo 'error';
    return wp_die();
  }
  $postId = $_POST['post_id'];
  if(!$postId) {
    wp_send_json(['success' => false], 400);
  }
  else {
    uzel_inc_post_likes($postId);
    wp_send_json(['success' => true]);
  }
}
?>
