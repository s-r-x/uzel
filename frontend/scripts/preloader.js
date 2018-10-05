try {
  let $loader = document.querySelector('.loader');
  $loader.classList.remove('hide');
  window.onload = function() {
    $loader.style.opacity = 0;
    setTimeout(() => $loader.classList.add('hide'), 450);
  }
}
catch(err) {
  ;
}