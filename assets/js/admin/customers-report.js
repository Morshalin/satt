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


    $(document).on('change','#users', function(){
        var users = $("#users").val();
        console.log(users);
        if (users == 'admin_id') {
            $("#admin_show").show(500);
            $("#systems_user_id").hide(500);
            $('#system_user').removeAttr('required');
            $("#agent_id").hide(500);
            $('#agent').removeAttr('required');
        }else if(users == 'systems_user_id'){
            $("#admin_show").hide(500);
            $('#admin').removeAttr('required');
            $("#systems_user_id").show(500);
            $("#agent_id").hide(500);
            $('#agent').removeAttr('required');
        }else if(users == 'agent_id'){
            $("#admin_show").hide(500);
            $('#admin').removeAttr('required');
            $("#systems_user_id").hide(500);
            $('#system_user').removeAttr('required');
            $("#agent_id").show(500);
        }else{
          $("#admin_show").hide(500);
            $("#systems_user_id").hide(500);
            $("#agent_id").hide(500);
        }
    })

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
