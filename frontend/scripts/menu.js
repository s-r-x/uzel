import TimelineLite from 'gsap/TimelineLite';                                                                                                                          
import { Power1 } from 'gsap/EasePack'; 

const $btn = $('.hamburger');
const $menu = $('.top-menu-wrap');
const $items = $menu.find('li');
const $body = $(document.body);

function clickHandler() {
  const isOpen = $btn.hasClass('is-active');
  const tl = new TimelineLite();
  if(isOpen) {
    tl.staggerTo($items, .5, {
      y: -100,
      opacity: 0,
      ease: Power1.easeIn,
    }, 0.1)
      .to($menu, .7, {
        x: '-100%',
        y: '-100%',
        scale: 0.1,
        opacity: 0,
        ease: Power1.easeIn,
        onComplete() {
          $body.removeClass('is-menu-open');
          $menu.removeClass('is-open');
        }
      }, 0.45);
  } else {
    $menu.addClass('is-open');
    tl.to($menu, .7, {
      x: '0%',
      y: '0%',
      scale: 1,
      opacity: 1,
      ease: Power1.easeOut,
    })
      .staggerFromTo($items, .5, {
        y: -50,
        opacity: 0,
      }, {
        y: 0,
        opacity: 1,
        ease: Power1.easeOut,
        onComplete() {
          $body.addClass('is-menu-open');
        }
      }, 0.1);

  }
  $btn.toggleClass('is-active');
}
$btn.click(clickHandler);
