<?php 
function uzel_related_posts($post, $amount = 3) {
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {
    $first_tag = $tags[0]->term_id;
    $args= [
      'tag__in' => [$first_tag],
      'post__not_in' => [$post->ID],
      'posts_per_page'=>$amount,
      'ignore_sticky_posts' => true
    ];
    $_query = new WP_Query($args);
    if( $_query->have_posts() ) { ?>
    <section class="related-posts">
      <h3>Похожие записи</h3>
      <div class="row">
        <?php  while ($_query->have_posts()) : $_query->the_post(); ?>
        <div class="related-post col-sm-4">
          <a href="<?php echo esc_url(get_permalink());?>">
            <?php the_post_thumbnail('medium', ['class' => 'post-thumbnail']);?>
            <h2><?php the_title();?></h2>
            <time><?php the_time('j F, Y'); ?></time>
          </a>
        </div>
        <?php endwhile;?>
      </div>
    </section>
<?php }
wp_reset_query();
  }
}
?>
