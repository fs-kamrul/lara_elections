const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
// require('laravel-mix-merge-manifest');

// mix.setPublicPath('../../public').mergeManifest();
//console.log(__dirname);
mix.js(__dirname + '/Resources/assets/js/faq.js', 'public/js/faq.js')
    .js(__dirname + '/Resources/assets/js/curriculum.js', 'public/js/curriculum.js')
    .js(__dirname + '/Resources/assets/js/lessons_video.js', 'public/js/lessons_video.js')
    // .js(__dirname + '/Resources/assets/js/courses_view.js', 'public/js/courses_view.js')
    .js(__dirname + '/Resources/assets/js/courses_learn.js', 'public/js/courses_learn.js')
    .js(__dirname + '/Resources/assets/js/courses_intended.js', 'public/js/courses_intended.js')
    .js(__dirname + '/Resources/assets/js/courses_requirements.js', 'public/js/courses_requirements.js')
    .js(__dirname + '/Resources/assets/js/courses_prospects.js', 'public/js/courses_prospects.js')
    // .js(__dirname + '/Resources/assets/js/courses_stories.js', 'public/js/courses_stories.js')
    .sass( __dirname + '/Resources/assets/sass/faq.scss', 'public/css/faq.css');

if (mix.inProduction()) {
    mix.version();
}
