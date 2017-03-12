const { mix } = require('laravel-mix');

var del = require('del');
var path = require('path');
var plugins = require('./npm/plugins');
var config = require('./npm/config');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
del(config.plugins.bower.out);
del(config.plugins.vue.out);
del(config.plugins.scripts.out);
del(config.plugins.img.out);
del(config.plugins.styles.out);

plugins.bower.map(function (bower) {
  mix.copy(path.join(config.plugins.bower.in, bower.in), path.join(config.plugins.bower.out, bower.out), false);
});

plugins.scripts.map(function (script) {
  mix.js(path.join(config.plugins.scripts.in, script.in), path.join(config.plugins.scripts.out, script.out));
});

plugins.vue.map(function (vue) {
  mix.js(path.join(config.plugins.vue.in, vue.in), path.join(config.plugins.vue.out, vue.out))
    .extract(['vue']);
});

plugins.styles.map(function (style) {
  mix.sass(path.join(config.plugins.styles.in, style.in), path.join(config.plugins.styles.out, style.out))
});

if (mix.config.inProduction) {
  mix.version();
}

mix.browserSync({
  proxy: 'blog.dev'
});
