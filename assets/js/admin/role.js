var tariq = '';
var flag = true;
var DatatableButtonsHtml5 = function() {
    var _componentDatatableButtonsHtml5 = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }
        $(document).on('search.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'page.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'order.dt', function(e, settings) {
            cardBlock()
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            dom: '<"dt-buttons-full"B><"datatable-header"fl><"datatable-wrap"t><"datatable-footer"ip>',
            // dom: '<"datatable-header"fBl><"datatable-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                loadingRecords: "Getting records...",
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                },
                select: {
                    rows: {
                        _: "%d rows Selected",
                        0: "Click a row to select it",
                        1: "1 row Selected"
                    }
                }
            }
        });
        // Basic initialization
        tariq = $('.content_managment_table').DataTable({
            fnDrawCallback: function(oSettings) {
                dataTableReload();
            },
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            buttons: [{
                extend: 'selectAll',
                className: 'btn bg-indigo-800'
            }, {
                extend: 'selectNone',
                className: 'btn bg-blue-800',
                text: 'Unselect All'
            }, {
                extend: 'selected',
                className: 'btn btn-danger',
                text: 'Delete',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/role/action.php', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 3]
            }, {
                orderable: false,
                targets: [2,3]
            }],
            order: [1, 'asc'],
            processing: true,
            serverSide: true,
            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex'
                }, {
                    data: 'role_name'
                }, {
                    data: 'permission_name'
                },{
                    data: 'action'
                }
            ]
        });
    };

    var _componentRemoteModalLoad = function() {
        $(document).on('click', '#content_managment', function(e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('show');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    _componentInputSwitchery();
                     _componentSelect2Modal();
                    _componentDatePicker();
                    _modalFormValidation();

                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    if (data.responseText) {
                      new PNotify({
                          title: 'Opps!',
                          text: $.parseJSON(data.responseText).message,
                          type: 'error',
                          addclass: 'alert alert-styled-left',
                      });
                    }
                    $('#modal-loader').hide();
                });
        });
    };

    return {
        init: function() {
            _componentDatatableButtonsHtml5();
            _componentRemoteModalLoad();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});

  // software_setup checkbox
$(document).on('change','#software_setup',function(){

  if (this.checked) {
    $('.software_setup').prop('checked', true);
  }else{
    $('.software_setup').prop('checked', false);
  }

});

  // system_user checkbox
$(document).on('change','#system_user',function(){

  if (this.checked) {
    $('.system_user').prop('checked', true);
  }else{
    $('.system_user').prop('checked', false);
  }

});
  // collect_software_due checkbox
$(document).on('change','#collect_software_due',function(){

  if (this.checked) {
    $('.collect_software_due').prop('checked', true);
  }else{
    $('.collect_software_due').prop('checked', false);
  }

});
  // office_account checkbox
$(document).on('change','#office_account',function(){

  if (this.checked) {
    $('.office_account').prop('checked', true);
  }else{
    $('.office_account').prop('checked', false);
  }

});
  // reports checkbox
$(document).on('change','#reports',function(){

  if (this.checked) {
    $('.reports').prop('checked', true);
  }else{
    $('.reports').prop('checked', false);
  }

});
  // office_stuff checkbox
$(document).on('change','#office_stuff',function(){

  if (this.checked) {
    $('.office_stuff').prop('checked', true);
  }else{
    $('.office_stuff').prop('checked', false);
  }

});

// promote_product checkbox
$(document).on('change','#promote_product',function(){

  if (this.checked) {
    $('.promote_product').prop('checked', true);
  }else{
    $('.promote_product').prop('checked', false);
  }

});

// existing_software checkbox
$(document).on('change','#existing_software',function(){

  if (this.checked) {
    $('.existing_software').prop('checked', true);
  }else{
    $('.existing_software').prop('checked', false);
  }

});

// new_software checkbox
$(document).on('change','#new_software',function(){

  if (this.checked) {
    $('.new_software').prop('checked', true);
  }else{
    $('.new_software').prop('checked', false);
  }

});

// graphics_detail checkbox
$(document).on('change','#graphics_detail',function(){

  if (this.checked) {
    $('.graphics_detail').prop('checked', true);
  }else{
    $('.graphics_detail').prop('checked', false);
  }

});

