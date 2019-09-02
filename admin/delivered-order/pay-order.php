<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/confirm-order', 'Deliver Order');
if (isset($_GET['pay_order_id'])) {
    $pay_order_id = $_GET['pay_order_id'];
    $query = "SELECT * FROM satt_order_products WHERE id='$pay_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $product_order_id = $row['id'];
        $seling_total_price = $row['seling_total_price'];
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Confirm Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

if ($product_order_id) {

    $pay_query = "SELECT * FROM existing_product_pay WHERE product_order_id ='$product_order_id'";
    $pay_result = $db->select($pay_query);
    if ($pay_result) {
        $total_pay = 0;
        while ($pay_row = mysqli_fetch_assoc($pay_result)){
             $total_pay += $pay_row['pay_amount'];
             $total_due = $seling_total_price - $total_pay;
        }
    }
    
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/confirm-order/ajax_pay.php?pay_order_id=<?php echo $pay_order_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Confirm Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row d-none" >
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="total_price" class="col-form-label">Product Total Price <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="total_price" id="total_price" class="form-control"  >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="seling_total_price" class="col-form-label">Selling Total Price <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="seling_total_price" id="seling_total_price" class="form-control seling_total_price" readonly value="<?php echo $seling_total_price; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="total_pay" class="col-form-label">Total Pay <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="total_pay" id="total_pay" class="form-control total_pay" readonly value="<?php echo $total_pay; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="total_due" class="col-form-label">Total Due <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="total_due" id="total_due" class="form-control total_pay" readonly value="<?php echo $total_due; ?>">
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="pay_amount" class="col-form-label">New Pay <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="pay_amount" id="pay_amount" class="form-control" required="">
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="due_amount" class="col-form-label">Current Due </label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="due_amount" id="due_amount" class="form-control" required="" readonly="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="payment_method" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
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
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="check_no" class="col-form-label">Check No <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="check_no" id="check_no" class="form-control" >
            </div>
        </div>
    </div>

<div  style="display: none;" id="mobile_method">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="mobile_banking_name" class="col-form-label">Mobile Banking Name <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="mobile_banking_name" id="mobile_banking_name" class="form-control" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="received_phone_number" class="col-form-label">Receive Phone Number <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="received_phone_number" id="received_phone_number" class="form-control" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="tx_id" class="col-form-label">Tx ID</label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="tx_id" id="tx_id" class="form-control" >
            </div>
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