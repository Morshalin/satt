<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/new-software-one-time-sell-pay', 'New Software One Time Sell Pay');
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
                
                

            </div>





            <?php   }
        
// software price details section End


        ?>
    </div>
    <div class="col-lg-2"></div>
</div>

<br>
<div class="form-group row">
    <div class="col-lg-3 offset-lg-4">
        <button type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal" >Close</button>
    </div>
</div>
</fieldset>

<!-- /login form -->
