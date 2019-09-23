<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['pending_graphics_order_id'])) {
    $price = '';
    $pending_graphics_order_id = $_GET['pending_graphics_order_id'];
    $query = "SELECT * FROM graphics_info WHERE id='$pending_graphics_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $order_date = $row['order_date'];
        $order_date = date("d-M-Y", strtotime($order_date));
        $probable_delivery_date = $row['probable_delivery_date'];
        $probable_delivery_date = date("d-M-Y", strtotime($probable_delivery_date));
        $price = $row['price'];


        if ($pending_graphics_order_id) {
          $query_graphics_pay = "select * from graphics_pay WHERE order_id = '$pending_graphics_order_id' ";
          $result_graphics_pay = $db->select($query_graphics_pay);

    }


    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Graphics Order Not Found']));
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
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Customer Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Customer Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['client_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Mobile NO :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['mobile_no']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Shipping Address :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['shipping_address']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Shipping Currier :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['currier_name']); ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Order Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Product Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['product_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Quantity :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['qty']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Price :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['price']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Advance :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['advance']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Date :</b>
                    <h6 class="col-md-8"><?php echo $order_date; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Status :</b>
                    <h6 class="col-md-8"><?php echo $row['status']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Notes :</b>
                    <h6 class="col-md-8"><?php echo $row['notes']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Taken By :</b>
                    <h6 class="col-md-8"><?php echo $row['order_taken_by']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>



        <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Cost Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Printing Cost :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['printing_cost']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Currier Cost :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['currier_cost']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Other Cost :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['others_cost']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Profit :</b>
                    <?php 
                        $profit = '0';
                        $profit = (int)$row['price'] - (int)$row['printing_cost'] - (int)$row['currier_cost'] - (int)$row['others_cost'];
                     ?>
                    <h6 class="col-md-8"><?php echo $profit; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>



        

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
                      <th scope="col">Tx ID / Account No</th>
                      <th scope="col">Recived Form</th>
                      <th scope="col">Recived By</th>
                      <th scope="col">Amount(Tk)</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 

        if ($pending_graphics_order_id) {
          $query_graphics_pay = "SELECT * FROM graphics_pay WHERE order_id = '$pending_graphics_order_id' order by id desc ";
          $result_graphics_pay = $db->select($query_graphics_pay);

        if ($result_graphics_pay) {
            $i = 0;
            $total_pay = 0;
            while ( $pay_row = $result_graphics_pay->fetch_assoc()) { 
                $i++;
                $total_pay +=  $pay_row['pay'];
                $due = $price - $total_pay;
                ?>
                <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo $pay_row['payment_method']; ?></td>
                      <td><?php echo $pay_row['tx_id_account_no']; ?></td>
                      <td><?php echo $pay_row['received_mobile_no']; ?></td>
                      <td><?php echo $pay_row['received_by']; ?></td>
                      <td><?php echo $pay_row['pay']; ?></td>
                      <td><?php echo $pay_row['date']; ?></td>
                    </tr>
         <?php  }
        }
    }
 ?>
                   <tr>
                      <th colspan="5" class="text-right" >Total Pay :</th>
                      <th colspan="2" ><?php echo $total_pay; ?></th>
                    </tr>
                   <tr>
                      <th colspan="5" class="text-right" >Price :</th>
                      <th colspan="2" ><?php echo $price; ?></th>
                    </tr>
                   <tr style="color: <?php if ($due > 0) {
                       echo "red";
                   }else{
                    echo 'green';
                   } ?>">
                      <th colspan="5" class="text-right" >Due :</th>
                      <th colspan="2" ><?php echo $due; ?></th>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>

</fieldset>
<!-- /login form -->
<!-- Display the countdown timer in an element -->



