<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['pending_graphics_order_id'])) {
	$pending_graphics_order_id = $_GET['pending_graphics_order_id'];
	$query = "SELECT * FROM graphics_info WHERE id='$pending_graphics_order_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $order_id = $row['id'];
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Developer Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

if ($order_id) {
    $query1 = "SELECT * FROM graphics_pay WHERE order_id='$order_id' limit 1 ";
    $result1 = $db->select($query1);
    if ($result1) {
        $row1 = $result1->fetch_assoc();
    }
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/pending-graphics-order/ajax.php?order_id=<?php echo $pending_graphics_order_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
          <legend class="text-uppercase font-size-sm font-weight-bold">Add New Graphics Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


    <div class="row">


        <div class="col-lg-4">
            <div class="form-group">
                <label for="client_name" class="col-form-label">Client Name<span class="text-danger">*</span></label>
                <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Type Client Name" required autofocus value="<?php echo $row['client_name']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="mobile_no" class="col-form-label">Mobile No<span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Type Mobile No" required autofocus value="<?php echo $row['mobile_no']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="shipping_address" class="col-form-label">Shipping Address<span class="text-danger">*</span></label>
                <input type="text" name="shipping_address" id="shipping_address" class="form-control" placeholder="Type Shipping Address" required autofocus value="<?php echo $row['shipping_address']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="currier_name" class="col-form-label">Currier Name<span class="text-danger">*</span></label>
                <input type="text" name="currier_name" id="currier_name" class="form-control" placeholder="Type Currier Name" required autofocus value="<?php echo $row['currier_name']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="product_name" class="col-form-label">Product Name<span class="text-danger">*</span></label>
                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Type Order Name" required autofocus value="<?php echo $row['product_name']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="order_date" class="col-form-label">Order Date<span class="text-danger">*</span></label>
                <input type="text" name="order_date" id="order_date" class="form-control date" placeholder="Select Order Date" required autofocus value="<?php echo $row['order_date']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="qty" class="col-form-label">Quantity<span class="text-danger">*</span></label>
                <input type="text" name="qty" id="qty" class="form-control" placeholder="Type Quantity" required autofocus value="<?php echo $row['qty']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="payment_method" class="col-form-label">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Type Payment Method" autofocus value="<?php echo $row1['payment_method']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="tx_id_account_no" class="col-form-label">Tx ID/Account No</label>
                <input type="text" name="tx_id_account_no" id="tx_id_account_no" class="form-control" placeholder="Type Tx ID/Account No" autofocus value="<?php echo $row1['tx_id_account_no']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="received_mobile_no" class="col-form-label">Received Mobile No</label>
                <input type="text" name="received_mobile_no" id="received_mobile_no" class="form-control" placeholder="Type Received Mobile No" autofocus value="<?php echo $row1['received_mobile_no']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="probable_delivery_date" class="col-form-label">Probable Delivery Date</label>
                <input type="text" name="probable_delivery_date" id="probable_delivery_date" class="form-control date" placeholder="Select Probable Delivery Date" autofocus value="<?php echo $row['probable_delivery_date']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                <input type="number" name="price" id="price" class="form-control " placeholder="Type Product Price" required autofocus value="<?php echo $row['price']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="advance" class="col-form-label">Advance</label>
                <input type="number" name="advance" id="advance" class="form-control" placeholder="Type Advance Price" autofocus value="<?php echo $row['advance']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <?php 
                        $due = '0';
                        $due = (int)$row['price'] - (int)$row['advance'];
                     ?>
                <label for="due" class="col-form-label">Due</label>
                <input type="number" name="due" id="due" class="form-control " readonly="" autofocus value="<?php echo $due; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="printing_cost" class="col-form-label">Printing Cost<span class="text-danger">*</span></label>
                <input type="number" name="printing_cost" id="printing_cost" class="form-control" placeholder="Type Printing Cost" required autofocus value="<?php echo $row['printing_cost']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="currier_cost" class="col-form-label">Currier Cost<span class="text-danger">*</span></label>
                <input type="number" name="currier_cost" id="currier_cost" class="form-control" placeholder="Type Currier Cost" required autofocus value="<?php echo $row['currier_cost']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="others_cost" class="col-form-label">Other Cost</label>
                <input type="number" name="others_cost" id="others_cost" class="form-control" placeholder="Type Other Cost"  autofocus value="<?php echo $row['others_cost']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <?php 
                        $profit = '0';
                        $profit = (int)$row['price'] - (int)$row['printing_cost'] - (int)$row['currier_cost'] - (int)$row['others_cost'];
                     ?>
                <label for="profit" class="col-form-label">Profit</label>
                <input type="number" name="profit" id="profit" class="form-control" placeholder=""  autofocus value="<?php echo $profit; ?>" readonly="">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group pt-2">
                <label for="order_status" class="form-check-label">Order Status</label>
                  <select class="form-control mt-1" name="order_status" required="" id="order_status">
                          <option value="">Select Order Status</option>
                          <option <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?> value="Pending" >Pending</option>
                          <option <?php echo ($row['status'] == 'Developing') ? 'selected' : ''; ?> value="Developing" >Developing</option>
                          <option <?php echo ($row['status'] == 'Printing') ? 'selected' : ''; ?> value="Printing" >Printing</option>
                          <option <?php echo ($row['status'] == 'Sent To Currier') ? 'selected' : ''; ?> value="Sent To Currier" >Sent To Currier</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="notes" class="col-form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" placeholder="Type Order Note"  autofocus><?php echo $row['notes']; ?></textarea>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="order_taken_by" class="col-form-label">Order Taken By</label>
                <input type="text" name="order_taken_by" id="order_taken_by" class="form-control" placeholder="Order Taken By"  autofocus value="<?php echo $row['order_taken_by']; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="demo_photo" class="col-form-label">Demo Photo Upload</label>
                <input type="file" name="demo_photo" id="demo_photo" class="form-control" placeholder="Order Taken By"  autofocus value="">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        </div>
    </div>

        </fieldset>
</form>
<!-- /login form -->
