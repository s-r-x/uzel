<?php get_header();?>
<div class="error-page">
<h1>Ошибка <span class="error-code">404</span></h1>
<span class="error-message">
  Что-то пошло не так :(
</span>
<span class="error-actions">
Можно вернуться на <a href="" onclick="window.history.back(); return false;">предыдущюю страницу</a>, <a href="/">домой</a> или попробовать найти что-нибудь интересное
</span>
<?php get_search_form();?>
</div>
<?php get_footer();?>
