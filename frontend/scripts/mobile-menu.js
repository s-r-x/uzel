try {
  let $toggler = document.querySelector('.menu-toggle-btn'); 
  let $menu = document.querySelector('.sticky-menu');
  function clickHandler() {
    $toggler.classList.toggle('is-active');
    $menu.classList.toggle('mobile-open');
  }
  $toggler.addEventListener('click', clickHandler);
}
catch(err) {
}
