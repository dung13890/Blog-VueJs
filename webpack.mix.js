const { mix } = require('laravel-mix');
const webpack = require('webpack');

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
del(config.plugins.sass.out);

mix.copy(config.plugins.img.in, config.plugins.img.out, false);

plugins.bower.map(function (bower) {
  mix.copy(path.join(config.plugins.bower.in, bower.in), path.join(config.plugins.bower.out, bower.out), false);
});

plugins.scripts.map(function (script) {
  let array= [];
  script.in.map((element) => {
    return array.push(path.join(config.plugins.scripts.in, element));
  });
  mix.scripts(array, path.join(config.plugins.scripts.out, script.out));
});

plugins.styles.map(function (style) {
  let array= [];
  style.in.map((element) => {
    return array.push(path.join(config.plugins.styles.in, element));
  });
  mix.styles(array, path.join(config.plugins.styles.out, style.out));
});

plugins.sass.map(function (sass) {
  mix.sass(path.join(config.plugins.sass.in, sass.in), path.join(config.plugins.sass.out, sass.out))
});

plugins.vue.map(function (vue) {
  mix.js(path.join(config.plugins.vue.in, vue.in), path.join(config.plugins.vue.out, vue.out))
    .extract(['vue']);
});

if (mix.config.inProduction) {
  mix.version();
}

mix.browserSync({
  proxy: 'blog.dev'
});
