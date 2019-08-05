<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/software-details/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">New Software Details</legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_name" class="col-form-label">Software Language Name <span class="text-danger">*</span></label>
                <input type="text" name="software_name" id="software_name" class="form-control" placeholder="Type Software Name" required autofocus value="">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Software Status <span class="text-danger">*</span></label>
                <select class="select form-control"  name="software_status" id="software_status">
                    <option value="">Select Software Status</option>
                       <?php
                       $query_software_status = "SELECT * FROM software_status";
                       $select_software_status = $db->select($query_software_status);
                       if ($select_software_status) {
                        while ($software_status = $select_software_status->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $software_status['software_status_name'].','.$software_status['id']; ?>" ><?php echo $software_status['software_status_name']; ?></option>

                        <?php } }?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_status_name" class="col-form-label">Software Language <span class="text-danger">*</span></label>
                <select class="select form-control"  multiple="multiple" name="language_name[]" id="language_name">
                       <?php
                       $query_software_language = "SELECT * FROM software_language";
                       $select_software_language = $db->select($query_software_language);
                       if ($select_software_language) {
                        while ($software_language = $select_software_language->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $software_language['software_language_name'].', '.$software_language['id']; ?>" ><?php echo $software_language['software_language_name']; ?></option>

                        <?php } }?>
                </select>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_status_name" class="col-form-label">Developed By <span class="text-danger">*</span></label>
                <select class="select form-control"  multiple="multiple" name="developer_name[]" id="developer_name">
                       <?php
                       $query_developer = "SELECT * FROM developer";
                       $select_developer = $db->select($query_developer);
                       if ($select_developer) {
                        while ($developer = $select_developer->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $developer['name'].', '.$developer['id']; ?>" ><?php echo $developer['name']; ?></option>

                        <?php } }?>
                </select>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="create_date" class="col-form-label">Software Start Date <span class="text-danger">*</span></label>
                <input type="text" name="create_date" id="create_date" class="form-control date" placeholder="Select Start Date" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="end_date" class="col-form-label">Software End Date</label>
                <input type="text" name="end_date" id="end_date" class="form-control date" placeholder="Select End Date " required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="short_feature" class="col-form-label">Software Short Features <span class="text-danger">*</span></label>
                <textarea name="short_feature" id="short_feature" class="form-control" placeholder="Type Short Features " required autofocus ></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="user_manual" class="col-form-label">Software User Manual</label>
                <input type="text" name="user_manual" id="user_manual" class="form-control" placeholder="Type User Manual " required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="condition_details" class="col-form-label">Software Proposal and Condition Demo Details </label>
                <textarea name="condition_details" id="condition_details" class="form-control" placeholder="Software End Date " required autofocus ></textarea>
            </div>
        </div>
    </div>

    <legend class="text-uppercase font-size-sm font-weight-bold">Software Price Details</legend>

        <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="demo_url" class="col-form-label">Software Demo Url </label>
                <input type="text" name="demo_url" id="demo_url" class="form-control" placeholder="Type Demo Url" required autofocus value="">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="installation_charge" class="col-form-label">Installation Charge </label>
                <input type="number" name="installation_charge" id="installation_charge" class="form-control" placeholder="Type Installation Charge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="monthly_charge" class="col-form-label">Monthly Cahrge </label>
                <input type="number" name="monthly_charge" id="monthly_charge" class="form-control" placeholder="Type Monthly Cahrge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="yearly_charge" class="col-form-label">Yearly Charge </label>
                <input type="number" name="yearly_charge" id="yearly_charge" class="form-control" placeholder="Type Yearly Charge" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="direct_sell" class="col-form-label">Direct Sell(One Time) </label>
                <input type="number" name="direct_sell" id="direct_sell" class="form-control" placeholder="Type Direct Sell(One Time)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="total_price" class="col-form-label">Total Price </label>
                <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Type Total Price" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="agent_commission_one_time" class="col-form-label">Agent Commission (One Time Sell) </label>
                <input type="number" name="agent_commission_one_time" id="agent_commission_one_time" class="form-control" placeholder="Type Agent Commission (One Time Sell)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="agent_commission_monthly" class="col-form-label">Agent Commission (Monthly) </label>
                <input type="number" name="agent_commission_monthly" id="agent_commission_monthly" class="form-control" placeholder="Type Agent Commission (Monthly)" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="discount_offer" class="col-form-label">Maximum Discount Offer  </label>
                <input type="number" name="discount_offer" id="discount_offer" class="form-control" placeholder="Type Discount Offer" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="yearly_renew_charge" class="col-form-label">Yearly Renew Charge </label>
                <input type="number" name="yearly_renew_charge" id="yearly_renew_charge" class="form-control" placeholder="Type Yearly Renew Charge" required autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc checked>

            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
