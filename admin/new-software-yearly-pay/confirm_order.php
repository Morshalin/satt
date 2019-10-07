<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-new-software', 'Confirm Order');
if (isset($_GET['new_order_id'])) {
    $new_order_id = $_GET['new_order_id'];
    $query = "SELECT * FROM new_product_order WHERE id='$new_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Pending Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/pending-new-software/ajax_confirm_order.php?new_order_id=<?php echo $new_order_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Confirm Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
   



    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <label for="software_status_name" class="col-form-label">Select Developer <span class="text-danger">*</span></label>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <select class="select form-control"  multiple="multiple" name="developer_id[]" id="developer_id" required="" data-parsley-errors-container="#developer_error">
                       <?php
                       $query_developer = "SELECT * FROM developer where status = '1' ";
                       $select_developer = $db->select($query_developer);
                       if ($select_developer) {
                        while ($developer = $select_developer->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $developer['id']; ?>" ><?php echo $developer['name']; ?></option>

                        <?php } }?>
                </select>
                <span id="developer_error"></span>

            </div>
        </div>
    </div>


  

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <label for="software_status_name" class="col-form-label">Software Language <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">

                <select class="select form-control"  multiple="multiple" name="language_id[]" id="language_id" required="" data-parsley-errors-container="#language_error">
                 <?php
                 $query_software_language = "SELECT * FROM software_language where status = '1' ";
                 $select_software_language = $db->select($query_software_language);
                 if ($select_software_language) {
                    while ($software_language = $select_software_language->fetch_assoc()) {
                      ?>
                      <option value="<?php echo $software_language['id']; ?>" ><?php echo $software_language['software_language_name']; ?></option>

                  <?php } }?>
              </select>
              <span id="language_error"></span>
          </div>
      </div>
  </div>



  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Development Start Date <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="text" name="development_start_date" id="development_start_date" class="form-control date" required="">
        </div>
    </div>
</div>



  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Expected Dead Line <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="text" name="expected_dead_line" id="expected_dead_line" class="form-control date" required="">
        </div>
    </div>
</div>




  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Selling Method <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <select name="selling_method" id="selling_method" class="form-control" required="">
                <option value="">Please Select A Method</option>
                <option value="monthly_pay"> Monthly Pay</option>
                <option value="yearly_pay">Yearly Pay</option>
                <option value="direct_sell">Direct Sell</option>
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Installation Charge <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" min="0" name="installation_charge" id="installation_charge" placeholder="Provide Installation Charge" class="form-control" required="">
        </div>
    </div>
</div>

<?php 

    if ($row['agent_id'] != '') {
        $display_status = '';
        $required = 'required';
    }else{
        $display_status = 'display: none';
         $required = '';
    }


 ?>
<div class="row" style="<?php echo $display_status ?>">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Agent Comission <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" min="0" name="agent_comission" id="agent_comission" placeholder="Provide Agent Comission" class="form-control" <?php echo $required; ?>>
        </div>
    </div>
</div>


<div class="row" style="<?php echo $display_status ?>">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="agent_point" class="col-form-label">Agent Point <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" min="0" name="agent_point" id="agent_point" placeholder="Provide Agent Point On Sale" class="form-control" <?php echo $required; ?>>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Yearly Renew Charge <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" min="0" name="yearly_renew_charge" id="yearly_renew_charge" placeholder="Provide Yearly Renew Charge" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="seling_total_price" class="col-form-label">Selling Total Price <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" name="seling_total_price" id="seling_total_price" class="form-control seling_total_price" required="" >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="pay_amount" class="col-form-label">Pay <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" name="pay_amount" id="pay_amount" class="form-control" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="due_amount" class="col-form-label">Due </label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="number" name="due_amount" id="due_amount" class="form-control" required="" readonly="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="payment_method" class="col-form-label">Payment Method <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <select class="select form-control"  name="payment_method" id="payment_method">
                <option value="">Select Payment Method</option>
                <option id="cash" value="cash" >Cash</option>
                <option id="mobile" value="mobile" >Mobile Banking</option>
                <option id="check" value="check" >Check</option>
            </select>
        </div>
    </div>
</div>

<div class="row" style="display: none;" id="check_method">
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <label for="check_no" class="col-form-label">Check No <span class="text-danger">*</span></label>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="text" name="check_no" id="check_no" class="form-control" >
        </div>
    </div>
</div>

<div  style="display: none;" id="mobile_method">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <label for="mobile_banking_name" class="col-form-label">Mobile Banking Name <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="mobile_banking_name" id="mobile_banking_name" class="form-control" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <label for="received_phone_number" class="col-form-label">Receive Phone Number <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="received_phone_number" id="received_phone_number" class="form-control" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <label for="tx_id" class="col-form-label">Tx ID <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="tx_id" id="tx_id" class="form-control" >
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-4 offset-lg-4">
        <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Update</button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</div>
</fieldset>
</form>
<!-- /login form -->
