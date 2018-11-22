const $toggler = $('.menu-toggle-btn'); 
const $menu = $('.sticky-menu');
const animTime = 400;

let isAnimating = false;
let isOpen = false;
function clickHandler() {
  if(isAnimating) {
    return;
  }
  isAnimating = true;
  if(isOpen) {
    $toggler.removeClass('is-active');
    $menu.removeClass('mobile-open');
    setTimeout(() => {
      isAnimating = false;
      $menu.css({ display: 'none' })
      isOpen = !isOpen;
    }, animTime);
  }
  else {
    $menu.css({ display: 'block' });
    setTimeout(() => {
      $toggler.addClass('is-active');
      $menu.addClass('mobile-open');
      isAnimating = false;
      isOpen = !isOpen;
    }, 1);
  }
}
$toggler.click(clickHandler);
