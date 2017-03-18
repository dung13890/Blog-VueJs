var config = {
  plugins: {
    scripts: {
      in: 'resources/assets/js',
      out: 'public/assets/js'
    },
    styles: {
      in: 'resources/assets/bower',
      out: 'public/assets/css'
    },
    sass: {
      in: 'resources/assets/sass',
      out: 'public/assets/css'
    },
    img: {
      in: 'resources/assets/img',
      out: 'public/assets/img'
    },
    bower: {
      in: 'resources/assets/bower',
      out: 'public/vendor'
    },
    vue: {
      in: 'resources/assets/vue',
      out: 'public/assets/vue'
    }
  }
}
module.exports = config;
