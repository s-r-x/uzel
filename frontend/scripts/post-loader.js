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
		search: "search-posts"
	};

	let currentPage = 1;

	let $pagination = document.querySelector(".posts-pagination");
	let $ajaxPagination = document.querySelector(".ajax-pagination");
	let $btn = $ajaxPagination.querySelector(".button");
	if (!CONTAINER_SELECTORS.hasOwnProperty(page_type)) {
		console.error("no such a page type");
		return;
	}
	let $$container = document.querySelector(CONTAINER_SELECTORS[page_type]);

	$pagination.parentNode.removeChild($pagination);
	$ajaxPagination.classList.remove("hide");

	$btn.addEventListener("click", clickHandler);
  const $hideAjaxPagination = () => $ajaxPagination.parentNode.removeChild($ajaxPagination);

	function clickHandler() {
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
				$ajaxPagination.classList.add("ajax-pagination_fetching");
			},
			success(res) {
				$ajaxPagination.classList.remove("ajax-pagination_fetching");
        let { status } = res;
        if(status === 'OK') {
          let {content, more_posts} = res;
					$$container.innerHTML += content;
					currentPage += 1;
          if(!more_posts) {
            $hideAjaxPagination();
          }
        } 
        else {
          $hideAjaxPagination();
          console.log(res);
        }
			},
			error(err) {
        $hideAjaxPagination();
				console.error(err);
			}
		});
	}
});
