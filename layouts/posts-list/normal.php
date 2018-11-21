<?php $uzel_article_link = esc_url(get_permalink());?>
<article class="post-item post-item_normal">
  <header>
    <?php uzel_first_category_link(get_the_category(), 'post-category');?> 
    <h2><?php the_title();?></h2>
    <time class="post-time">
      <?php echo get_the_date('j F, Y'); ?>
    </time>
    <?php if(has_post_thumbnail()):?>
    <a href="<?php echo $uzel_article_link;?>">
      <?php the_post_thumbnail('thumbnail-normal', ['class' => 'post-thumbnail']);?>
    </a>
    <?php endif;?>
  </header>
<?php $excerpt = uzel_get_excerpt('big');
if($excerpt != ''): ?>
<div class="post-excerpt">
  <?php echo $excerpt;?>
</div>
<?php endif; ?>
<div class="post-link-wrapper">
  <a class="post-link button" href="<?php echo $uzel_article_link; ?>">Читать далее</a>
</div>
<footer>
  <div class="post-meta-counter">
  <span class="post-meta-comments">
    <?php comments_number('0', '1', '%' );?>
    <i class="icon-comment"></i>
</span>
<span class="post-meta-likes">
    <?php echo uzel_get_post_likes($post->ID); ?>
    <i class="icon-heart main-color"></i>
</span>
  </div>
  <?php uzel_social_links_markup(); ?>
</footer>
</article>
