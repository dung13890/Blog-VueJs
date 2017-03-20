var plugins = {
  bower: [
    {
      in: 'AdminLTE/dist',
      out: 'adminlte'
    },
    {
      in: 'bootstrap/dist',
      out: 'bootstrap'
    },
    {
      in: 'jquery/dist',
      out: 'jquery'
    },
    {
      in: 'components-font-awesome/css',
      out: 'font-awesome/css'
    },
    {
      in: 'components-font-awesome/fonts',
      out: 'font-awesome/fonts'
    },
    {
      in: 'datatables.net/js',
      out: 'datatables/js'
    },
    {
      in: 'datatables.net-bs/css',
      out: 'datatables-bs/css'
    },
    {
      in: 'datatables.net-bs/js',
      out: 'datatables-bs/js'
    },
    {
      in: 'jasny-bootstrap/dist',
      out: 'jasny-bootstrap'
    },
    {
      in: 'summernote/dist',
      out: 'summernote'
    },
    {
      in: 'jqTree/tree.jquery.js',
      out: 'jqtree/js'
    },
    {
      in: 'jqTree/jqtree.css',
      out: 'jqtree/css'
    }
  ],
  scripts: [
    {
      in: [
        'laroute.js',
        '../bower/AdminLTE/dist/js/app.min.js',
        '../bower/jquery-slimscroll/jquery.slimscroll.min.js',
        '../bower/sweetalert/dist/sweetalert.min.js',
        '../bower/toastr/toastr.min.js',
        '../bower/bootstrap-toggle/js/bootstrap-toggle.min.js',
        'backend/app.js'
      ],
      out: 'backend/app.js'
    }
  ],
  styles: [
    {
      in: [
        'sweetalert/dist/sweetalert.css',
        'animate.css/animate.min.css',
        'toastr/toastr.min.css',
        'bootstrap-toggle/css/bootstrap-toggle.min.css'
      ],
      out: 'backend/plugins.css'
    }
  ],
  sass: [
    {
      in: 'backend/app.scss',
      out: 'backend/app.css'
    },
    {
      in: 'frontend/app.scss',
      out: 'frontend/app.css'
    }
  ],
  vue: [
    {
      in: 'frontend/app.js',
      out: 'frontend/app.js'
    }
  ]
}
module.exports = plugins;
