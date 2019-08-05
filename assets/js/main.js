/*
 * Form Checkbox Uniform
 */
var _componentUniform = function() {
    if (!$().uniform) {
        console.warn('Warning - uniform.min.js is not loaded.');
        return;
    }
    $('.form-input-styled').uniform();
};

/*
 * Tooltip Custom Color
 */

var _componentTooltipCustomColor = function() {
    $('[data-popup=tooltip-custom]').tooltip({
        template: '<div class="tooltip"><div class="arrow border-teal"></div><div class="tooltip-inner bg-teal"></div></div>'
    });
};

/*
 * Form Datepicker Uniform
 */

/*
 * Form Select 2 For Modal
 */

var _componentSelect2Modal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

/*
 * Form Select2
 */
var _componentSelect2Normal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });

};

/*
 * For Switchery for Datatable Status
 */

var _componentStatusSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-status-switchery'));

    if (elems.length > 0) {
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * For Switchery input field
 */

var _componentInputSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var input_elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
    if (input_elems.length > 0) {
        input_elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * Form Validation
 */
/*====================================================
    start content_from for _formValidation
=======================================================*/
var _formValidation = function() {
    $('#content_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                new PNotify({
                    title: 'Success',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('#submit').show();
                $('#submiting').hide();
                if (data.goto) {
                    swal({
                            title: "Your Data Saved Success full",
                            text: "Would you like to Reload this Page?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = data.goto;
                            }
                        });
                }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            title: 'Error',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};
/*==============================================
    end content_from for _formValidation
==================================================*/



/*==============================================
    Start content_from for _modalFormValidation
==================================================*/

var _modalFormValidation = function() {
    $('#content_form').parsley().on('field:validated', function() {
        $('.parsley-ajax').remove();
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('#submit').show();
                $('#submiting').hide();
                $('#modal_remote').modal('toggle');
                if (typeof(tariq) != "undefined" && tariq !== null) {
                    tariq.ajax.reload(null, false);
                }
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
                if (jsonValue) {
                const errors = jsonValue.errors;
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().addError('ajax', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            title: jsUcfirst(first_item.replace(/_/g, " ")) + ' Error!!',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        width: '30%',
                        title: 'Something Wrong!',
                        text: data.responseText,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

/*==============================================
    end content_from for _modalFormValidation
==================================================*/

$(document).ready(function() {

$(document).on('click', '#logout', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        method: 'Post',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        dataType: 'JSON',
        success: function(data) {
            p_notify(data.message, 'success', 'Success');
            noty('Be Patient. We are redirecting you to your destination.', 'success', 'Welcome', 'center');

            setTimeout(function() {
                window.location.href = data.goto;
            }, 2000);
        },
        error: function(data) {
          var jsonValue = data.responseJSON;
          if (jsonValue) {
          const errors = jsonValue.errors;
              $.each(errors, function(key, value) {
                  p_notify(value, 'error', 'Something Wrong!');
              });
          } else {
            p_notify(data.responseText);
          }
        }
    });
});

$(document).on('click', '#lock', function(e) {
  e.preventDefault();
  lock_user('user');

});
    /*
     * For Delete Item
     */
    $(document).on('click', '#delete_item', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();
        //console.log(row, url);
        swal({
                title: "Are you sure?",
                text: 'Once deleted, it will deleted all related Data!',
                showCancelButton: true,
                type: 'warning',
                confirmButtonText: 'Yes, Change it!'
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function(data) {
                            new PNotify({
                                title: 'Well Done!',
                                text: data.message,
                                type: 'success',
                                addclass: 'alert alert-styled-left',
                            });
                            if (typeof(tariq) != "undefined" && tariq !== null) {
                                tariq.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            var jsonValue = data.responseJSON;
                            const errors = jsonValue.errors;
                            if (errors) {
                                var i = 0;
                                $.each(errors, function(key, value) {
                                    new PNotify({
                                        title: 'Something Wrong!',
                                        text: value,
                                        type: 'error',
                                        addclass: 'alert alert-danger alert-styled-left',
                                    });
                                    i++;
                                });
                            } else {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: jsonValue.message,
                                    type: 'error',
                                    addclass: 'alert alert-styled-left',
                                });
                            }
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
    });

    /*
     * For Status Change
     */
    $(document).on('click', '#change_status', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        var status = $(this).data('status');
        if (status == 1) {
            msg = 'Change Status Form Online To Offline';
        } else {
            msg = 'Change Status Form Offline To Online';
        }
        $('#status_' + row).hide();
        $('#status_loading_' + row).show();
        swal({
                title: "Are you sure?",
                text: msg,
                showCancelButton: true,
                type: 'warning',
                confirmButtonText: 'Yes, Change it!'
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        url: url,
                        method: 'Put',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function(data) {
                            new PNotify({
                                title: 'Well Done!',
                                text: data.message,
                                type: 'success',
                                addclass: 'alert alert-styled-left',
                            });
                            if (typeof(tariq) != "undefined" && tariq !== null) {
                                tariq.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            var jsonValue = data.responseJSON;
                            const errors = jsonValue.errors;
                            if (errors) {
                                var i = 0;
                                $.each(errors, function(key, value) {
                                    new PNotify({
                                        title: 'Something Wrong!',
                                        text: value,
                                        type: 'error',
                                        addclass: 'alert alert-danger alert-styled-left',
                                    });
                                    i++;
                                });
                            } else {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: jsonValue.message,
                                    type: 'error',
                                    addclass: 'alert alert-styled-left',
                                });
                            }
                            $('#status_loading_' + row).hide();
                            $('#status_' + row).show();
                        }
                    });
                } else {
                    $('#status_loading_' + row).hide();
                    $('#status_' + row).show();
                }
            });
    });

    /*
     * For Datatabel Reload
     */
    $(document).on('click', '#reload', function() {
        if (typeof(tariq) != "undefined" && tariq !== null) {
            tariq.ajax.reload(null, false);
        }
    });

});



