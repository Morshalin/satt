<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/leav_us', 'leav_us');
if (isset($_GET['reason_id'])) {
	$reason_id = $_GET['reason_id'];
	$query = "SELECT * FROM satt_customer_notes WHERE id='$reason_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>


<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Leave Reason </label>
                <h6><?php echo $row['reason'] ?></h6>
        </div>
    </div>



<div class="form-group row">
    <div class="col-lg-4 offset-lg-4 mt-2">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>

