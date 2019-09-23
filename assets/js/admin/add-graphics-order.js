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
                    _componentDatePicker();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});

$(document).ready(function(){
  
   $(document).on('keyup blur','#price',function(){
        calculation();
   });
   $(document).on('keyup blur','#advance',function(){
        calculation();
   });
   $(document).on('keyup blur','#printing_cost',function(){
        calculation();
   });

   $(document).on('keyup blur','#currier_cost',function(){
        calculation();
   });

   $(document).on('keyup blur','#others_cost',function(){
        calculation();
   });


function calculation(){
    var price = $('#price').val();
    var advance = $('#advance').val();
    var printing_cost = $('#printing_cost').val();
    var currier_cost = $('#currier_cost').val();
    var others_cost = $('#others_cost').val();
    if (price == "") {
        price = 0;
    }
    if (advance == "") {
        advance = 0;
    }
    if (printing_cost == "") {
        printing_cost = 0;
    }
    if (currier_cost == "") {
        currier_cost = 0;
    }
    if (others_cost == "") {
        others_cost = 0;
    }

    var profit = parseInt(price) - parseInt(printing_cost) - parseInt(currier_cost) - parseInt(others_cost);
    var due = parseInt(price) - parseInt(advance);

    if (advance > price) {
        alert("Advance Payment Cannot Be Greater Than The Price...");
        $("#advance").val("0");
         advance = 0;
        $("#due").val(price);
    }else{

        $('#due').val(due);
    }
    
    $('#profit').val(profit);
   }
});
