<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/developer/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create New Developere <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-form-label">Developer Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type Your name" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_status_name" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Type Your Email" required autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="mobile_no" class="col-form-label">Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Type Your Mobile No" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="image" class="col-form-label">Image </label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Enter Your Image" autofocus value="">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address" class="col-form-label">Address </label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Type Your Address" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="bio" class="col-form-label">Bio </label>
                <textarea name="bio" id="bio" class="form-control" placeholder="Type your bio" autofocus ></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook" class="col-form-label">Facebook Link </label>
                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Type Your Facebook Link" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="twitter" class="col-form-label">Twitter link </label>
                <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Type Your Twitter link" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="instagram" class="col-form-label">Instagram Link </label>
                <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Type Your Instagram Link" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="linkedin" class="col-form-label">Linkedin link</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Type Your Linkedin link" autofocus value="">
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
