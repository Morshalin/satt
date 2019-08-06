<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-price', 'Software Price');
if (isset($_GET['software_price_id'])) {
	$software_price_id = $_GET['software_price_id'];
	$query = "SELECT * FROM software_price WHERE id='$software_price_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Software Price Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
  <fieldset class="mb-3">
    <!-- <legend class="text-uppercase font-size-sm font-weight-bold"></legend> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Software Name </label>
                <input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['software_name'] ?>">
            </div>
        </div>
				<div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Demo URL </label>
                <input type="text" name="demo_url" id="demo_url" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['demo_url'] ?>">
            </div>
        </div>
    </div>
		<div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Installation charge </label>
                <input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['installation_charge']." /=" ?>">
            </div>
        </div>
				<div class="col-lg-4">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Monthly charge </label>
                <input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['monthly_charge']." /=" ?>">
            </div>
        </div>
				<div class="col-lg-4">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Yearly charge </label>
                <input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['yearly_charge']." /=" ?>">
            </div>
        </div>
    </div>
		<div class="row">
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Direct sell </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['direct_sell']." /=" ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Total price </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['total_price']." /=" ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Agent commission (one time) </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['agent_commission_one_time']." /=" ?>">
						</div>
				</div>
		</div>
		<div class="row">
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Agent commission (monthly) </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['agent_commission_monthly']." /=" ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Discount offer </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['discount_offer']." /=" ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Yearly renew charge </label>
								<input type="text" name="software_language_name" id="software_language_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['yearly_renew_charge']." /=" ?>">
						</div>
				</div>
		</div>
    <div class="form-group row text-right">
        <div class="col-lg-12 offset-lg-12">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
<!-- /login form -->
