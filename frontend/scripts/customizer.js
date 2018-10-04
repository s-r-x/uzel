import { objectValues } from './utils';
const _$ = document.querySelector.bind(document);
const GRID_CLASSES = {
	single: "posts-grid-1",
	two: "posts-grid-2",
	three: "posts-grid-3"
};
console.log(wp);
wp.customize("grid_layout", observer =>
	observer.bind(function(layout) {
		if (!GRID_CLASSES.hasOwnProperty(layout)) return;
		let $grid = _$(".posts-grid");
    $grid.classList.remove(...objectValues(GRID_CLASSES));
    $grid.classList.add(GRID_CLASSES[layout]);
	})
);
//
//wp.customize( 'blogname', observer =>
//  observer.bind( val =>
//    (document.querySelector('.header-bloginfo').textContent = val)));
