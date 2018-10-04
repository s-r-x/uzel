<?php 
if(is_singular() && !get_theme_mod('uzel_show_sidebar_on_single', false)) {
  return;
}
if ( uzel_is_sidebar_active()) : ?>
  <div class="sidebar col-sm-4">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
<?php endif;?>


