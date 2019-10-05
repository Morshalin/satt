var tariq = '';
var flag = true;
var DatatableButtonsHtml5 = function() {
   


    return {
        init: function() {
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

    $(document).on('change','#report_type',function(){
        var report_type = $(this).val();
        // alert(report_type);

        if (report_type == 'status') {
            $('.status_div').show(500);
            $('#status').attr('required',true);
            
        }else{
            $('.status_div').hide(500);
            $('#status').attr('required',false);
            $('#status').val('');

        }
        if (report_type == 'transaction') {
            $('.transaction_type_div').show(500);
            $('#transaction_type').attr('required',true);
            
        }else{
            $('.transaction_type_div').hide(500);
            $('#transaction_type').attr('required',false);
            $('#transaction_type').val('');

        }
    });


         // now we are going to update and insert data 
         $(document).on('submit','.report_form',function(e){
            e.preventDefault();
            var formData = new FormData($(".report_form")[0]);
            formData.append('submit','submit');
    
            $.ajax({
              url:'ajax.php',
              data:formData,
              type:'POST',
              dataType:'json',
              cache: false,
              processData: false,
              contentType: false,
              success:function(data){
                  $("#show_report").html(data);
              }
            });
        }); // end of insert and update 


    
   


});
function printContent(el){
    var a = document.body.innerHTML;
    var b = document.getElementById(el).innerHTML;
    document.body.innerHTML = b;
    window.print();
    document.body.innerHTML = a;
    return window.location.reload(true);

  }
