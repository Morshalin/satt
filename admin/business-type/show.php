<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/business-type', 'business-type');
if (isset($_GET['software_id'])) {
	$software_id = $_GET['software_id'];
	$query = "SELECT * FROM satt_customer_business_type WHERE id='$software_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Business Category Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>


<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Business Category</label>
                <h6><?php echo $row['software_type'] ?></h6>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Create Date</label>
                <h6><?php echo $row['create_date'] ?></h6>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-4 offset-lg-4 mt-2">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>

