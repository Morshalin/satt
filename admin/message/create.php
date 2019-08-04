<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/message/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Message <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Message type<span class="text-danger">*</span></label>
                <input type="text" name="message_type" id="message_type" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Customer question<span class="text-danger">*</span></label>
                <input type="text" name="customer_question" id="customer_question" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Our reply<span class="text-danger">*</span></label>
                <input type="text" name="our_reply" id="our_reply" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Software information<span class="text-danger">*</span></label>
                <input type="text" name="software_information" id="software_information" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Contact details<span class="text-danger">*</span></label>
                <input type="text" name="contact_details" id="contact_details" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Introduction message<span class="text-danger">*</span></label>
                <input type="text" name="introduction_message" id="introduction_message" class="form-control" placeholder="Customer Reference" required autofocus value="">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc checked>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
