const mix = require("laravel-mix");
require('vuetifyjs-mix-extension');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").js("resources/js/apps.js", "public/js").js("resources/js/open-account.js", "public/js").vuetify('', { postcss: true }).vue().version();
mix.postCss("resources/css/app.css", "public/css").version();

mix.options({
  postCss: [
    require("postcss-nested-ancestors"),
    require("postcss-nested"),
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ],
});

if (mix.inProduction()) {
  mix.version();
}

mix.browserSync("http://localhost:8000/");
