<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', ADMIN_URL . '/available_product', 'Available Product');
if (isset($_GET['order_id'])) {
	$order_id = $_GET['order_id'];
	$query = "SELECT * FROM satt_order_products WHERE id='$order_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $software_id = $row['product_id'];
        $agent_id = $row['agent_id'];


        if ($software_id) {
          $query_lang_multi = "select * from software_language_multi WHERE software_id = '$software_id' ";
          $result_lang_multi = $db->select($query_lang_multi);

          $query_develope_by = "select * from software_develope_by WHERE software_id = '$software_id' ";
          $result_develope_by = $db->select($query_develope_by);
      }


       // software details section

      if ($software_id) {
        $query_price = "SELECT * FROM software_details WHERE id ='$software_id'";
        $result_info = $db->select($query_price);
        if ($result_info) {
         $soft_info = $result_info->fetch_assoc();
     }
 } else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Price Not Found']));
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

<fieldset class="mb-3">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold text-info">Software Basic Informantion </legend>
            <div class="row">
                <b class="col-md-4">Software Name :</b>
                <h6 class="col-md-8"><?php echo ucwords($row['product_name']); ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Developing Languages :</b>
                <?php 

                while ($row_lang_multi = mysqli_fetch_assoc($result_lang_multi)) {
                  $lang_id = $row_lang_multi['language_id'];
                  $query_lang = "select * from software_language WHERE id = '$lang_id'";
                  $result_lang = $db->select($query_lang)->fetch_assoc();
                  $lang_name = $result_lang['software_language_name']; ?>

                  <span class="badge badge-success mr-1"><?php echo ucfirst($lang_name); ?></span>

                  <?php   } ?>
              </div><br/>
              <div class="row">
                <b class="col-md-4">Short Features :</b>
                <h6 class="col-md-8"><?php echo $soft_info['short_feature']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Software Proposal and Condition :</b>
                <h6 class="col-md-8"><?php echo $soft_info['condition_details']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Software User Manual :</b>
                <h6 class="col-md-8"><?php echo $soft_info['user_manual']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <br ><br />



    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-sm-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold text-info">Software Price Details </legend>



            <div class="col-lg-6">
                <div class="row">
                    <b class="col-md-8">Pay Type :</b>
                    <h6 class="col-md-4"><?php echo $row['pay_type']; ?></h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Installation Charge :</b>
                    <h6 class="col-md-4"><?php echo $row['installation_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Yearly Renew Charge:</b>
                    <h6 class="col-md-4"><?php echo $row['yearly_renew_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Pay Amount :</b>
                    <h6 class="col-md-4"><?php echo $row['pay_amount']; ?> /=</h6>
                </div>

            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

        <br>
        <div class="form-group row">
            <div class="col-lg-3 offset-lg-4">
                <button type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </fieldset>

    <!-- /login form -->
