import 'owl.carousel';
import {stopScrolling, startScrolling} from './utils';

const config = {
  animateEffect: 'fadeOut',
  autoHeight: true,
  autoplay: false,
  items: 1,
  loop: true,
  nav: true,
  navText: [
    "<i class='icon-angle-left'/>",
    "<i class='icon-angle-right'/>",
  ],
  smartSpeed: 800,
};

function snow() {
  if(window.letItSnow) {
    //window.letItSnow();
    const $container = $('.owl-stage-outer');
    const elId = 'let-it-snow';
    const $snowContainer = document.createElement('div');
    $snowContainer.id = elId;
    $container[0].appendChild($snowContainer);
    window.letItSnow(elId);
  }
}

function initCarousel() {
  const owl = $('.top-slider');
  owl.on('initialized.owl.carousel', snow);
  owl.owlCarousel(config);
  owl.on('drag.owl.carousel', stopScrolling);
  owl.on('dragged.owl.carousel', startScrolling);
}

document.addEventListener('DOMContentLoaded', initCarousel);
