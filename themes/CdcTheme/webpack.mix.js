let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'themes/' + directory;
const dist = 'public/themes/' + directory;
console.log(source);
console.log(dist);
mix
    .js(__dirname + '/assets/js/homePage.js', 'public/js/homePage.js')
    .js(__dirname + '/assets/js/newsletter.js', 'public/js/newsletter.js')
    .js(__dirname + '/assets/js/menuPage.js', 'public/js/menuPage.js')
    .js(__dirname + '/assets/js/faq_page.js', 'public/js/faq_page.js');
    // .sass( __dirname + '/assets/sass/app.scss', 'public/css/cdctheme.css');

if (mix.inProduction()) {
    mix.version();
}
