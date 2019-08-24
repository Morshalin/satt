<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/software-price/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">New Software Details</legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_name" class="col-form-label">Software Name <span class="text-danger">*</span></label>
                <!-- <input type="text" name="software_name" id="software_name" class="form-control" placeholder="Type Software Name" required autofocus value=""> -->
                <select type="text" name="software_name" id="software_name" class="form-control" required autofocus>
                    <option value="">Please Select One</option>
                  <?php
                  $result = $db->select("SELECT * FROM software_details");

                        $result_check = mysqli_num_rows($result);
                        if( $result_check > 0 ){
                          while ($row = mysqli_fetch_assoc($result)) {
                              ?>
                              <option value="<?php echo $row['software_name']; ?>"> <?php echo $row['software_name']; ?> </option>
                              <?php
                          }
                        }
                 ?>
                </select>
            </div>
        </div>
    </div>

    <legend class="text-capitalize font-size-sm font-weight-bold">Software Price Details</legend>

        <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="demo_url" class="col-form-label">Software Demo Url <span class="text-danger">*</span> </label>
                <input type="text" name="demo_url" id="demo_url" class="form-control" placeholder="Type Demo Url" required autofocus value="">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="installation_charge" class="col-form-label">Installation Charge (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="installation_charge" id="installation_charge" class="form-control" placeholder="Type Installation Charge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="monthly_charge" class="col-form-label">Monthly Cahrge (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="monthly_charge" id="monthly_charge" class="form-control" placeholder="Type Monthly Cahrge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="yearly_charge" class="col-form-label">Yearly Charge (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="yearly_charge" id="yearly_charge" class="form-control" placeholder="Type Yearly Charge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="direct_sell" class="col-form-label">Direct Sell(One Time) (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="direct_sell" id="direct_sell" class="form-control" placeholder="Type Direct Sell(One Time)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="total_price" class="col-form-label">Total Price (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Type Total Price" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="agent_commission_one_time" class="col-form-label">Agent Commission (One Time Sell) <span class="text-danger">*</span> </label>
                <input type="number" name="agent_commission_one_time" id="agent_commission_one_time" class="form-control" placeholder="Type Agent Commission (One Time Sell)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="agent_commission_monthly" class="col-form-label">Agent Commission (Monthly) <span class="text-danger">*</span> </label>
                <input type="number" name="agent_commission_monthly" id="agent_commission_monthly" class="form-control" placeholder="Type Agent Commission (Monthly)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="agent_commission_yearly" class="col-form-label">Agent Commission (Yearly) <span class="text-danger">*</span> </label>
                <input type="number" name="agent_commission_yearly" id="agent_commission_yearly" class="form-control" placeholder="Type Agent Commission (Yearly)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="discount_offer" class="col-form-label">Maximum Discount Offer (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="discount_offer" id="discount_offer" class="form-control" placeholder="Type Discount Offer" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="yearly_renew_charge" class="col-form-label">Yearly Renew Charge (BDT) <span class="text-danger">*</span> </label>
                <input type="number" name="yearly_renew_charge" id="yearly_renew_charge" class="form-control" placeholder="Type Yearly Renew Charge" required autofocus value="">
            </div>
        </div>
    </div>

    <div class="col-lg-12 text-right">
        <button type="submit" name="create" class="btn btn-success" style="padding-right: 40px; padding-left: 40px; margin-right: 10px" id="submit">Add this software</button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
    </div>
</fieldset>
</form>
<!-- /login form -->
