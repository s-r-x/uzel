<?php
function uzel_is_sidebar_active() {
  $is_active = get_theme_mod('uzel_show_sidebar',true) && is_active_sidebar('sidebar-1');
  return $is_active;
}
function uzel_get_number_of_columns() {
  if(is_singular() && !get_theme_mod('uzel_show_sidebar_on_single', false)) {
    return '12';
  }
  $is_active = uzel_is_sidebar_active();
  return $is_active ? '8' : '12';
}

function uzel_first_category_link($categories, $classes = '') {
  if(empty($categories)) {
    return;
  }
  $first_category = $categories[0];
  $term_id = $first_category->term_id;
  $name =  $first_category->name;
  echo '<a class="' . $classes . '" ' . 'href="' . esc_url( get_category_link( $term_id ) ) . '">' . esc_html( $name ) . '</a>';
}

function uzel_enqueue_script($path, $before_body = true) {
  wp_enqueue_script(basename($path), $path, [], '1.2.3', $before_body);
}
function get_uzel_gplus_share_url($link) {
  echo 'https://plus.google.com/share?url=' . $link;
}
function get_uzel_pinterest_share_url($link, $description = 'Such a nice article!') {
  echo 'http://pinterest.com/pin/create/button/?url=' . $link . '&description=' . urlencode($description);
}
function get_uzel_facebook_share_url($link, $description = 'Such a nice article') {
  echo 'http://www.facebook.com/sharer.php?u=' . $link. '&p[title]=' . urlencode($description);
}
function get_uzel_twitter_share_url($link, $description = 'Such a nice article') {
  echo 'https://twitter.com/intent/tweet?text=' . urlencode($description) . '&url=' . $link;
}

function uzel_tags_list() {
  $tags = get_the_tags();
  if(!empty($tags)):
    $lis = array_map(function($tag) {
      $link = get_tag_link($tag->term_id);
      $name = $tag->name;
      return '<li class="tag"><a href=' . $link . '>' . $name . '</a>' . '</li>';
    }, $tags);
  echo '<ul class="tags">';
  echo '<i class="icon-tag"></i>';
  echo join(', ', $lis);
  echo '</ul>';
endif;
}

function uzel_darken_color($hexcolor, $percent)
{
  if ( strlen( $hexcolor ) < 6 ) {
    $hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
  }
  $hexcolor = array_map('hexdec', str_split( str_pad( str_replace('#', '', $hexcolor), 6, '0' ), 2 ) );
  foreach ($hexcolor as $i => $color) {
    $from = $percent < 0 ? 0 : $color;
    $to = $percent < 0 ? $color : 255;
    $pvalue = ceil( ($to - $from) * $percent );
    $hexcolor[$i] = str_pad( dechex($color + $pvalue), 2, '0', STR_PAD_LEFT);
  }

  return '#' . implode($hexcolor);
}
