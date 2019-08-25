<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent-gift/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Point Based Gift <small style="color: red"> (* Marked Fields Are Required)</small></legend>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="points" class="col-form-label">Points:  <span class="text-danger">*</span></label>
                <input type="number" min="0" name="points" id="points" class="form-control" placeholder="Give Points" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="gift_name" class="col-form-label">Gift Name: </label>
                <input type="text" name="gift_name" id="gift_name" class="form-control" placeholder="Person's Name" required autofocus>
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
