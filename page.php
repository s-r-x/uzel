<?php get_header();?>
<main class="page-wrapper col-sm-<?php echo uzel_get_number_of_columns();?>">
<?php if(have_posts()):
while ( have_posts() ) : the_post();?>
<article class="single-page">
  <header>
    <h1> <?php the_title();?></h1>
    <div class="single-page-time"> <time><?php the_time('j F, Y'); ?></time></div>
    <?php if(has_post_thumbnail()) :?>
      <?php the_post_thumbnail(uzel_is_sidebar_active() ? 'thumbnail-normal' : 'thumbnail-max', ['class' => 'post-thumbnail']);?>
    <?php endif;?>
  </header>
  <div class="single-page-content">
    <?php the_content() ?>   
  </div>
  <footer class="single-page-bottom">
    <?php uzel_social_links_markup(); ?>
  </footer>
</article >
<?php uzel_related_posts($post, 3); ?>
<?php get_template_part('inc/components/subscribe-form');?>
<?php
  if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;?>
<section class="page-pagination">
<?php previous_post_link('%link', '<i class="icon-angle-left"></i>%title'); ?>
<?php next_post_link('%link', '%title<i class="icon-angle-right"></i>'); ?>    
</section>
<?php endwhile;
endif; ?>
</main>
<?php get_sidebar();?>
<?php get_footer();?>
