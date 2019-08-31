<?php
require_once '../../config/config.php';
ajax();
?>


<?php 
    if (isset($_GET['new_order_id'])) {
       $order_id = $_GET['new_order_id'];
       // die($order_id);
?>
<!-- Login form -->
<form class="form-validate-jquery" action='<?php echo CUSTOMER_URL; ?>/pending-new-software/ajax.php?new_order_id=<?php echo $order_id; ?>' id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Cancel Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason" class="col-form-label">Please Share A Reason Of Cancelling Order <span class="text-danger"> *</span></label>
                <textarea name="cancel_reason" id="cancel_reason" rows="3" class="form-control" style="resize: none;" placeholder=" Cancel Reason" required=""></textarea>
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
