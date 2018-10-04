<?php
function uzel_excerpt_length($len) {
  return 600;
}
add_filter('excerpt_length', 'uzel_excerpt_length', 999);

function uzel_excerpt_more( $more ) {
      return '...';
}
add_filter( 'excerpt_more', 'uzel_excerpt_more' );
function uzel_get_excerpt($type = 'short') {
  $default = 25;
  $lengths = [
    'short' => 10,
    'medium' => 25,
    'big' => 80,
    'slider' => 25
  ];
  $len = array_key_exists($type, $lengths) ? $lengths[$type] : $default;
  $excerpt = get_the_excerpt();
  if(empty($excerpt)) {
    return '';
  }
  return wp_trim_words($excerpt, $len);
}
?>
