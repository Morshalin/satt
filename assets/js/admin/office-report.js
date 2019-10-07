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

         // now we are going to update and insert data 
         $(document).on('submit','.report_form',function(e){
            e.preventDefault();
            //console.log("hello");
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
