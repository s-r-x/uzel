const BED_TIME = 20;

const $checkbox = $('.theme-toggle input');
const $body = $(document.body);
function changeHandler() {
  $checkbox.is(':checked') ? turnOn() : turnOff();
}
function turnOn() {
  $body.addClass('is-dark');
  $checkbox.prop('checked', true);
}
function turnOff() {
  $body.removeClass('is-dark');
}
$checkbox.change(changeHandler);
const hours = new Date().getHours();
if(hours >= BED_TIME) {
  //turnOn();
}
