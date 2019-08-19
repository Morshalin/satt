<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/message_type/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold"> <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6 text-center mx-auto">
            <div class="form-group">
                <label for="type" class="col-form-label">Message type <span class="text-danger">*</span></label>
                <input type="text" name="message_type" id="message_type" class="form-control" placeholder="Customer Reference" required autofocus>
            </div>
        </div>
      </div>

    <div class="text-center">
      <button type="submit" name="create" class="btn btn-success ml-31 mr-2 px-5" id="submit">Add message type</button>
      <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
      <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
		</div>


</fieldset>
</form>
<!-- /login form -->
