<?php
if ( post_password_required() )
  return;
?>
<section class="comments">
  <?php if(have_comments()):?>
<h3>Комментарии</h3>
<?php echo "<div id='comments_pagination'>";
paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
echo "</div>";
?>
<ul class="comments-list">
  <?php wp_list_comments('type=comment&callback=custom_comments_list'); ?>
</ul>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
<h3>Комментарии закрыты</h3>
<?php endif;
else:?>
<h3>Комментариев к этой записи пока нет</h3>
<?php endif ?>
<?php comment_form(['title_reply' => 'Оставить комментарий']); ?>
</section>

