<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/promote-product/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">New Promote Products <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="product_name" class="col-form-label">Product Name <span class="text-danger">*</span></label>
                <select class="select form-control"  multiple="multiple" name="product_name[]" id="product_name">
                       <?php
                       $query_software = "SELECT * FROM software_details where status = '1' ";
                       $select_software = $db->select($query_software);
                       if ($select_software) {
                        while ($software = $select_software->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $software['id']; ?>" ><?php echo $software['software_name']; ?></option>

                        <?php } }?>
                </select>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="start_date" class="col-form-label">Promote Start Date <span class="text-danger">*</span></label>
                <input type="text" name="start_date" id="start_date" class="form-control date" placeholder="Select Start Date" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="end_date" class="col-form-label">Promote End Date</label>
                <input type="text" name="end_date" id="end_date" class="form-control date" placeholder="Select End Date " required autofocus value="">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="discount_amt" class="col-form-label">Discount Amount</label>
                <input type="number" name="discount_amt" id="discount_amt" class="form-control" placeholder="Type Discount Amount" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="discount_amt" class="col-form-label">.</label>
               <select class="form-control" name="amount_type" id="amount_type">
                          <option value="percent" ><h4> % (Persent) </h4></option>
                          <option value="taka" ><h4> $ (Taka) </h4></option>
                </select>
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
