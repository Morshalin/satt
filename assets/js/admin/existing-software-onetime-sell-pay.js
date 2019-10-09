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
            columnDefs: [{
                width: "100px",
                targets: [0, 9]
            }, {
                orderable: false,
                targets: [8,9]
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
                    data: 'product_name'
                }, {
                    data: 'customer_name'
                }, {
                    data: 'customer_number'
                }, {
                    data: 'agent_name'
                },{
                    data: 'agent_phn'
                }, {
                    data: 'delivery_date'
                }, {
                    data: 'status'
                }, {
                    data: 'due'
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
  
    $(document).on('change','#payment_method', function(){
        var payment_method = $("#payment_method").val();
        if (payment_method == 'check') {
            $("#check_method").show(500);
            $("#check_no").attr("required",true);
        }else{
            $("#check_method").hide(500);
            $("#check_no").val("");
            $("#check_no").attr("required",false);

        }
    });

       $(document).on('change','#payment_method', function(){
        var payment_method = $("#payment_method").val();
        if (payment_method == 'mobile') {
            $("#mobile_method").show(500);
            $("#mobile_banking_name").attr("required",true);
            $("#received_phone_number").attr("required",true);
        }else{
            $("#mobile_method").hide(500);
            $("#mobile_banking_name").val("");
            $("#received_phone_number").val("");
            $("#tx_id").val("");
            $("#mobile_banking_name").attr("required",false);
            $("#received_phone_number").attr("required",false);
        }
    })


$(document).on('keyup','#pay_amount',function(){
    // var seling_total_price = parseInt($('#seling_total_price').val());
    var pay_amount = parseInt($('#pay_amount').val());
    var total_due = parseInt($('#total_due').val());
    var current_due = total_due - pay_amount;
    $('#due_amount').val(current_due);

    if (pay_amount > total_due) {
        alert("Pay Amount Can't Be Greater Than The Due.... ");
       $('#pay_amount').val('');
       $('#due_amount').val('');
    }
});

$(document).on('blur','#pay_renew',function(){
    var pay_renew = parseFloat($('#pay_renew').val());
    var yearly_renew_charge = parseFloat($('#yearly_renew_charge').val());

    if (pay_renew > yearly_renew_charge) {
        alert("Pay Amount Must Not be Greater Than The Yearly Renew Charge");
       $('#pay_renew').val('');
    }else if ( yearly_renew_charge > pay_renew) {
        alert("Please Pay Total Renew Charge..");
        $('#pay_renew').val('');
    }
});

$(document).on('click','#submit',function(){
    var pay_renew = parseFloat($('#pay_renew').val());
    var yearly_renew_charge = parseFloat($('#yearly_renew_charge').val());

    if (yearly_renew_charge > 0 ) {
        if (pay_renew != yearly_renew_charge) {
            alert("Pay The Yearly Renew Charge First..");
           $('#pay_renew').val('');
        }
    }
});



});