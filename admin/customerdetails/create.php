<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/course/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create New Course <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" name="course_name" id="course_name" class="form-control" placeholder="New Course Name" required autofocus value="">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="course_code" class="col-form-label">Course Code <span class="text-danger">*</span></label>
                <input type="text" name="course_code" id="course_code" class="form-control" placeholder="New Course Code" required value="">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="course_description" class="col-form-label">Course Description</label>
                <textarea name="course_description" id="course_description" rows="3" class="form-control" style="resize: none;" placeholder="Enter New Course Description Here"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="course_status" id="course_status" value="1" class="form-check-input-switchery mt-3" data-fouc checked>

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
