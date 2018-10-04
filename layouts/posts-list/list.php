<?php $uzel_article_link = esc_url(get_permalink());?>
<article class="post-item post-item_list clearfix">
  <section class="post-thumbnail-wrapper col-md-4">
    <a href="<?php echo $uzel_article_link;?>">
      <?php if(has_post_thumbnail()):?>
        <?php the_post_thumbnail('thumbnail-list', ['class' => 'post-thumbnail']);?>
      <?php endif;?>
    </a>
  </section>

  <section class="col-md-8">
    <?php uzel_first_category_link(get_the_category(), 'post-category');?> 
    <h2> <?php the_title();?></h2>
    <time class="post-time">
      <?php echo get_the_date('j F, Y'); ?>
    </time>
<?php 
$excerpt = uzel_get_excerpt('big');
if($excerpt != ''): ?>
<div class="post-excerpt">
  <?php echo uzel_get_excerpt(uzel_is_sidebar_active() ? 'short' : 'medium');?>
</div>
<a class="post-link button" href="<?php echo $uzel_article_link; ?>">Читать далее</a>
<?php endif ?>
<?php if(!uzel_is_sidebar_active()):?>
<footer>
  <?php uzel_social_links_markup(); ?>
  <div class="post-comments-counter">
    <?php comments_number('0', '1', '%' );?>
    <i class="icon-comment"></i>
  </div>
</footer>
<?php endif;?>
  </section>
</article>
