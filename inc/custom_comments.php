<?php 
function custom_comments_list($comment, $args, $depth) { ?>
<li id="comment-<?php comment_ID();?>" class="comment">

<section class="comment-left-section">
<?php echo get_avatar( $comment, 64 ); ?>
</section>
<section class="comment-right-section">
  <div class="comment-author"><?php echo get_comment_author_link()?></div>
  <div class="comment-date"><?php comment_date('F j, H:i'); ?></div>
  <div class="comment-content">
    <?php comment_text(); ?>
  </div>
  <?php comment_reply_link(['reply_text' => 'Ответить', 'depth' => $depth, 'max_depth' => $args['max_depth']]) ?>
</section>
</li>
<?php }
?>
