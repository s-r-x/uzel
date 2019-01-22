require('owl.carousel/dist/assets/owl.carousel.css');
require('bootstrap/dist/css/bootstrap-grid.min.css');
require('../styles/index.less');
import 'gsap/CSSPlugin'
import $ from 'jquery';
window.$ = $;
window.jquery = $;
window.jQuery = $;

require('./menu');
require('./theme-toggle');
require('./search-bar');
require('./reveal');
