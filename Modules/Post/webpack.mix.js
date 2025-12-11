const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
// require('laravel-mix-merge-manifest');

// mix.setPublicPath('../../public').mergeManifest();
//console.log(__dirname);
mix.js(__dirname + '/Resources/assets/js/app.js', 'public/js/post.js');
mix.js(__dirname + '/Resources/assets/js/post_js.js', 'public/js/post_js.js');
// mix.sass( __dirname + '/Resources/assets/sass/app.scss', 'public/css/post.css');

if (mix.inProduction()) {
    mix.version();
}
