<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/unpaid-delivered-graphics', 'Unpaid Graphics Order');
if (isset($_GET['unpaid_graphics_order_id'])) {
    $unpaid_graphics_order_id = $_GET['unpaid_graphics_order_id'];
    $query = "SELECT * FROM graphics_info WHERE id='$unpaid_graphics_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $price = $row['price'];
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Graphics Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

if ($unpaid_graphics_order_id) {

    $pay_query = "SELECT * FROM graphics_pay WHERE order_id ='$unpaid_graphics_order_id'";
    $pay_result = $db->select($pay_query);
    if ($pay_result) {
        $total_pay = 0;
        while ($pay_row = mysqli_fetch_assoc($pay_result)){
             $total_pay += $pay_row['pay'];
             $total_due = $price - $total_pay;
        }
    }
    
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/unpaid-delivered-graphics/ajax_pay.php?pay_order_id=<?php echo $unpaid_graphics_order_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Pay Graphics Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
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
                <label for="seling_total_price" class="col-form-label">Total Price <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" name="seling_total_price" id="seling_total_price" class="form-control seling_total_price" readonly value="<?php echo $price; ?>">
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
                <input type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Type Payment Method" autofocus value="" required>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="payment_method" class="col-form-label">Tx ID/Account No <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                 <input type="text" name="tx_id_account_no" id="tx_id_account_no" class="form-control" placeholder="Type Tx ID/Account No" autofocus value="" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="payment_method" class="col-form-label">Received Mobile No<span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="received_mobile_no" id="received_mobile_no" class="form-control" placeholder="Type Received Mobile No" autofocus value="" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="payment_method" class="col-form-label">Received By<span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="received_by" id="received_by" class="form-control" placeholder="Type Your Name" autofocus value="" required>
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


<script>
    
$(document).on('keyup','#pay_amount',function(){
    var total_due = parseInt($('#total_due').val());
    var pay_amount = parseInt($('#pay_amount').val());
    var due_amount = total_due - pay_amount;
    $('#due_amount').val(due_amount);

    if (pay_amount > total_due) {
        alert("New Pay amount can't gatter then Total Due");
       $('#pay_amount').val('');
       $('#due_amount').val('');
    }
});
</script>