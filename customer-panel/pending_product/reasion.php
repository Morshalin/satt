<?php
require_once '../../config/config.php';
ajax();
?>


<?php 
    if (isset($_GET['product_id'])) {
       $product_id = $_GET['product_id'];
?>
<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo CUSTOMER_URL; ?>/pending_product/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create Notes <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason" class="col-form-label">Reasion for Product Delete</label>
                <textarea name="reason" id="reason" rows="3" class="form-control" style="resize: none;" placeholder=" New Note Description Here" required=""></textarea>
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
<?php } ?>
<!-- /login form -->
