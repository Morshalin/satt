<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/progressivestate', 'progressivestate');
if (isset($_GET['progress_id'])) {
	$progress_id = $_GET['progress_id'];
	$query = "SELECT * FROM satt_customer_progres WHERE id='$progress_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Course Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>


<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Progressive State</label>
                <h6><?php echo $row['progress_state'] ?></h6>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Progressive Create Date</label>
                <h6><?php echo $row['create_date'] ?></h6>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-4 offset-lg-4 mt-2">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>

