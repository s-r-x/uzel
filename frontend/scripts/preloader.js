try {
  const $loader = document.querySelector('.loader');
  $loader.classList.remove('hide');
  window.addEventListener("load", function() {
    $loader.style.opacity = 0;
    setTimeout(() => $loader.classList.add('hide'), 450);
  })
}
catch(err) {
  console.log(err);
}
