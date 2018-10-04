<?php 
function uzel_social_links_markup() {
  $uzel_article_link = esc_url(get_permalink());?>
  <div class="social-links">
  <a target="_blank" href="<?php get_uzel_facebook_share_url($uzel_article_link);?>">
    <i class="icon-facebook"></i>
  </a>
  <a target="_blank" href="<?php get_uzel_twitter_share_url($uzel_article_link);?>">
    <i class="icon-twitter"></i>
  </a>
  <a target="_blank" href="<?php get_uzel_gplus_share_url($uzel_article_link);?>">
    <i class="icon-gplus"></i>
  </a>
  <a target="_blank" href="<?php get_uzel_pinterest_share_url($uzel_article_link);?>">
    <i class="icon-pinterest"></i>
  </a>
  </div>
<?php 
}
