import 'particles.js';
import config from './particles-config.json';

window.letItSnow = (elId) => {
  config.particles.shape.image.src = window.__snow__.snowflake_url;
  particlesJS(elId, config);
}
