import TimelineLite from 'gsap/TimelineLite';                                                                                                                          
import { Power1 } from 'gsap/EasePack'; 

const $btn = $('.top-search-btn');
const $form = $('.custom-search-form');
const $input = $form.find('input[type="text"]');
const $closeBtn = $form.find('.cancel-search');

function closeForm() {
  const tl = new TimelineLite();
  tl.to($input, .5, {
    opacity: 0,
    y: -50,
    ease: Power1.easeOut,
  })
    .to($form, .7, {
      ease: Power1.easeOut,
      opacity: 0,
      onComplete() {
        $form.removeClass('is-open');
      }
    }, .35)

}
function clickHandler() {
  const isOpen = $form.hasClass('is-open');
  if(isOpen) {
    closeForm();
  }
  else {
    const tl = new TimelineLite();
    $form.addClass('is-open');
    tl.to($form, .7, {
      opacity: 1,
      ease: Power1.easeOut,
    })
      .fromTo($input, 0.5, {
        opacity: 0,
        y: -50,
      }, {
        y: 0,  
        opacity: 1,
        ease: Power1.easeOut,
        onComplete() {
          $input.focus();
        }
      },0.3);
  }
}

$btn.click(clickHandler);
$closeBtn.click(closeForm);
