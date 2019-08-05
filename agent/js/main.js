$(document).ready(function() {
    $(document).on('change', '#same_as ,#permanent_house, #permanent_road, #permanent_village, #permanent_post, #permanent_up, #permanent_dist, #permanent_post_code', function() {
        if ($('#same_as').prop('checked')) {
            $('#present_house').val($('#permanent_house').val()).attr('readonly', true);
            $('#present_road').val($('#permanent_road').val()).attr('readonly', true);
            $('#present_village').val($('#permanent_village').val()).attr('readonly', true);
            $('#present_post').val($('#permanent_post').val()).attr('readonly', true);
            $('#present_up').val($('#permanent_up').val()).attr('readonly', true);
            $('#present_dist').val($('#permanent_dist').val()).attr('readonly', true);
            $('#present_post_code').val($('#permanent_post_code').val()).attr('readonly', true);
        } else {
            $('#present_house').val('').attr('readonly', false);
            $('#present_road').val('').attr('readonly', false);
            $('#present_village').val('').attr('readonly', false);
            $('#present_post').val('').attr('readonly', false);
            $('#present_up').val('').attr('readonly', false);
            $('#present_dist').val('').attr('readonly', false);
            $('#present_post_code').val('').attr('readonly', false);
        }
    });
    $(document).on('change', '#terms_agree', function() {
        if ($('#terms_agree').prop('checked')) {
            $('#submit').attr('disabled', false);
        } else {
            $('#submit').attr('disabled', true);
        }
    });
    $(document).on('change', '#select_another', function() {
        var value = $(this).val();
        if (value == 'NID') {
            $('#front_end').removeClass('col-md-12 offset-3').hide();
            $('#front_end').addClass('col-md-6').show();
            $("input[name='document_fornt']").attr('required', true);
            $("#document_front_end_help").text("Upload Your Nid's Frontend Image");
            $('#backend').addClass('col-md-6').show();
            $("input[name='document_back']").attr('required', true);
        } else if (value == '') {
            $('#front_end').hide();
            
            $('#backend').hide();
        } else {
            $('#front_end').removeClass('col-md-6').hide();
            $('#backend').removeClass('col-md-6').hide();
            $('#front_end').addClass('col-md-6 offset-3').show();
            $("input[name='document_back']").attr('required', false);
            $("#document_front_end_help").text("Upload Your Document's Image");
        }
    });
    $(document).on('change', '#status', function() {
        var value = $(this).val();
        if (value == 'Promoted') {
            $('#level_row').show();
            $('#level').attr('required', true);
        } else {
            $('#level_row').hide();
            $('#level').attr('required', false);
        }
    });
    $(document).on('change', '#photo', function() {
        loadFile(event);
    });
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('photo_preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
    if ($('#agent_form').length > 0) {
        $('#agent_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
         $(document).on('submit','#agent_form',function(e){
        e.preventDefault();
        var formData = new FormData($("#agent_form")[0]);
        formData.append('submit','submit');

        $.ajax({
          url:'ajax_add_agent.php',
          data:formData,
          type:'POST',
          dataType:'json',
          cache: false,
          processData: false,
          contentType: false,
          success:function(data){
            // console.log(data);
                    Swal.fire({
                        title: data.title.substr(0,1).toUpperCase()+data.title.substr(1),
                        text: data.message,
                        type: data.title
                    });
                    console.log(data.message);
                    $('#submit').show();
                    $('#submiting').hide();
                    if (data.title == 'success') {
                         $('#agent_form')[0].reset();
                    }
                   
                    
                },
                error: function(data) {
                   console.log(data);
                }
            });
        });
    }
    if ($('#status_form').length > 0) {
        $('#status_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
        $('#status_form').on('submit', function(e) {
            e.preventDefault();
            $('#submit').hide();
            $('#submiting').show();
            var submit_url = $('#status_form').attr('action');
            $('.ajax_error').remove();
            //Start Ajax
            var formData = new FormData($("#status_form")[0]);
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: formData,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function(data) {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        type: 'success'
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                    setTimeout(function() {
                        window.location.href = '';
                    }, 1000);
                },
                error: function(data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors;
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('ajax', {
                                updateClass: true
                            });
                        }
                        $('#' + first_item).parsley().addError('ajax', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        i++;
                    });
                    Swal.fire({
                        title: 'Something Wrong!',
                        text: 'Please Check your Data and submit again.',
                        type: 'error'
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                }
            });
        });
    }
    $(document).on('click', '#status_btn', function() {
        $('#status_modal').modal('show');
        var status = $(this).data('status');
        var level = $(this).data('level');
        var id = $(this).data('id');
        var url = $(this).data('url');
        $('#status_form').attr('action', url);
        $('#status').val(status);
        $('#agent_id').val(id);
        if (status == 'Promoted') {
            $('#level_row').show();
            $('#level').attr('required', true);
        }
        $('#level').val(level);
    })
    $(document).on('click', '#agent_managment', function() {
        var submit_url = $(this).data('url');
        var id = $(this).data('id');
        var message = $(this).data('message');
        Swal.fire({
                title: 'Warning!!',
                text: message,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: submit_url,
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                type: 'success'
                            });
                            setTimeout(function() {
                                window.location.href = '';
                            }, 1000);

                            if (data.link) {
                                $('.pdf_btn_' + id).remove();
                                $('#pdf_link_' + id).attr('href', data.link).show();
                                $('.send_btn_' + id).show();
                            }

                        },
                        error: function(data) {
                            Swal.fire({
                                title: 'Something Wrong!',
                                text: 'Please Check your Data and submit again.',
                                type: 'error'
                            });
                        }
                    });
                }
            });
    })
});

var value = $('#status').val();
if (value == 'Promoted') {
    $('#level_row').show();
    $('#level').attr('required', true);
} else {
    $('#level_row').hide();
    $('#level').attr('required', false);
}