import {isScrollBottom} from './utils';
import throttle from 'lodash.throttle';

const SCROLL_OFFSET_TO_START_FETCH = 400;
const SCROLL_DELAY = 250;

document.addEventListener("DOMContentLoaded", function() {
  if (!window.__ajax__) {
    console.error("no data from backend");
    return;
  }


  let { page_type, query_vars, security, ajax_url } = window.__ajax__;

  const CONTAINER_SELECTORS = {
    category: ".archive-posts",
    tag: ".archive-posts",
    archive: ".archive-posts",
    home: ".posts-wrapper",
    date: ".archive-posts",
    search: ".search-posts"
  };

  let currentPage = 1;

  if (!CONTAINER_SELECTORS.hasOwnProperty(page_type)) {
    console.error("no such a page type");
    return;
  }

  const $fetchIndicator = $(".ajax-pagination");
  const $container = $(CONTAINER_SELECTORS[page_type]);

  // do not need standard pagination anymore
  $(".posts-pagination").remove();
  $fetchIndicator.removeClass('hide');

  const showFetchIndicator = () => $fetchIndicator.addClass('ajax-pagination_fetching');
  const hideFetchIndicator = () => $fetchIndicator.removeClass('ajax-pagination_fetching');

  // initial scroll check
  if(isScrollBottom(SCROLL_OFFSET_TO_START_FETCH)) {
    fetchPosts();
  }

  let isFetching = false;
  let isNoMorePosts = false;

  function fetchPosts() {
    if(isFetching || isNoMorePosts) return;
    $.ajax({
      url: ajax_url,
      type: "GET",
      dataType: "json",
      data: {
        action: "fetch_posts",
        query_vars: query_vars,
        security: security,
        page: currentPage
      },
      beforeSend(arg) {
        showFetchIndicator();
        isFetching = true;
      },
      success(res) {
        const { status } = res;
        if(status === 'OK') {
          const {content, more_posts} = res;
          $container.append(content);
          currentPage += 1;
          if(window.revealStuff) {
            const itemsToReveal = document.querySelectorAll('.post-item .post-thumbnail:not(.no-reveal)');
            // wait a moment while browser changing dom
            setTimeout(() => window.revealInstance.reveal(itemsToReveal, window.revealConfig), 1);
          }
          if(!more_posts) {
            isNoMorePosts = true;
          }
        } 
        else if(status ==='FAIL') {
          const { error } = res;
          if(error === 'no posts') {
            isNoMorePosts = true;
          }
          else {
            console.error(error);
          }
        }
      },
      error(err) {
        console.error(err);
      },
      complete() {
        isFetching = false;
        hideFetchIndicator();
      }
    });
  }
  $(window).scroll(throttle(function() {
    if(isScrollBottom(SCROLL_OFFSET_TO_START_FETCH)) {
      fetchPosts();
    }
  }, SCROLL_DELAY));
});
