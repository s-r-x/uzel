let isFetching = false;
const fetchClass = 'like-button-fetching';

const $likeButton = $('[data-likepost]');
const $i = $likeButton.find('i');

let likes = JSON.parse(localStorage.getItem('likes')) || [];

document.addEventListener("DOMContentLoaded", function() {
  if(!localStorage in window) {
    return;
  }
  const postId = $likeButton.data('likepost');
  // already liked
  if(likes.indexOf(postId) !== -1) {
    return $likeButton.remove();    
  }
  if (!window.__ajax__) {
    return console.error("no data from backend");
  }
  $likeButton.click(function({ target }) {
    if(likes.indexOf(postId) === -1) {
      makeRequest(postId);
    }
  });
});

function makeRequest(postId) {
  if(isFetching) {
    return;
  }
  const { security, ajax_url, action } = window.__ajax__;
  $.ajax({
    url: ajax_url,
    type: 'POST',
    data: {
      action,
      security,
      post_id: postId,
    },
    beforeSend() {
      isFetching = true;
      $likeButton.addClass(fetchClass);
      $i.addClass('icon-heart').removeClass('icon-cancel icon-ok');
    },
    success(res) {
      localStorage.setItem('likes', JSON.stringify([ ...likes, postId ]));
      $i.removeClass('icon-heart icon-cancel').addClass('icon-ok');
      $likeButton.attr('disabled', 'disabled');
      $likeButton.css({ opacity: 0 });
      setTimeout(() => $likeButton.css({ visibility: 'hidden' }), 2500);
    },
    error(e) {
      $i.removeClass('icon-heart icon-ok').addClass('icon-cancel');
    },
    complete() {
      $likeButton.removeClass(fetchClass);
      isFetching = false;
    }
  });
}