/*
 * For Uppercase Word first Letter
 */
function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


/*
 * For Card Block
 */
function cardBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');

    // Block card
    $(block).block({
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });
}


/*
 * For Unblock Card
 */
function cardUnBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');
    window.setTimeout(function() {
        $(block).unblock();
    }, 100);
}



/*
 * For Datatable Reload
 */
function dataTableReload() {
    cardBlock();
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}


/*
 * For Datatable Load
 */
function dataTableLoad() {
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}



/*
 * For Get Data Table Selected Rows Id
 */
function getDatatableSelectedRowIds(dt) {
    var ids = [];
    var rows = dt.rows('.selected').data();
    $.each(rows, function(index, value) {
        ids.push(value['id']);
    });
    return ids;
}


/*
 * For Perform Datatable Controles Button
 */
function datatableSelectedRowsAction(dt, url, action = 'delete', msg = 'Are You Sure') {
    var ids = getDatatableSelectedRowIds(dt);
    var url = url;
    swal({
            title: "Are you sure?",
            text: msg,
            showCancelButton: true,
            type: 'warning',
            confirmButtonText: 'Yes, Change it!'
        })
        .then((willDelete) => {
            if (willDelete.value) {
                cardBlock();
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        action: action,
                        ids: ids
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        new PNotify({
                            title: 'Well Done!',
                            text: data.message,
                            type: 'success',
                            addclass: 'alert alert-styled-left',
                        });
                        dt.ajax.reload(null, false);
                    },
                    error: function(data) {
                        console.log(data)
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors
                        if (errors) {
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                        } else {
                            new PNotify({
                                title: 'Something Wrong!',
                                text: jsonValue.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });
                        }
                        dt.ajax.reload(null, false);
                    }
                });
            }
        });
}



function p_notify(msg= 'Something Wrong', type='error', title="Opps!!" ){
    new PNotify({
        title: title,
        text: msg,
        type: type,
        addclass: 'alert alert-styled-left',
    });
}

function noty(msg= 'Something Wrong', type='error', title="Opps!!", layout='topRight'){
    new Noty({
        theme: 'limitless',
        timeout: 2000,
        title: title,
        text: msg,
        type: type,
        modal:true,
        layout: 'center'
    }).show();
}
if ($('#lock').length > 0) {
  var idleTime = 0;
  $(document).ready(function () {
      //Increment the idle time counter every minute.
      var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

      //Zero the idle timer on mouse movement.
      $(this).mousemove(function (e) {
          idleTime = 0;
      });
      $(this).keypress(function (e) {
          idleTime = 0;
      });
  });

  function timerIncrement() {
      idleTime = idleTime + 1;
      if (idleTime > 20) { // 20 minutes
        lock_user('inactivity');
      }
  }
}

function lock_user(type){
  var url = $('#lock').attr('href');
  $.ajax({
      url: url+'&type='+type,
      method: 'Post',
      contentType: false, // The content type used when sending data to the server.
      cache: false, // To unable request pages to be cached
      processData: false,
      dataType: 'JSON',
      success: function(data) {
          p_notify(data.message, 'success', 'Success');
          noty('Be Patient. We are redirecting you to your destination.', 'success', 'Welcome', 'center');

          setTimeout(function() {
              window.location.href = data.goto;
          }, 2000);
      },
      error: function(data) {
        var jsonValue = data.responseJSON;
        if (jsonValue) {
        const errors = jsonValue.errors;
            $.each(errors, function(key, value) {
                p_notify(value, 'error', 'Something Wrong!');
            });
        } else {
          p_notify(data.responseText);
        }
      }
  });
}



var _componentDatePicker = function() {
    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);
    // console.log(local);
    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
};
