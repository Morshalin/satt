<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/new-software-monthly-pay', 'New Software Monthly Pay');
if (isset($_GET['pay_order_id'])) {
    $pay_order_id = $_GET['pay_order_id'];
    $query = "select * from new_product_order WHERE delivery_status = '1' and id = '$pay_order_id'";

    $result = $db->select($query);
    if (!$result) {
        http_response_code(500);
        die(json_encode(['message' => 'Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAuthorized']));
}

if ($result) {
    $row = $result->fetch_assoc();

    $delivery_date = date("Y-m-d", strtotime($row['delivery_date']));
    $today = date("Y-m-d");
    $delivery_date = strtotime($delivery_date);  
    $today = strtotime($today);  

    $diff = abs($today - $delivery_date);  
    $years = floor($diff / (365*60*60*24));  
    $months = floor(($diff - $years * 365*60*60*24) 
                            / (30*60*60*24)); 

    if ($months >= 1 ) {
        $order_id = $row['id'];
        $sell_price = $row['sell_price'];
        $total_amount = (int)$months * (int)$sell_price;
        
        $query = "SELECT * FROM new_product_pay WHERE new_product_order_id = '$order_id'";
        $get_pay = $db->select($query);
        $total_pay = 0 ;
        $due = 0;
        if ($get_pay) {
        while ($pay = $get_pay->fetch_assoc()) {
            $total_pay += (int)$pay['pay_amount'];
        }
        }
        if ($total_pay < $total_amount) {
        $due = $total_amount - $total_pay ;  

        }
    }
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/new-software-monthly-pay/ajax_pay.php?pay_order_id=<?php echo $pay_order_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Pay Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>

    

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="total_due" class="col-form-label">Total Due <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="total_due" id="total_due" class="form-control total_pay" readonly value="<?php echo $due; ?>">
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
                <select class="select form-control"  name="payment_method" id="payment_method" required>
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