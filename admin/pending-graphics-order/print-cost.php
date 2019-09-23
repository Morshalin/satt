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
  <fieldset class="mb-3" id="print_table">

        <div class="row">
        
        <div class="col-lg-12">
          <!-- <div class="col-lg-4"></div> -->
            <div class="row">
                    <b class="col-md-4">Customer Name :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['client_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Mobile NO :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['mobile_no']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Shipping Address :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['shipping_address']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Shipping Currier :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['currier_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Product Name :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['product_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Date :</b>
                    <h6 class="col-md-8 text-right"><?php echo $order_date; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Cost History (<?php echo date('d-M-Y'); ?>)</legend>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col"> </th>
                      <th scope="col">#</th>
                      <th scope="col">Cost Type</th>
                      <th scope="col">Amount(Tk)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"> </th>
                      <th scope="row"><?php echo '1'; ?></th>
                      <td><?php echo 'Printing'; ?></td>
                      <td><?php echo ucwords($row['printing_cost']); ?></td>
                    </tr>
                    <tr>
                      <th scope="row"> </th>
                      <th scope="row"><?php echo '2'; ?></th>
                      <td><?php echo 'Currier'; ?></td>
                      <td><?php echo ucwords($row['currier_cost']); ?></td>
                    </tr>
                    <tr>                      
                      <th scope="row"> </th>
                      <th scope="row"><?php echo '3'; ?></th>
                      <td><?php echo 'Others'; ?></td>
                      <td><?php echo ucwords($row['others_cost']); ?></td>
                    </tr>
                   <tr>
                      <th colspan="3" class="text-right" >Total Cost :</th>
                      <th colspan="1" ><?php echo (int)$row['printing_cost'] + (int)$row['currier_cost'] + (int)$row['others_cost']; ?> /=</th>
                    </tr>
                  
                  </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="text-righ">
    
    <a class=" text-light btn-success btn" onclick="printContent('print_table')"><i class="icon-printer"></i> Print</span> </a>
</div>

</fieldset>
<!-- /login form -->
<!-- Display the countdown timer in an element -->

<script type="text/javascript">
    
    function printContent(el){
      var a = document.body.innerHTML;
      var b = document.getElementById(el).innerHTML;
      document.body.innerHTML = b;
      window.print();
      document.body.innerHTML = a;

    }

  </script>

