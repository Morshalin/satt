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
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/agent/action.php', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            },{
                extend: 'selected',
                className: 'btn bg-success',
                text: 'Online',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/agent/action.php', action = 'active', msg = 'Change Status To Online');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-secondary',
                text: 'Offline',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/agent/action.php', action = 'inactive', msg = 'Change Status To Offline');
                }
            }, {
                extend: 'selected',
                className: 'btn bg-warning',
                text: 'Toggle Status',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, ADMIN_URL+'/agent/action.php', action = 'toggle', msg = 'Toggle Status');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 6]
            }, {
                orderable: false,
                targets: [5, 6]
            }],
            order: [0, 'DESC'],
            processing: true,
            serverSide: true,
            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex'
                },  {
                    data: 'name'
                }, {
                    data: 'photo'
                }, {
                    data: 'email'
                }, {
                    data: 'interested_dist'
                }, {
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
                    _modalFormValidation();
                    _componentDatePicker();
                    _componentTimePicker();
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

     var _componentSendMail = function() {
        $(document).on('click', '#send_mail', function(e) {
            e.preventDefault();
            // it will get action url
           
            var url = $(this).data('url');
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'json'
                })
                .done(function(data) { 
                      new PNotify({
                          title: "Success",
                          text: data.message,
                          type: "success",
                          addclass: 'alert alert-styled-left',
                      });
                      tariq.ajax.reload();
                })
                .fail(function(data) {
                    
                    if (data.responseText) {
                      new PNotify({
                          title: 'Opps!',
                          text: data,
                          type: 'error',
                          addclass: 'alert alert-styled-left',
                      });
                    }
                    $('#modal-loader').hide();
                });
        });
    };






     var _componentGenerateAppointment = function() {
        $(document).on('click', '#generate_appoint_letter', function(e) {
            e.preventDefault();
            // it will get action url
           
            var url = $(this).data('url');
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) { 
                      new PNotify({
                          title: 'Success!',
                          text: "Appointment Letter Generated Successfully",
                          type: 'success',
                          addclass: 'alert alert-styled-left',
                      });

                      tariq.ajax.reload();
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


     var _componentAddClient = function() {
        $(document).on('click', '.delete_agetnt_product', function(e) {
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


     var _componentAddClient = function() {
        $(document).on('click', '.delete_agetnt_contact', function(e) {
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


     var _componentDeleteAgentProduct = function() {
        $(document).on('click', '.delete_agetnt_client', function(e) {
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
            _componentSelect2Normal();
            _componentRemoteModalLoad();
            _componentGenerateAppointment();
            _componentDeleteAgentProduct();
            _componentAddClient();
            _componentSendMail();
            _componentDeleteNote();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});

// changint status of agent
 $(document).on('change','#status',function(){
        var status = $(this).val();
        if (status == 'Promote') {
            $("#level_div").show(500);
            $("#level").attr('required',    true);
        }else{
        $("#level_div").hide(500);
        $("#level").val("");
            $("#level").attr('required',false);


        }
    });



// showing and hiding document upload fieldes relating with the document type 

 $(document).on('change','#document_type',function(){
        var document_type = $(this).val();
        if (document_type == 'NID') {
            $("#up_front_text").html('Upload Frontend Image Of NID');

            $("#frontend_img_div").show(500);
          $("#document_front").val("");
            $("#backend_img_div").show(500);
            $("#backend_img_div").attr('required',true);
        }else if(document_type == 'Passport'){
            $("#up_front_text").html('Upload Image Of Passport');

            $("#frontend_img_div").show(500);
          $("#document_front").val("");
            $("#backend_img_div").hide(500);
            $("#backend_img_div").attr('required',false);
            $("#document_back").val("");
        }else if(document_type == 'Birth_Certificate'){
            $("#up_front_text").html('Upload Image Of Birth Certificate');
            $("#frontend_img_div").show(500);
          $("#document_front").val("");
            $("#backend_img_div").hide(500);
            $("#backend_img_div").attr('required',false);
            $("#document_back").val("");
        }else{
          $("#frontend_img_div").hide(500);
          $("#document_front").val("");

          $("#backend_img_div").hide(500);
          $("#backend_img_div").attr('required',false);
          $("#document_back").val("");


        }
    });

// showing image instantly beside the image selection window

function readURL(input,img_show,field_id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    var a=$(field_id)[0].files[0].size;

    if ( a > 1048576) {
      $(field_id).val("");
      // Swal.fire({
      //             title: "error",
      //             text: "Please Make Sure The Image Size Is Less Than 1 MB" ,
      //             type: "error"
      //         });
      // swal({
      //       title: "error",
      //       text: "Please Make Sure The Image Size Is Less Than 1 Mb",
      //       icon: "warning",
      //       buttons: true,
      //       // dangerMode: true,
      //   })
      // alert(a)

       new PNotify({
                    title: 'Error',
                    text: "Please Make Sure The Image Size Is Less Than 1 MB",
                    type: 'error',
                    addclass: 'alert alert-styled-left',
                });
    }else{

      reader.onload = function (e) {
        $(img_show)
        .show()
        .attr('src', e.target.result)
        .width(160)
        .height(190);

      };

      reader.readAsDataURL(input.files[0]);

    }
  }
}



