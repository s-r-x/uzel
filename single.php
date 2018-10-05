<?php
get_header(); ?>
<main class="single-post-wrapper col-sm-<?php echo uzel_get_number_of_columns();?>">
<?php if(have_posts()):
while ( have_posts() ) : the_post();?>
<article class="single-post">
  <header>
    <div class="single-post-category">
      <?php uzel_first_category_link(get_the_category());?>
    </div>
    <h1> <?php the_title();?></h1>
    <div class="single-post-time"> <time><?php the_time('j F, Y'); ?></time></div>
    <?php if(has_post_thumbnail()) :?>
      <?php the_post_thumbnail(uzel_is_sidebar_active() ? 'thumbnail-normal' : 'thumbnail-max', ['class' => 'post-thumbnail']);?>
    <?php endif;?>
  </header>
  <div class="single-post-content">
    <?php the_content() ?>   
  </div>
  <footer class="post-bottom">
    <?php uzel_social_links_markup(); ?>
    <?php uzel_tags_list();?>
  </footer>
</article >
<?php uzel_related_posts($post, 3); ?>
<?php
  if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;?>
<section class="post-pagination">
<?php previous_post_link('%link', '<i class="icon-angle-left"></i>%title'); ?>
<?php next_post_link('%link', '%title<i class="icon-angle-right"></i>'); ?>    
</section>
<?php endwhile;
endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>