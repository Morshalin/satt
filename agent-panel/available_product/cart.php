<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL . '/available_product', 'Available Product');
$agent_id = $user['id'];

if (isset($_GET['software_details_id'])) {
	$software_details_id = $_GET['software_details_id'];
	$query = "SELECT * FROM software_details WHERE id='$software_details_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $software_id = $row['id'];
        $create_date = $row['create_date'];
        $new_create_date = date("d-M-Y", strtotime($create_date));
        $end_date = $row['end_date'];
        $new_end_date = date("d-M-Y", strtotime($end_date));


        if ($software_id) {
          $query_lang_multi = "select * from software_language_multi WHERE software_id = '$software_id' ";
          $result_lang_multi = $db->select($query_lang_multi);

          $query_develope_by = "select * from software_develope_by WHERE software_id = '$software_id' ";
          $result_develope_by = $db->select($query_develope_by);
      }

 // software price details section

      if ($software_id) {
        $query_price = "SELECT * FROM software_price WHERE software_id='$software_id'";
        $result_price = $db->select($query_price);
        if ($result_price) {
           $row_price = $result_price->fetch_assoc();
       }
   } else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Price Not Found']));
}
// software price details section End


} else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Details Not Found']));
}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo AGENT_URL; ?>/available_product/ajax_cart.php" id="content_form"  method="post">
  <fieldset class="mb-3">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-sm-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Price Details </legend>

            <?php 
        // software price details section   
            if ($software_id) {
                $new_query_price = "SELECT * FROM software_price WHERE software_id='$software_id'";
                $new_result_price = $db->select($new_query_price);
                if ($new_result_price) {
                 $new_row_price = $new_result_price->fetch_assoc(); ?>


                 <div class="col-lg-6">
                    <div class="row">
                        <b class="col-md-8">Installation Charge :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['installation_charge']; ?> /=</h6>
                        <input type="hidden" value="<?php echo $new_row_price['installation_charge']; ?>" name="installation_charge">
                    </div>
                    <div class="row">
                        <b class="col-md-8">Monthly Cahrge :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['monthly_charge']; ?> /=</h6>
                    </div>
                    <div class="row">
                        <b class="col-md-8">Yearly Charge :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['yearly_charge']; ?> /=</h6>
                    </div>
                    <div class="row">
                        <b class="col-md-8">Direct Sell(One Time) :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['direct_sell']; ?> /=</h6>
                    </div>
                    <div class="row">
                        <b class="col-md-8">Total Price :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['total_price']; ?> /=</h6>
                    </div>
                    


                    <div class="row">
                        <b class="col-md-8">Maximum Discount Offer  :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['discount_offer']; ?> /=</h6>
                    </div>
                    <div class="row">
                        <b class="col-md-8">Yearly Renew Charge  :</b>
                        <h6 class="col-md-4"><?php echo $new_row_price['yearly_renew_charge']; ?> /=</h6>
                    </div>

                

                </div>





            <?php   }
        } else {
            http_response_code(500);
            die(json_encode(['message' => 'Software Price Not Found']));
        }
// software price details section End


        ?>
    </div>
    <div class="col-lg-2"></div>
</div><br><br>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="form-group" style="margin-top:px">
            <label for="pay_types" class="col-form-label"><strong>Select Pay Type </strong><span class="text-danger">*</span></label>
            <select class="select form-control"  name="pay_type" id="pay_type" required="">
                <option value=""> Please Select One</option>
                <option value="monthly_pay"> Monthly Pay</option>
                <option value="yearly_pay">Yearly Pay</option>
                <option value="direct_sell">Direct Sell</option>
            </select>
            <input type="hidden" id="agent_id" name="agent_id" value="<?php echo $agent_id ?>">

            <input type="hidden" id="software_id" name="software_id" value="<?php echo $software_id ?>">
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="form-group">
            <label for="agent" class="col-form-label"><strong>Select Your Customer</strong><span class="text-danger">*</span></label>
            <select class="select form-control"  name="customer_id" id="customer_id" required="">
                <option value="">Please Select One</option>
                <?php 
                $query = "SELECT * from agent_client where agent_id = '$agent_id'";
                $result = $db->select($query);
                if ($result) {
                    while ($data = $result->fetch_assoc()) {
                        $client_id = $data['client_id'];
                        $query = "SELECT * FROM satt_customer_informations WHERE id = '$client_id'";
                        $get_client = $db->select($query);
                        if ($get_client) {
                            while ($client_info = $get_client->fetch_assoc()) {
                                $client_id_no = $client_info['id'];
                                $client_name = $client_info['name'];
                                ?>
                                     <option value="<?php echo $client_id_no; ?>"><?php echo 'Name : '.$client_name; ?></option>
                                <?php
                            }
                        }
                    }
                }


                ?>
            </select>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>



<div class="form-group row">
    <div class="col-lg-4 offset-lg-4">
        <button type="submit" name="create" class="btn btn-primary ml-31" id="add_to_cart"><i class="icon-cart"></i> Add To Cart </button>

        <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>
</fieldset>
</form>
<!-- /login form -->
