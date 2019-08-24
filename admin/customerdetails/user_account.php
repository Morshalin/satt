<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customerdetails', 'customerdetails');
if (isset($_GET['customerdetails_id'])) {
	$customerdetails_id = $_GET['customerdetails_id'];
	$query = "SELECT * FROM satt_customer_informations WHERE id='$customerdetails_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Customer Information Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/customerdetails/ajax.php?customerdetails_id=<?php echo $customerdetails_id; ?>&update=updatevalue" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Username And Password <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="offset-lg-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="username" class="col-form-label">Username<span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" class="form-control" required autofocus value="<?php echo $row['username']; ?>">
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="password" class="col-form-label">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control" required value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="confirm_password" class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required value="">
                <span id="success"></span>
            </div> 
        </div>
    </div>
  </div>
  <!--<input type="hidden" name="update" value="updatevalue">-->
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
