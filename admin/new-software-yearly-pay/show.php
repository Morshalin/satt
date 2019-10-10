<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/new-software-yearly-pay/', 'New software yearly pay');
if (isset($_GET['new_order_id'])) {
    $new_order_id = $_GET['new_order_id'];
    $query = "SELECT * FROM new_product_order WHERE id='$new_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $agent_id = $row['agent_id'];
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'New software yearly pay not found']));
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
                    <h6 class="col-md-8"><?php echo ucwords($row['expected_name_software']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Pay Type :</b>
                    <h6 class="col-md-8"><?php echo $row['selling_method']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Installation Charge :</b>
                    <h6 class="col-md-8"><?php echo $row['installation_charge']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Pay Amount :</b>
                    <h6 class="col-md-8"><?php echo $row['sell_price']; ?></h6>
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
                    <b class="col-md-4">Extra Feature:</b>
                    <h6 class="col-md-8"><?php echo $row['documentation_note']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Date :</b>
                    <h6 class="col-md-8"><?php echo $row['order_date']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Confirm Date :</b>
                    <h6 class="col-md-8"><?php echo $row['confirm_date']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Order Delivered Date :</b>
                    <h6 class="col-md-8"><?php echo $row['delivery_date']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Cpanel Username :</b>
                    <h6 class="col-md-8"><?php echo $row['cpanel_username']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Cpanel Password :</b>
                    <h6 class="col-md-8"><?php echo $row['password']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>


<?php 
    if ($new_order_id) {
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



            
<?php 
    if ($new_order_id) {
        $pay_query = "SELECT * FROM new_product_pay WHERE new_product_order_id='$new_order_id'  order by id desc";
        $pay_result = $db->select($pay_query);
        $total_pay = 0;
        if ($pay_result) { ?>
                <div class="table-responsive">
                    <h4 class="text-danger">Yearly Pay</h4>
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
            $i = 0;
            while ( $pay_row = $pay_result->fetch_assoc()) { 
                $i++;
                $total_pay +=  $pay_row['pay_amount'];
                ?>
                <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo $pay_row['payment_type']; ?></td>
                      <td><?php echo $pay_row['check_numer']; ?></td>
                      <td><?php echo $pay_row['mobile_banking_name']; ?></td>
                      <td><?php echo $pay_row['received_phone_number']; ?></td>
                      <td><?php echo $pay_row['tx_id']; ?></td>
                      <td><?php echo $pay_row['pay_amount']; ?></td>
                      <td><?php echo date('Y-m-d', strtotime($pay_row['date'])); ?></td>
                    </tr>
         <?php  } ?>
                   <tr>
                      <th colspan="6" class="text-right" >Total :</th>
                      <th colspan="2" ><?php echo $total_pay; ?></th>
                    </tr>
                     <?php } } ?>
                  </tbody>
                </table>
            </div>



                        
            <?php 
                if ($new_order_id) {
                    $install_pay_query = "SELECT * FROM new_product_installation_pay WHERE new_product_order_id ='$new_order_id'";
                    $insall_pay_result = $db->select($install_pay_query);
                    $install_total_pay = 0;
                    if ($insall_pay_result) { ?>
                        <div class="table-responsive">
                            <h4 class="text-danger">Installation Charage Pay</h4>
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
                        $i = 0;
                        while ( $install_pay_row = $insall_pay_result->fetch_assoc()) { 
                            $i++;
                            $install_total_pay +=  $install_pay_row['pay_amount'];
                            ?>
                            <tr>
                                  <th scope="row"><?php echo $i; ?></th>
                                  <td><?php echo $install_pay_row['payment_type']; ?></td>
                                  <td><?php echo $install_pay_row['check_numer']; ?></td>
                                  <td><?php echo $install_pay_row['mobile_banking_name']; ?></td>
                                  <td><?php echo $install_pay_row['received_phone_number']; ?></td>
                                  <td><?php echo $install_pay_row['tx_id']; ?></td>
                                  <td><?php echo $install_pay_row['pay_amount']; ?></td>
                                  <td><?php echo date('Y-m-d', strtotime($install_pay_row['date'])); ?></td>
                                </tr>
                     <?php  }  ?>
                               <tr>
                                  <th colspan="6" class="text-right" >Total :</th>
                                  <th colspan="2" ><?php echo $install_total_pay; ?></th>
                                </tr>
                                 <?php } } ?>
                              </tbody>
                            </table>
                        </div>





                        
            <?php 
                if ($new_order_id) {
                    $yeraly_install_pay_query = "SELECT * FROM new_product_yearly_charge_pay WHERE new_product_order_id='$new_order_id'";
                    $yeraly_insall_pay_result = $db->select($yeraly_install_pay_query);
                        $yeraly_install_total_pay = 0;
                    if ($yeraly_insall_pay_result) {
                        ?>
                        <div class="table-responsive">
                            <h4 class="text-danger">Yerally Renew Charage Pay</h4>
                          <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Payment Type</th>
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
                        $i = 0;
                        while ( $yeraly_install_pay_row = $yeraly_insall_pay_result->fetch_assoc()) { 
                            $i++;
                            if($yeraly_install_pay_row['pay_amount']){
                                 $yeraly_install_total_pay +=  $yeraly_install_pay_row['pay_amount'];
                            }
                           
                            ?>
                            <tr>
                                  <th scope="row"><?php echo $i; ?></th>
                                  <td><?php echo $yeraly_install_pay_row['payment_type']; ?></td>
                                  <td><?php echo $yeraly_install_pay_row['check_numer']; ?></td>
                                  <td><?php echo $yeraly_install_pay_row['mobile_banking_name']; ?></td>
                                  <td><?php echo $yeraly_install_pay_row['received_phone_number']; ?></td>
                                  <td><?php echo $yeraly_install_pay_row['tx_id']; ?></td>
                                  <td><?php echo $yeraly_install_pay_row['pay_amount']; ?></td>
                                  <td><?php echo date('Y-m-d', strtotime($yeraly_install_pay_row['date'])); ?></td>
                                  
                                </tr>
                     <?php  } ?>
                               <tr>
                                  <th colspan="6" class="text-right" >Total:</th>
                                  <th colspan="2" ><?php echo $yeraly_install_total_pay; ?></th>
                                </tr>
                            <?php } } ?>
                              </tbody>
                            </table>
                        </div>
        
        
        </div>
        
        <div class="col-sm-12">
        <p class="h3 text-center text-info border border-info p-3">Total Pay: <?php 
                $overall = $total_pay + $install_total_pay + $yeraly_install_total_pay;
                echo $overall;
         ?></p>
         </div>
          
    </div>
</fieldset>
<!-- /login form -->
