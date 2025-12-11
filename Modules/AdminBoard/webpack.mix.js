const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
// require('laravel-mix-merge-manifest');

// mix.setPublicPath('../../public').mergeManifest();
//console.log(__dirname);
mix.js(__dirname + '/Resources/assets/js/components.js', 'public/js/components.js').vue({ version: 2 });
mix.js(__dirname + '/Resources/assets/js/notice_boards.js', 'public/js/notice_boards.js');
mix.js(__dirname + '/Resources/assets/js/event_category.js', 'public/js/event_category.js');
mix.js(__dirname + '/Resources/assets/js/event_public.js', 'public/js/event_public.js');

if (mix.inProduction()) {
    mix.version();
}
