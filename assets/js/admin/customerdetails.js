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
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/customerdetails/action.php', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            },{
                extend: 'selected',
                className: 'btn bg-success',
                text: 'Online',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/customerdetails/action.php', action = 'active', msg = 'Change Status To Online');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-secondary',
                text: 'Offline',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/customerdetails/action.php', action = 'inactive', msg = 'Change Status To Offline');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-warning',
                text: 'Toggle Status',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/customerdetails/action.php', action = 'toggle', msg = 'Toggle Status');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 7]
            }, {
                orderable: false,
                targets: [6, 7]
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
                    data: 'name'
                }, {
                    data: 'number'
                }, {
                    data: 'email'
                },  {
                    data: 'institute_type'
                }, {
                    data: 'institute_name'
                },{
                    data: 'status'
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
                    _componentSelect2Normal();
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

     var _componentDeleteNote = function() {
        $(document).on('click', '.delete_note', function(e) {
            e.preventDefault();
            // it will get action url
           
            var url = $(this).data('url');
            var id = '#tr_'+$(this).attr("id");
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'json'
                })
                .done(function(data) { 
                    new PNotify({
                          title: 'Well Done!',
                          text: data.message,
                          type: 'success',
                          addclass: 'alert alert-styled-left',
                      });
                    $(id).remove();
                })
                .fail(function(data) {
                    
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
            _componentDeleteNote();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});

$(document).ready(function(){
    
    $(document).on('click', '#check', function(){
        if (this.checked) {
            $("#flied").show();
        } else{
            $("#flied").hide();
        }
    });

    $(document).on('change','#customer_category', function(){
        var customers = $("#customer_category").val();
        if (customers == 'contacted_customers') {
            $("#cust_select_div").show(500);
            $("#customer_form").hide(500);
              $('#content_form')[0].reset();
              $("#interested_services").val(null).trigger('change');
              $("#software_category").val(null).trigger('change');
        }else{
            $("#cust_select_div").hide(500);
            $("#select_customer").val('');

            $("#customer_form").show(500);
            $('#content_form')[0].reset();
            $("#interested_services").val(null).trigger('change');
            $("#software_category").val(null).trigger('change');
        }
    })

    $(document).on('change','#select_customer', function(){
        var cust_id = $(this).val();
        if (cust_id!="") {
            $("#customer_form").show(500);
            $.ajax({
                url:ADMIN_URL+"/customerdetails/ajax_get_info.php",
                method:"GET",
                data:{cust_id:cust_id},
                dataType: 'json',
                success:function(data){
                    $("#name").val(data.office_notes.name);
                    $("#facebook_name").val(data.office_notes.facebook_name);
                    $("#number").val(data.office_notes.number);
                    $("#email").val(data.office_notes.email);
                    $("#introduction_date").val(data.office_notes.introduction_date);
                    $("#last_contacted_date").val(data.office_notes.last_contacted_date);
                    $("#progressive_state").val(data.office_notes.progressive_state);

                    $("#institute_type").val(data.office_notes.institute_type);
                    $("#institute_name").val(data.office_notes.institute_name);
                    $("#institute_address").val(data.office_notes.institute_address);
                    $("#institute_district").val(data.office_notes.institute_district);
                    $("#interested_services").html(data.options);
                    $("#software_category").html(data.option);
                }
            });
        }else{
            $("#customer_form").hide(500);
            $('#content_form')[0].reset();
              $("#interested_services").val(null).trigger('change');
              $("#software_category").val(null).trigger('change');
        }
    })


$(document).on("keyup","#content_form", function(){
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        if (confirm_password) {
            if (password == confirm_password) {
            $("#success").html("<strong class='text-success'>Right Confirm password</strong>");
            }else{
            $("#success").html("<strong class='text-danger'>Wrong Confirm password</strong>");
            }
        }
        
});


























});