<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/available_product', 'Available Product');
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
<form class="form-validate-jquery" action="<?php echo CUSTOMER_URL; ?>/available_product/ajax.php?software_details_id=<?php echo $software_details_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">

    <div class="row" style="display: none;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Basic Informantion </legend>
            <div class="row">
                <b class="col-md-4">Software Name :</b>
                <input type="text" value="<?php echo ucwords($row['software_name']); ?>" name="product_name">
            </div>
            <div class="row">
                <b class="col-md-4">Software Status :</b>
                <h6 class="col-md-8"><?php echo ucwords($row['software_status_name']); ?></h6>
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
                <h6 class="col-md-8"><?php echo $row['short_feature']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Software Proposal and Condition :</b>
                <h6 class="col-md-8"><?php echo $row['condition_details']; ?></h6>
            </div>
            <div class="row">
                <b class="col-md-4">Software User Manual :</b>
                <h6 class="col-md-8"><?php echo $row['user_manual']; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div

      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-sm-8">
        <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Price Details </legend>

        <?php 
        // software price details section   
        if ($software_id) {
            $new_query_price = "SELECT * FROM software_price_log WHERE software_id='$software_id'";
            $new_result_price = $db->select($new_query_price);
            if ($new_result_price) {
               $new_row_price = $new_result_price->fetch_assoc(); ?>


               <div class="col-lg-6">
                <div class="row">
                    <b class="col-md-8">New Installation Charge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['installation_charge']; ?> /=</h6>
                    <input type="hidden" value="<?php echo $new_row_price['installation_charge']; ?>" name="installation_charge">
                </div>
                <div class="row">
                    <b class="col-md-8">New Monthly Cahrge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['monthly_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Yearly Charge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['yearly_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Direct Sell(One Time) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['direct_sell']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Total Price :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['total_price']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Agent Commission (One Time Sell) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['agent_commission_one_time']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Agent Commission (Monthly) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['agent_commission_monthly']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Maximum Discount Offer  :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['discount_offer']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">New Yearly Renew Charge  :</b>
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
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="form-group">
            <label for="pay_types" class="col-form-label"><strong>Software Status </strong><span class="text-danger">*</span></label>
            <select class="select form-control"  name="pay_types" id="pay_types">
                <?php
                $query_charge = "SELECT * FROM software_price_log where software_id = '$software_id'";
                $select_charge = $db->select($query_charge);
                if ($select_charge) {
                    while ($charge = $select_charge->fetch_assoc()) {
                        $charge_id = $charge['id'];
                        ?>
                        <option value="<?php echo $charge['monthly_charge'].',' .'Monthly pay'; ?>"> Monthly Pay</option>
                        <option value="<?php echo $charge['yearly_charge'].','.'Yearly pay'; ?>">Yearly Pay</option>
                        <option value="<?php echo $charge['direct_sell'].','.'Direct Sell'; ?>">Direct Sell</option>

                    <?php } }?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2"></div>
</div>



    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit"><i class="icon-cart"></i> Add To Cart   </button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
