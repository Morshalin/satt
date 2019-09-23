<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/pending-new-software', 'Pending New Software');
if (isset($_GET['new_order_id'])) {
	$order_id = $_GET['new_order_id'];
	$query = "SELECT * FROM new_product_order WHERE id='$order_id'";
	$result = $db->select($query);
    $customer_id = '';
	if ($result) {
		$row = $result->fetch_assoc();
        $software_name = $row['expected_name_software'];
        $feature_note = $row['documentation_note'];
        $documentation_file = $row['file_upload_documentation'];
        $order_date = $row['order_date'];

        $agent_id = $row['agent_id'];
        $agent_name = $row['agent_name'];
        $customer_id = $row['customer_id'];
        $query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
        $get_agent_info = $db->select($query);
        if ($get_agent_info) {
            $agent = $get_agent_info->fetch_assoc();
            $agent_name = $agent['name'];
            $agent_email = $agent['email'];
            $agent_phn = $agent['mobile_no'];
            $agent_up = $agent['interested_up'];
            $agent_dist = $agent['interested_dist'];
        }else{
             $agent_name = '';
             $agent_email = '';
             $agent_up = '';
             $agent_dist = '';
        }


// software price details section End


} else {
    http_response_code(500);
    die(json_encode(['message' => 'Order Details Not Found']));
}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<fieldset class="mb-3">
    
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Basic Informantion </legend>
            <div class="row">
                <b class="col-md-4">Software Name :</b>
                <h6 class="col-md-8"><?php echo ucwords($software_name); ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Expected Features :</b>
                <h6 class="col-md-8"><?php echo $feature_note; ?></h6>
            </div>
           
              <div class="row">
                <b class="col-md-4">Documentation File :</b>
                <h6 class="col-md-8"><a href="../../uploads/<?php echo $documentation_file; ?>">Click Here To See Document Of Software Feature</a></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Order Date & Time :</b>
                <h6 class="col-md-8"><?php echo $row['order_date']; ?></h6>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
    <br ><br />

    <?php 

        $query = "SELECT * FROM satt_customer_informations WHERE id = '$customer_id'";
        $get_customer = $db->select($query);
        if ($get_customer) {
            $customer_info = $get_customer->fetch_assoc();
        }


     ?>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Customer Information</legend>
            <div class="row">
                <b class="col-md-4">Customer Name :</b>
                <h6 class="col-md-8"><?php echo ucwords($customer_info['name']); ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Phone Number :</b>
                <h6 class="col-md-8"><?php echo $customer_info['number']; ?></h6>
            </div>
           
              <div class="row">
                <b class="col-md-4">Email :</b>
                <h6 class="col-md-8"><?php echo $customer_info['email']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Institute Name :</b>
                <h6 class="col-md-8"><?php echo $customer_info['institute_name']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Institute Address :</b>
                <h6 class="col-md-8"><?php echo $customer_info['institute_address']; ?></h6>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
    <br ><br />



    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-sm-8">
        

        <?php 
        // software price details section   
        if ($agent_id) {
            ?>
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Agent Information </legend>
            <?php
             ?>


               <div class="col-lg-6">
                <div class="row">
                    <b class="col-md-8">Agent Name :</b>
                    <h6 class="col-md-4"><?php echo ucwords($agent_name); ?> </h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Phone Number :</b>
                    <h6 class="col-md-4"><?php echo ucwords($agent_phn); ?> </h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Email :</b>
                    <h6 class="col-md-4"><?php echo ucwords($agent_email); ?> </h6>
                </div>

                <div class="row">
                    <b class="col-md-8">Service Area :</b>
                    <h6 class="col-md-4"><?php echo ucwords($agent_up).', '.ucwords($agent_dist); ?> </h6>
                </div>

                <div class="row text-danger">
                    <b class="col-md-8">Agent Comission:</b>
                    <h6 class="col-md-4"><?php echo $row['agent_comission']; ?> /= </h6>
                </div>

                <div class="row text-danger">
                    <b class="col-md-8">Agent Selling Point:</b>
                    <h6 class="col-md-4"><?php echo $row['agent_point']; ?> </h6>
                </div>
                
                

            </div>

            <?php   } ?>
    </div>
    <div class="col-lg-2"></div>
</div><br><br>



    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Constraction Information</legend>
            <div class="row">
                <b class="col-md-4">Developer Name :</b>
                <h6 class="col-md-8">
                    <?php 
                        $query = "SELECT * FROM new_product_developer WHERE new_product_order_id = '$order_id'";
                        $get_developer = $db->select($query);
                        if ($get_developer) {
                            while ($dev = $get_developer->fetch_assoc()) {
                                $dev_id = $dev['developer_id'];
                                $query = "SELECT * FROM developer WHERE id = '$dev_id'";
                                $dev_info = $db->select($query);
                                if ($dev_info) {
                                    $devlop = $dev_info->fetch_assoc();
                                    ?>
                                    <span class="badge badge-success"><?php echo ucwords($devlop['name']); ?></span>
                                    <?php
                                }
                            }
                        }

                     ?>
                </h6>
            </div>
            <div class="row">
                <b class="col-md-4">Language :</b>
                <h6 class="col-md-8">
                    <?php 
                        $query = "SELECT * FROM new_product_language WHERE new_product_order_id = '$order_id'";
                        $get_language = $db->select($query);
                        if ($get_language) {
                            while ($lang = $get_language->fetch_assoc()) {
                                $lang_id = $lang['language_id'];
                                $query = "SELECT * FROM software_language WHERE id = '$lang_id'";
                                $lang_info = $db->select($query);
                                if ($lang_info) {
                                    $lang = $lang_info->fetch_assoc();
                                    ?>
                                    <span class="badge badge-success"><?php echo ucwords($lang['software_language_name']); ?></span>
                                    <?php
                                }
                            }
                        }

                     ?>
                </h6>
            </div>
           
              <div class="row">
                <b class="col-md-4">Order Confirm Date :</b>
                <h6 class="col-md-8"><?php echo $row['confirm_date']; ?></h6>
            </div>
           
              <div class="row">
                <b class="col-md-4">Development Start Date :</b>
                <h6 class="col-md-8"><?php echo $row['development_start_date']; ?></h6>
            </div>
            <div class="row text-danger">
                <b class="col-md-4">Expected Dead Line :</b>
                <h6 class="col-md-8"><?php echo $row['expected_dead_line']; ?></h6>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
    <br ><br />






    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Cost Information</legend>
            <div class="row">
                <b class="col-md-4">Selling Method :</b>
                <?php 
                    $selling_method = explode('_', $row['selling_method']);
                    $selling_method = implode(' ', $selling_method);
                 ?>
                <h6 class="col-md-8"> <?php echo ucwords($selling_method); ?> </h6>
            </div>

            <div class="row">
                <b class="col-md-4">Installation Charge :</b>
                <h6 class="col-md-8"> <?php echo $row['installation_charge']; ?> /= </h6>
            </div>

            <div class="row">
                <b class="col-md-4">Yearly Renew Charge :</b>
                <h6 class="col-md-8"> <?php echo $row['yearly_renew_charge']; ?> /=</h6>
            </div>

            <div class="row">
                <b class="col-md-4">Software Sell Price :</b>
                <h6 class="col-md-8"> <?php echo $row['sell_price']; ?> /=</h6>
            </div>
              

        </div>
        <div class="col-lg-2"></div>
    </div>
   



    <div class="row">
        <div class="col-lg-12">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold text-danger">Payment History </legend>
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
    if ($order_id) {
        $pay_query = "SELECT * FROM new_product_pay WHERE new_product_order_id='$order_id' order by id desc";
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
                      <td><?php echo $pay_row['payment_type']; ?></td>
                      <td><?php echo $pay_row['check_numer']; ?></td>
                      <td><?php echo $pay_row['mobile_banking_name']; ?></td>
                      <td><?php echo $pay_row['received_phone_number']; ?></td>
                      <td><?php echo $pay_row['tx_id']; ?></td>
                      <td><?php echo $pay_row['pay_amount']; ?></td>
                      <td><?php echo $pay_row['date']; ?></td>
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
    <br ><br />




<br>
<div class="form-group row">
    <div class="col-lg-3 offset-lg-4">
        <button type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal" >Close</button>
    </div>
</div>
</fieldset>

<!-- /login form -->
