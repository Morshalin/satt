  /* ------------------------------------------------------------------------------
   *
   *  # Login pages
   *
   *  Demo JS code for a set of login and registration pages
   *
   *  CopyRight © TeamTRT
   *
   * ---------------------------------------------------------------------------- */


  // Setup module
  // ------------------------------

var LoginRegistration = function() {

    //
    // Return objects assigned to module
    //
    var _componentValidation = function() {
      $('#login_form').parsley().on('field:validated', function() {
        $('.parsley-ajax').remove();
          var ok = $('.parsley-error').length === 0;
          $('.bs-callout-info').toggleClass('hidden', !ok);
          $('.bs-callout-warning').toggleClass('hidden', ok);
      });
      $('#login_form').on('submit', function(e) {
          e.preventDefault();
          $('#submit').attr('disabled',true);
          $('.user_icon').addClass('spinner');
          var submit_url = $('#login_form').attr('action');
          //Start Ajax
          var formData = new FormData($("#login_form")[0]);
           formData.append('login', 'login');
          $.ajax({
              url: submit_url,
              type: 'POST',
              data: formData,
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false,
              dataType: 'JSON',
              success: function(data) {
                p_notify(data.message, 'success', 'Success');
                   $('#submit').attr('disabled',false);
                   $('.user_icon').removeClass('spinner');
                   noty('Be Patient. We are redirecting you to your destination.', 'success', 'Welcome', 'center');
                   setTimeout(function(){
                       window.location.href = data.goto;
                   }, 2000);
              },
              error: function(data) {
                var jsonValue = data.responseJSON;
                if (jsonValue) {
                const errors = jsonValue.errors;
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().addError('ajax', {
                                message: value,
                                updateClass: true
                            });
                        }

                        p_notify(value);
                        i++;
                    });
                } else {
                  p_notify(data.responseText);
                }
                $('#submit').attr('disabled',false);
                $('.user_icon').removeClass('spinner');
              }
          });
      });
    };

    return {
        initComponents: function() {
            _componentValidation();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    LoginRegistration.initComponents();
});
