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
		die(json_encode(['message' => 'Software price Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/software-price/ajax.php?software_price_id=<?php echo $software_price_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Software Price</legend>
		<div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Software Name </label>
                <input type="text" name="software_name" id="software_name" class="form-control" placeholder="New Software Status Name" readonly autofocus value="<?php echo $row['software_name'] ?>">
								<input type="hidden" name="old_software_id"  value="<?php echo $row['software_id'] ?>">
								<input type="hidden" name="old_software_name"  value="<?php echo $row['software_name'] ?>">
            </div>
        </div>
				<div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Demo URL </label>
                <input type="text" name="demo_url" id="demo_url" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['demo_url'] ?>">
								<input type="hidden" name="old_demo_url"  value="<?php echo $row['demo_url'] ?>">
            </div>
        </div>
    </div>
		<div class="row">
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Installation charge </label>
								<input type="text" name="installation_charge" id="installation_charge" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['installation_charge'] ?>">
								<input type="hidden" name="old_installation_charge"  value="<?php echo $row['installation_charge'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Monthly charge </label>
								<input type="text" name="monthly_charge" id="monthly_charge" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['monthly_charge'] ?>">
								<input type="hidden" name="old_monthly_charge"  value="<?php echo $row['monthly_charge'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Yearly charge </label>
								<input type="text" name="yearly_charge" id="yearly_charge" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['yearly_charge'] ?>">
								<input type="hidden" name="old_yearly_charge"  value="<?php echo $row['yearly_charge'] ?>">
						</div>
				</div>
		</div>
		<div class="row">
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Direct sell </label>
								<input type="text" name="direct_sell" id="direct_sell" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['direct_sell'] ?>">
								<input type="hidden" name="old_direct_sell"  value="<?php echo $row['direct_sell'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Total price </label>
								<input type="text" name="total_price" id="total_price" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['total_price'] ?>">
								<input type="hidden" name="old_total_price"  value="<?php echo $row['total_price'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Agent commission (one time) </label>
								<input type="text" name="agent_commission_one_time" id="agent_commission_one_time" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['agent_commission_one_time'] ?>">
								<input type="hidden" name="old_agent_commission_one_time"  value="<?php echo $row['agent_commission_one_time'] ?>">
						</div>
				</div>
		</div>
		<div class="row">
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Agent commission (monthly) </label>
								<input type="text" name="agent_commission_monthly" id="agent_commission_monthly" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['agent_commission_monthly'] ?>">
								<input type="hidden" name="old_agent_commission_monthly"  value="<?php echo $row['agent_commission_monthly'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Discount offer </label>
								<input type="text" name="discount_offer" id="discount_offer" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['discount_offer'] ?>">
								<input type="hidden" name="old_discount_offer"  value="<?php echo $row['discount_offer'] ?>">
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
								<label for="course_name" class="col-form-label">Yearly renew charge </label>
								<input type="text" name="yearly_renew_charge" id="yearly_renew_charge" class="form-control" placeholder="New Software Status Name" autofocus value="<?php echo $row['yearly_renew_charge'] ?>">
								<input type="hidden" name="old_yearly_renew_charge"  value="<?php echo $row['yearly_renew_charge'] ?>">
						</div>
				</div>
		</div>
    <!-- <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Update</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div> -->
		<div class="col-lg-12 text-right">
				<button type="submit" name="create" class="btn btn-success" style="padding-right: 50px; padding-left: 50px; margin-right: 10px" id="submit">Update</button>
				<button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
		</div>
</fieldset>
</form>
<!-- /login form -->
