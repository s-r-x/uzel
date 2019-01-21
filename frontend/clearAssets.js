const path = require('path');
const fs = require('fs-extra');

const ASSETS_DIR = path.resolve(__dirname, '..', 'assets');
const EXCLUDE = ['loaders', 'snowflake.png', 'logo.svg'];

run();

async function run() {
  const files = await fs.readdir(ASSETS_DIR);
  files.forEach(filepath => {
    if(EXCLUDE.includes(filepath)) return;
    else fs.remove(path.join(ASSETS_DIR, filepath));
  });
}
