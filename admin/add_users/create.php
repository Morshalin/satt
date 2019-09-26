<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/add_users/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create New Users <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="id_number" class="col-form-label">ID Number<span class="text-danger">*</span></label>
                <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Type ID Number" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type Your name" required autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Type Your Mobile No" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="mobile_no" class="col-form-label">Mobile Number<span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Type Your Mobile No" required autofocus value="">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="image" class="col-form-label">Image </label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Enter Your Image" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address" class="col-form-label">Address </label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Type Your Address" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="designation" class="col-form-label">Designation </label>
                <input type="text" name="designation" id="designation" class="form-control" placeholder="Type  Designation" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook" class="col-form-label">Facebook Link </label>
                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Type Your Facebook Link" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="user_name" class="col-form-label">User Nmae</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Type user name " autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="confirm_password" class="col-form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Password" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="confirm_password" class="col-form-label"></label>
                 <label for="confirm_password" class="col-form-label"></label>
               <div id="success" class="mt-2"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Active Status</label>
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
