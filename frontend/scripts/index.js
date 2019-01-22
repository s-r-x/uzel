require('owl.carousel/dist/assets/owl.carousel.css');
require('bootstrap/dist/css/bootstrap-grid.min.css');
require('../styles/index.less');
import $ from 'jquery';
import CSSPlugin from 'gsap/CSSPlugin';
window.$ = $;
window.jquery = $;
window.jQuery = $;
// prevent webpack from deleting the plugin
const plugins = [ CSSPlugin ];

require('./menu');
require('./theme-toggle');
require('./search-bar');
require('./reveal');
