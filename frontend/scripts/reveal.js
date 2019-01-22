import Reveal from 'scrollreveal';

function isMobile(agent = navigator.userAgent) {
  return /Android|iPhone|iPad|iPod/i.test(agent)
}
function run() {
  const qsa = document.querySelectorAll.bind(document);
  window.addEventListener("load", function() {
    const instance = Reveal();
    const config = {
      viewFactor: 0.3,
      duration: 1000,
      easing: 'ease-in-out',
    }
    const thumbConfig = {
      cleanup: true,
      viewFactor: 0.3,
      duration: 1400,
      easing: 'ease-in-out',
      beforeReveal(el) {
        $(el).addClass('no-reveal');
      }
    };

    const $thumbs = qsa('.post-item .post-thumbnail');
    const $singleImgs = qsa('article.single-post img');

    window.revealStuff = true;
    window.revealInstance = instance;
    window.revealConfig = thumbConfig;

    instance.reveal($thumbs, thumbConfig);
    instance.reveal($singleImgs, config);
  });
}

if(!isMobile()) {
  run();
}
else {
  $(document.documentElement).removeClass('sr');
}

