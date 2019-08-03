<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message', 'Message');
if (isset($_GET['message_id'])) {
	$message_id = $_GET['message_id'];
	$query = "SELECT * FROM satt_message WHERE id='$message_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Message Type Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/message/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <!-- <legend class="text-uppercase font-size-sm font-weight-bold">Message <span class="text-danger">*</span> <small>  Fields Are Required </small></legend> -->
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Message type</label>
                <input type="text" name="message_type" id="message_type" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['message_type'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Customer question</label>
                <input type="text" name="customer_question" id="customer_question" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['customer_question'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Our replylabel>
                <input type="text" name="our_reply" id="our_reply" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['our_reply'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Software information</label>
                <input type="text" name="software_information" id="software_information" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['software_information'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Contact details</label>
                <input type="text" name="contact_details" id="contact_details" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['contact_details'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Introduction message</label>
                <input type="text" name="introduction_message" id="introduction_message" class="form-control" placeholder="Customer Reference" required autofocus value="<?php echo $row['introduction_message'] ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="status" id="status" value="<?php echo $row['status'] ?>" class="form-check-input-switchery mt-3" data-fouc checked>
            </div>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
