export function objectValues(obj) {
  let acc = [];
  for(let prop in obj) {
    if(obj.hasOwnProperty(prop)) {
      acc.push(obj[prop]);
    }
  }
  return acc;
}

const prevent = e => e.preventDefault();
export function stopScrolling() {
  document.body.addEventListener('touchmove', prevent);
  window.addEventListener('DOMMouseScroll', prevent, false);
  window.onwheel = prevent;
}

export function startScrolling() {
  document.body.removeEventListener('touchmove', prevent);
  window.removeEventListener('DOMMouseScroll', prevent, false);
  window.onwheel = null;
}

export function isScrollBottom(offset = 2) {
  if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - offset) {
    return true;
  }
  return false;
};
