<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel',  AGENT_URL . '/confirm_product', 'Confirm Product');
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $query = "SELECT * FROM satt_order_products WHERE id = '$order_id'";
    $get_order = $db->select($query);
    $product_id = '';
    $agent_id = '';
    $customer_id = '';
    if ($get_order) {
        $order = $get_order->fetch_assoc();
        $software_id = $order['product_id'];
        $agent_id = $order['agent_id'];
        $customer_id = $order['customer_id'];
    }

    $query = "SELECT * FROM software_details WHERE id='$software_id'";
    $result = $db->select($query);
    if ($result) {
      $software_info = $result->fetch_assoc();

      if ($software_id) {
          $query_lang_multi = "select * from software_language_multi WHERE software_id = '$software_id' ";
          $lang_multi = $db->select($query_lang_multi);

          $query_develope_by = "select * from software_develope_by WHERE software_id = '$software_id' ";
          $develope_by = $db->select($query_develope_by);
      }
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
            <legend class="text-uppercase  font-size-m font-weight-bold text-info">Software Basic Informantion </legend>
            <div class="row">
                <b class="col-md-4">Software Name :</b>
                <h6 class="col-md-8"><?php echo ucwords($software_info['software_name']); ?></h6>
            </div>
            
            <div class="row">
                <b class="col-md-4">Developing Languages :</b>
                <?php 

                while ($lang = mysqli_fetch_assoc($lang_multi)) {
                  $lang_id = $lang['language_id'];
                  $query_lang = "select * from software_language WHERE id = '$lang_id'";
                  $result_lang = $db->select($query_lang)->fetch_assoc();
                  $lang_name = $result_lang['software_language_name']; ?>

                  <span class="badge badge-success mr-1"><?php echo ucfirst($lang_name); ?></span>

              <?php   } ?>
          </div><br/>
          <div class="row">
            <b class="col-md-4">Short Features :</b>
            <h6 class="col-md-8"><?php echo $software_info['short_feature']; ?></h6>
        </div>
        <div class="row">
            <b class="col-md-4">Software Proposal and Condition :</b>
            <h6 class="col-md-8"><?php echo $software_info['condition_details']; ?></h6>
        </div>
        <div class="row">
            <b class="col-md-4">Software User Manual :</b>
            <h6 class="col-md-8"><?php echo $software_info['user_manual']; ?></h6>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
<br ><br />



<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-sm-8">
        <legend class="text-uppercase  font-size-m font-weight-bold text-info">Software Price Details </legend>



             <div class="col-lg-6">
                <div class="row">
                    <b class="col-md-8">Pay Type :</b>
                    <h6 class="col-md-4"><?php echo $order['pay_type']; ?> </h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Installation Charge :</b>
                    <h6 class="col-md-4"><?php echo $order['installation_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8">Yearly Renew Cahrge :</b>
                    <h6 class="col-md-4"><?php echo $order['yearly_renew_charge']; ?> /=</h6>
                </div>
                <div class="row">
                    <b class="col-md-8" style="color: green">Agent Comission :</b>
                    <h6 class="col-md-4"><?php echo $order['agent_comission']; ?> /=</h6>
                </div>
              
                <div class="row">
                    <b class="col-md-8">Order Date  :</b>
                    <h6 class="col-md-4"><?php echo $order['order_date']; ?></h6>
                </div>
              
                <div class="row">
                    <b class="col-md-8" style="color: red">Confirm Date  :</b>
                    <h6 class="col-md-4"><?php echo $order['confirm_date']; ?></h6>
                </div>
              

            </div>






</div>
<div class="col-lg-2"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-sm-8">
        <legend class="text-uppercase  font-size-m font-weight-bold text-info">Agent   Details </legend>

        <?php 

        $agent_query = "SELECT * FROM agent_list inner join satt_order_products on  agent_list.id = satt_order_products.agent_id";
        $agent_result = $db->select($agent_query);
        if ($agent_result) {
         $agent_row = $agent_result->fetch_assoc(); ?>
         <div class="row">
            <b class="col-md-3">Agent Name :</b>
            <h6 class="col-md-9"><?php echo $agent_row['name']; ?> </h6>
        </div>
        <div class="row">
            <b class="col-md-3">Mobile Number :</b>
            <h6 class="col-md-9"><?php echo $agent_row['mobile_no']; ?> </h6>
        </div>
        <div class="row">
            <b class="col-md-3">Alternate Mobile Number :</b>
            <h6 class="col-md-9"><?php echo $agent_row['alternate_mobile']; ?> </h6>
        </div>
        <div class="row">
            <b class="col-md-3">Email :</b>
            <h6 class="col-md-9"><?php echo $agent_row['email']; ?></h6>
        </div>
    <?php } ?>
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
