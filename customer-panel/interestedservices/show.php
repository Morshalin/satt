<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/interestedservice', 'interestedservice');
if (isset($_GET['services_id'])) {
	$services_id = $_GET['services_id'];
	$query = "SELECT * FROM satt_customer_interestedservice WHERE id='$services_id'";
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
    <div class="col-lg-12">
        <div class="form-group">
            <label for="progress_state" class="col-form-label">Interested Service</label>
                <h6><?php echo $row['services'] ?></h6>
        </div>
    </div>



<div class="form-group row">
    <div class="col-lg-4 offset-lg-4 mt-2">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>

