import '@fancyapps/fancybox';

const $post = $('.single-post-content');
const $imgs = $post.find('img');

const mutateLinkTag = (link, img) => {
  link.dataset.fancybox = 'gallery';
  link.href = img.src;
  link.dataset.width = img.width;
  link.dataset.height = img.height;
};

$.each($imgs, (_, img) => {
  const parent = img.parentNode;
  if(parent.nodeName.toLowerCase() === 'a') {
    mutateLinkTag(parent, img);
  }
  else {
    const link = document.createElement('a');
    mutateLinkTag(link, img);
    $(img).wrap(link);
  }
});

