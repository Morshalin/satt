<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/confirm-order', 'Deliver Order');
if (isset($_GET['deliver_order_id'])) {
    $deliver_order_id = $_GET['deliver_order_id'];
    $query = "SELECT * FROM satt_order_products WHERE id='$deliver_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Confirm Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/confirm-order/ajax.php?deliver_order_id=<?php echo $deliver_order_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Delivery Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="installation_charge" class="col-form-label">Installation Charge</label>
                <input type="text" name="installation_charge" id="installation_charge" class="form-control" readonly autofocus value="<?php echo $row['installation_charge']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="installation_charge_pay" class="col-form-label">Installation Charge Pay <span class="text-danger">*</span></label>
                <input type="text" name="installation_charge_pay" id="installation_charge_pay" class="form-control" placeholder="Pay Installation Charge" required autofocus >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="payment_method" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                <select class="select form-control"  name="payment_method" id="payment_method">
                    <option value="">Select Payment Method</option>
                          <option id="cash" value="cash" >Cash</option>
                          <option id="mobile" value="mobile" >Mobile Banking</option>
                          <option id="check" value="check" >Check</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="display: none;" id="check_method">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="check_no" class="col-form-label">Check No <span class="text-danger">*</span></label>
                <input type="text" name="check_no" id="check_no" class="form-control" >
            </div>
        </div>
    </div>

    <div  style="display: none;" id="mobile_method">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="mobile_banking_name" class="col-form-label">Mobile Banking Name <span class="text-danger">*</span></label>
                    <input type="text" name="mobile_banking_name" id="mobile_banking_name" class="form-control" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="received_phone_number" class="col-form-label">Receive Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="received_phone_number" id="received_phone_number" class="form-control" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <label for="tx_id" class="col-form-label">Tx ID</label>
                <div class="form-group">
                    <input type="text" name="tx_id" id="tx_id" class="form-control" >
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="cpanel_user" class="col-form-label">Cpanel Username <span class="text-danger">*</span></label>
                <input type="text" name="cpanel_user" id="cpanel_user" class="form-control" placeholder="Type Cpanel Username" required autofocus >
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="cpanel_pass" class="col-form-label">Cpanel Password <span class="text-danger">*</span></label>
                <input type="text" name="cpanel_pass" id="cpanel_pass" class="form-control" placeholder="Type Cpanel Password" required autofocus >
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Update</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
