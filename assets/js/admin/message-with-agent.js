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
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/software-details/action.php', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            },{
                extend: 'selected',
                className: 'btn bg-success',
                text: 'Online',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/software-details/action.php', action = 'active', msg = 'Change Status To Online');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-secondary',
                text: 'Offline',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/software-details/action.php', action = 'inactive', msg = 'Change Status To Offline');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-warning',
                text: 'Toggle Status',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/software-details/action.php', action = 'toggle', msg = 'Toggle Status');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 6]
            }, {
                orderable: false,
                targets: [6]
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
                    data: 'email'
                }, {
                    data: 'mobile_no'
                }, {
                    data: 'interested_up'
                }, {
                    data: 'unread'
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








$(document).ready(function(){
    $(document).on('click','.start_chat',function(){
        // alert('sohag');
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        var admin_id = $(this).data('admin_id');
        // console.log(to_user_name);
        var sohag = make_dialoge_box(to_user_id, to_user_name,admin_id);
        // console.log(sohag);
        
        
        var refresh_element = [];

       refresh_element[to_user_id] =  setInterval(function(){
            $.ajax({
                url: './insert_chat.php', 
                data: {
                        to_user_id_get_info:to_user_id,
                        admin_id_get_info: admin_id
                    },
                    type: 'post',
                    dataType: 'json',
                    success:function(data){
                        // $('#chat_message_'+to_user_id).val('');
                        $('#chat_history_'+to_user_id).html(data);
                    }
            })
        },500);

        $("#user_dialog_"+to_user_id).dialog({
            autoOpen:false,
            width:400,
            close: function() {
              clearInterval(refresh_element[to_user_id]);
              change_seen_status(to_user_id, admin_id);
              tariq.ajax.reload();
            }
        });
        $("#user_dialog_"+to_user_id).dialog('open');

        // for changing seen status
      change_seen_status(to_user_id,admin_id);

    });

    $(document).on('click','.send_chat',function(){
        var to_user_id = $(this).attr('id');
        var admin_id = $(this).data('admin_id');
        // alert(admin_id);
        var chat_message = $('#chat_message_'+to_user_id).val();
         // $('#chat_history_'+to_user_id).html(chat_message);
        $.ajax({
            url: './insert_chat.php', 
            data: {
                    to_user_id:to_user_id,
                    admin_id: admin_id,
                    chat_message: chat_message
                },
                type: 'post',
                dataType: 'json',
                success:function(data){
                    $('#chat_message_'+to_user_id).val('');
                    $('#chat_history_'+to_user_id).html(data);
                }
        });



    });

 
});





function make_dialoge_box(to_user_id, to_user_name,admin_id){
    var modal_elem = '<div id="user_dialog_'+to_user_id+'" class="to_user_dialog" title="Chat With Agent: '+to_user_name+'">';

    modal_elem +='<div style="height:400px; border:1px solid #ccc; overflow-y:scroll; margin-bottom:24px; padding:16px" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'"></div>';
    modal_elem +='<div class="form-group">';
    modal_elem +='<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
     modal_elem +='</div><div class="form-group" align="center">';
     modal_elem +='<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat" data-admin_id = "'+admin_id+'" >Send</button></div></div>';
     // return modal_elem;
     $('#user_model_details').html(modal_elem);
}


function change_seen_status(to_user_id_seen_status, admin_id_seen_status){
       $.ajax({
                url: './insert_chat.php', 
                data: {
                        to_user_id_seen_status:to_user_id_seen_status,
                        admin_id_seen_status: admin_id_seen_status
                    },
                    type: 'post',
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                    }
            })
}


