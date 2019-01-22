<?php get_header();?>
  <?php if (have_posts()) : ?>
  <main class="col-sm-<?php echo uzel_get_number_of_columns();?>">
  <h1 style="text-align: center">Результаты поиска по запросу <span class="query-search"><?php echo get_search_query();?></h1>
  <div class="search-posts clearfix grid-fix">
  <?php while( have_posts()): the_post();?>
    <?php get_template_part('layouts/posts-list/' . get_theme_mod('posts-layout', 'normal'));?>
    <?php endwhile;?>
  </div>
  <?php uzel_ajax_pagination();?>
  <nav class="posts-pagination">
    <div class="nav-previous">
      <?php next_posts_link( '<i class="icon-angle-left"></i>Старые записи'); ?>
    </div>
    <div class="nav-next">
      <?php previous_posts_link( 'Новые записи<i class="icon-angle-right"></i>'); ?>
    </div>
  </nav>
  </main>
  <?php else:?>
  <main class="posts-wrapper col-sm-<?php echo uzel_is_sidebar_active() ? '8' : '12';?>">
  <h1>К сожалению, по запросу <span class="query-search"><?php echo get_search_query();?></span> ничего не найдено</h1>
  </main>
  <?php endif;?>
<?php get_sidebar();?>
<?php get_footer();?>
