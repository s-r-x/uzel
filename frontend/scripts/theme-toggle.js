const $checkbox = $('.theme-toggle input');
const $body = $(document.body);
function changeHandler() {
  const isChecked = $checkbox.is(':checked');
  isChecked ? turnOn() : turnOff();
}
function turnOn() {

  $body.addClass('is-dark');
  $checkbox.prop('checked', true);
  localStorage.setItem('theme', 'dark');
}
function turnOff() {
  $body.removeClass('is-dark');
  localStorage.setItem('theme', 'light');
}

const saved = localStorage.getItem('theme');
if(saved) {
  if(saved === 'light') {
    turnOff();
  }
  else if(saved === 'dark') {
    turnOn();
  }
}
$checkbox.change(changeHandler);

