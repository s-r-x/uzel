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
    "<i class='icon-angle-circled-left'/>",
    "<i class='icon-angle-circled-right'/>",
  ],
  smartSpeed: 800,
};

function initCarousel() {
  const owl = $('.top-slider');
  owl.owlCarousel(config);
  owl.on('drag.owl.carousel', stopScrolling);
  owl.on('dragged.owl.carousel', startScrolling);
}

document.addEventListener('DOMContentLoaded', initCarousel);
