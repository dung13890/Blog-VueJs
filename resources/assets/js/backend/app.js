var CRUD = (function () {
  var _router, _$;
  var _resource, _data;
  var _onDatatables = false;
  var _datatables, _columns, _searches;
  var _selector;

  var _listeners = {
    ready: function () {}
  };

  function CRUD(resource, data) {
    _resource = resource;
    _data = data || {};
    this.setRouter();
    this.setJquery();
    document.addEventListener("DOMContentLoaded", _onReady);
  };

  function _onReady(event) {
    return _listeners.ready();
  }

  CRUD.prototype.setRouter = function (router) {
    _router = router || window.router || laroute || window.laroute;
    
    return _router;
  };

  CRUD.prototype.setJquery = function ($) {
    _$ = $ || jQuery || window.jQuery || window.$;
    
    return _$;
  };

  CRUD.prototype.setDatatables = function (columns, searches, selector, enable) {
    _columns = columns || [];
    _searches = searches || {
      data: function (d) {
        d.keyword = _$('input[name=keyword]').val();
      }
    };
    _selector = selector || "#table-index";
    _onDatatables = enable || true;

    return this;
  };

  CRUD.prototype.initDatatables = function () {
    _columns.push({
      name: "actions",
      searchable: false,
      orderable: false,
      render: function (data, type, row) {
        var actions = {
          edit: function () {
            return row.actions.show ? '<a href="' + row.actions.show.uri + '" title="' + row.actions.show.label + '" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>' : '';
          },
          delete: function () {
            return row.actions.delete ? '<a href="' + row.actions.delete.uri + '" title="' + row.actions.delete.label + '" class="btn btn-danger btn-xs delete-action"><i class="fa fa-times"></i></a>' : '';
          }
        }

        return actions.edit() + actions.delete();
      }
    });

    _datatables = _$(_selector).DataTable({
      dom: "<'row'<'col-xs-6'l>>"+
        "<'row'<'col-xs-12't>>"+
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      processing: true,
      serverSide: true,
      responsive: true,
      columns: _columns,
      order: [[0, 'desc' ]],
      searching: false,
      language: {
        search:"_INPUT_",
        lengthMenu: "_MENU_",
      },
      ajax: _$.extend({
        url: _router.route('backend.' + _resource + '.index', {'datatables': 1})
      }, _searches)
    });

    _$(document).on('click', 'a.delete-action', function(event) {
      var $ = _$;
      event.preventDefault();
      var $this = $(this);
      var href = $this.attr('href');

      var callback = function () {
        _$.post(href, {_method: 'DELETE'}, function() {})
        .done(function (data) {
          toastr.success(data.message);
          $this.closest('tr').fadeOut(400, function() {
            $this.remove();
          });
        })
        .fail(function(xhr) {
          console.log(xhr);
          if (xhr && xhr.responseJSON) {
            return toastr.error(xhr.responseJSON.message);
          }

          return toastr.error('An error has occurred');
        });
      }

      swal({
        title: "Bạn chắc chắn chứ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Chắc chắn!",
        cancelButtonText: "Hủy",
      }, function() {
        return callback();
      });
    });

    return this;
  }

  CRUD.prototype.refresh = function () {
    _datatables.draw();

    return this;
  }

  CRUD.prototype.index = function () {
    var self = this;
    if (_onDatatables) {
      var callback = _listeners.ready;
      _listeners.ready = function () {
        self.initDatatables();
        callback();
      }
    }
  };

  return CRUD;
})();








jQuery(document).ready(function($) {
    if (typeof flash_message !== 'undefined' && flash_message) {
        var e = JSON.parse(flash_message);
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": false,
            "preventDuplicates": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "600",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        e.code == 0 ? toastr.success(e.message) : toastr.error(e.message);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.slim-scroll').slimscroll({
        height: 300
    });
});
       
function alertDestroy(route) {
    swal({
        title: "Bạn chắc chắn chứ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Chắc chắn!",
        cancelButtonText: "Hủy",
        closeOnConfirm: false
    }, function() {
        $.post(route, {_method: 'DELETE'}, function (data) {
            window.location.reload();
        });
    });
};

function treeInit(items, options, drag, selector) {
    var items = items || [];
    var options = options || {};
    var drag = drag || false;
    var selector = selector || '#list';
    var defaultOptions = {
        closedIcon: $('<i class="fa fa-plus"></i>'),
        openedIcon: $('<i class="fa fa-minus"></i>'),
        data: items,
        dragAndDrop:drag,
        autoOpen: false,
        selectable: false,
    };
    options = $.extend(defaultOptions, options);
    $(selector).tree(options);

}

function sendImage(file, url, $element, callback) {
    var callback = callback || null;
    var  data = new FormData();
    data.append("image", file);
    $.ajax({
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $element.summernote("insertImage", data.url);
        },
        error: function(xhr, textStatus, error) {
            alert('Đã có lỗi xảy ra..! Kiểm tra lại file ảnh của bạn.');
        }
    });
    if (callback) {
        callback.apply(this);
    }
}
