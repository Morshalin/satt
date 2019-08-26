<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-status', 'Software Status');
if (isset($_GET['software_status_id'])) {
	$software_status_id = $_GET['software_status_id'];
	$query = "SELECT * FROM software_status WHERE id='$software_status_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Software Status Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">View Software Status </legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Software Status Name <span class="text-danger">*</span></label>
                <input type="text" name="software_status_name" id="software_status_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['software_status_name'] ?>">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" readonly name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>

            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
<!-- /login form -->
