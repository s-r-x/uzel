<?php get_header();?>
<?php if(is_home()):?>
<?php if(have_posts()):?>
<main class="col-sm-<?php echo uzel_get_number_of_columns();?>">

<div class="posts-wrapper clearfix grid-fix">
<?php while( have_posts()): the_post();?>
<?php get_template_part('layouts/posts-list/' . get_theme_mod('posts-layout', 'normal'));?>
<?php endwhile;?>
</div>
<nav class="posts-pagination">
  <div class="nav-previous">
    <?php previous_posts_link( '<i class="icon-angle-left"></i>Новые записи'); ?>
  </div>
  <div class="nav-next">
    <?php next_posts_link( 'Старые записи<i class="icon-angle-right"></i>'); ?>
  </div>
</nav>
<?php uzel_ajax_pagination();?>
</main>
<?php endif;?>
<?php endif;?>
<?php get_sidebar();?>
<?php get_footer();?>