// customer_details checkbox
$(document).on('change','#customer_details',function(){

  if (this.checked) {
    $('.customer_details').prop('checked', true);
  }else{
    $('.customer_details').prop('checked', false);
  }

});

// messaging checkbox
$(document).on('change','#messaging',function(){

  if (this.checked) {
    $('.messaging').prop('checked', true);
  }else{
    $('.messaging').prop('checked', false);
  }

});

// message_note checkbox
$(document).on('change','#message_note',function(){

  if (this.checked) {
    $('.message_note').prop('checked', true);
  }else{
    $('.message_note').prop('checked', false);
  }

});

// developer_setup checkbox
$(document).on('change','#developer_setup',function(){

  if (this.checked) {
    $('.developer_setup').prop('checked', true);
  }else{
    $('.developer_setup').prop('checked', false);
  }

});

// agents checkbox
$(document).on('change','#agents',function(){

  if (this.checked) {
    $('.agents').prop('checked', true);
  }else{
    $('.agents').prop('checked', false);
  }

});

// role checkbox
$(document).on('change','#role',function(){

  if (this.checked) {
    $('.role').prop('checked', true);
  }else{
    $('.role').prop('checked', false);
  }

});

// all_checked checkbox
$(document).on('change','#all_checked',function(){

  if (this.checked) {
    $('.software_setup').prop('checked', true);
    $('#software_setup').prop('checked', true);
    $('.system_user').prop('checked', true);
    $('#system_user').prop('checked', true);
    $('.collect_software_due').prop('checked', true);
    $('#collect_software_due').prop('checked', true);
    $('.office_account').prop('checked', true);
    $('#office_account').prop('checked', true);
    $('.reports').prop('checked', true);
    $('#reports').prop('checked', true);
    $('.office_stuff').prop('checked', true);
    $('#office_stuff').prop('checked', true);
    $('.promote_product').prop('checked', true);
    $('#promote_product').prop('checked', true);
    $('.existing_software').prop('checked', true);
    $('#existing_software').prop('checked', true);
    $('.new_software').prop('checked', true);
    $('#new_software').prop('checked', true);
    $('.graphics_detail').prop('checked', true);
    $('#graphics_detail').prop('checked', true);
    $('.customer_details').prop('checked', true);
    $('#customer_details').prop('checked', true);
    $('.messaging').prop('checked', true);
    $('#messaging').prop('checked', true);
    $('.message_note').prop('checked', true);
    $('#message_note').prop('checked', true);
    $('.developer_setup').prop('checked', true);
    $('#developer_setup').prop('checked', true);
    $('.agents').prop('checked', true);
    $('#agents').prop('checked', true);
    $('.role').prop('checked', true);
    $('#role').prop('checked', true);
  }else{
    $('.software_setup').prop('checked', false);
    $('#software_setup').prop('checked', false);
    $('.system_user').prop('checked', false);
    $('#system_user').prop('checked', false);
    $('.collect_software_due').prop('checked', false);
    $('#collect_software_due').prop('checked', false);
    $('.office_account').prop('checked', false);
    $('#office_account').prop('checked', false);
    $('.reports').prop('checked', false);
    $('#reports').prop('checked', false);
    $('.office_stuff').prop('checked', false);
    $('#office_stuff').prop('checked', false);
    $('.promote_product').prop('checked', false);
    $('#promote_product').prop('checked', false);
    $('.existing_software').prop('checked', false);
    $('#existing_software').prop('checked', false);
    $('.new_software').prop('checked', false);
    $('#new_software').prop('checked', false);
    $('.graphics_detail').prop('checked', false);
    $('#graphics_detail').prop('checked', false);
    $('.customer_details').prop('checked', false);
    $('#customer_details').prop('checked', false);
    $('.messaging').prop('checked', false);
    $('#messaging').prop('checked', false);
    $('.message_note').prop('checked', false);
    $('#message_note').prop('checked', false);
    $('.developer_setup').prop('checked', false);
    $('#developer_setup').prop('checked', false);
    $('.agents').prop('checked', false);
    $('#agents').prop('checked', false);
    $('.role').prop('checked', false);
    $('#role').prop('checked', false);
  }

});

