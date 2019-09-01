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
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 8]
            }, {
                orderable: false,
                targets: [7,8]
            }],
            order: [1, 'desc'],
            processing: true,
            serverSide: true,
            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex'
                }, {
                    data: 'customer_name'
                }, {
                    data: 'customer_number'
                }, {
                    data: 'agent_name'
                }, {
                    data: 'product_name'
                }, {
                    data: 'pay_type'
                }, {
                    data: 'order_date'
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
            _componentSelect2Normal();
            _componentRemoteModalLoad();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});


       $('#discount_ammount').keyup(function(){
            var Totalamt = parseInt($('#Totalamt').val());
            var discount_ammount = parseInt($('#discount_ammount').val());
            var grandTotal = Totalamt - discount_ammount;
            $('#grandTotal').val(grandTotal);
            $('#dueAmmount').val(grandTotal);
        });
        $('#paidAmount').keyup(function(){
            var grandTotal = parseInt($('#grandTotal').val());
            var paidAmount = parseInt($('#paidAmount').val());
            var dueAmmount = grandTotal - paidAmount;
            $('#dueAmmount').val(dueAmmount);
        });
        $('#full_paid_tab').click(function(){
            var grandTotal = parseInt($('#grandTotal').val());
            var dueAmmount= parseInt($('#dueAmmount').val());
            var due = grandTotal - dueAmmount;
            $('#paidAmount').val(grandTotal);
            $('#dueAmmount').val(due);
        });