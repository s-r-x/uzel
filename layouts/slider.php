<?php

$content_type = get_theme_mod('slider_content_type', 'latest');
$args = [
  'posts_per_page' => get_theme_mod('slides_to_show', '4'),
  'orderby' => $content_type === 'random' ? 'rand' : 'date',
  'order' => $content_type === 'first' ? 'ASC' : 'DSC'
];
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
?>
<div class="top-slider owl-carousel" id="top-slider"> 
<?php 
while ( $the_query->have_posts() ) {
  $the_query->the_post();
?>
<div class="slider-item">
<div class="slider-info-wrapper">
<div class="slider-item-info">
<div class="info-category">
  <?php uzel_first_category_link(get_the_category(), 'post-category');?>
</div>
  <h2 class="info-title">
  <?php the_title(); ?>
  </h2>
  <div class="info-date">
    <?php echo get_the_date('j F, Y'); ?>
</div>
  <div class="info-excerpt">
    <?php 
    $excerpt = uzel_get_excerpt('slider');
    if($excerpt != ''): ?>
      <?php echo $excerpt; ?>
    <?php endif ?>
</div>
<a class="button" href="<?php echo esc_url( get_permalink() ); ?>">Читать далее</a>
</div>
</div>
<?php if(has_post_thumbnail()) :
the_post_thumbnail('slider', ['class' => 'post-thumbnail']);
endif;
?>
  </div>  
<?php 
}
?>
</div> 
<?php  
wp_reset_postdata();
} else {
  // no posts found
}
