<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/confirm-order', 'Software Status');
if (isset($_GET['confirm_order_id'])) {
	$confirm_order_id = $_GET['confirm_order_id'];
	$query = "SELECT * FROM satt_order_products WHERE id='$confirm_order_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $agent_id = $row['agent_id'];
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
  <fieldset class="mb-3">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Order Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Product Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['product_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Pay Type :</b>
                    <h6 class="col-md-8"><?php echo $row['pay_type']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Installation Charge :</b>
                    <h6 class="col-md-8"><?php echo $row['installation_charge']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Pay Amount :</b>
                    <h6 class="col-md-8"><?php echo $row['pay_amount']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Agent Commission :</b>
                    <h6 class="col-md-8"><?php echo $row['agent_comission']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Yearly Renew Charge :</b>
                    <h6 class="col-md-8"><?php echo $row['yearly_renew_charge']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Date :</b>
                    <h6 class="col-md-8"><?php echo $row['order_date']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Confirm Date :</b>
                    <h6 class="col-md-8"><?php echo $row['confirm_date']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>


<?php 
    if ($confirm_order_id) {
        $customer_id = $row['customer_id'];
        $query = "SELECT * FROM satt_customer_informations WHERE id='$customer_id'";
        $result = $db->select($query);
        if ($result) {
            $row1 = $result->fetch_assoc();
        }
    }
 ?>
        <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Customer Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Customer Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row1['name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Number :</b>
                    <h6 class="col-md-8"><?php echo $row1['number']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Email :</b>
                    <h6 class="col-md-8"><?php echo $row1['email']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Institute Name :</b>
                    <h6 class="col-md-8"><?php echo $row1['institute_name']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Institute Address :</b>
                    <h6 class="col-md-8"><?php echo $row1['institute_address']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Institute District :</b>
                    <h6 class="col-md-8"><?php echo $row1['institute_district']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>


    <?php 
    if ($agent_id) {
        $query = "SELECT * FROM agent_list WHERE id='$agent_id'";
        $result = $db->select($query);
        if ($result) {
            $row2 = $result->fetch_assoc();
        }
 ?>
        <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Agent Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Agent Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row2['name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Number :</b>
                    <h6 class="col-md-8"><?php echo $row2['mobile_no']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Email :</b>
                    <h6 class="col-md-8"><?php echo $row2['email']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Interested District :</b>
                    <h6 class="col-md-8"><?php echo $row2['interested_dist']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Interested Sub-district :</b>
                    <h6 class="col-md-8"><?php echo $row2['interested_up']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Payment History </legend>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Payment Method</th>
                      <th scope="col">Check No</th>
                      <th scope="col">Mobile banking Name</th>
                      <th scope="col">Received Phone Number</th>
                      <th scope="col">Tx ID</th>
                      <th scope="col">Pay Amount</th>
                      <th scope="col">Pay Date</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
    if ($confirm_order_id) {
        $pay_query = "SELECT * FROM existing_product_pay WHERE product_order_id='$confirm_order_id'";
        $pay_result = $db->select($pay_query);
        if ($pay_result) {
            $i = 0;
            $total_pay = 0;
            while ( $pay_row = $pay_result->fetch_assoc()) { 
                $i++;
                $total_pay +=  $pay_row['pay_amount'];
                ?>
                <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo $pay_row['payment_method']; ?></td>
                      <td><?php echo $pay_row['check_no']; ?></td>
                      <td><?php echo $pay_row['mobile_banking_name']; ?></td>
                      <td><?php echo $pay_row['received_phone_number']; ?></td>
                      <td><?php echo $pay_row['tx_id']; ?></td>
                      <td><?php echo $pay_row['pay_amount']; ?></td>
                      <td><?php echo $pay_row['pay_date']; ?></td>
                    </tr>
         <?php  }
        }
    }
 ?>
                   <tr>
                      <th colspan="6" class="text-right" >Total Pay :</th>
                      <th colspan="2" ><?php echo $total_pay; ?></th>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</fieldset>
<!-- /login form -->
