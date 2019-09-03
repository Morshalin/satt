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
<form class="form-validate-jquery" action='<?php echo ADMIN_URL; ?>/confirm-new-software/ajax_deliver_order.php?new_order_id=<?php echo $order_id; ?>' id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Deliver Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason" class="col-form-label">Domain link <span class="text-danger"> *</span></label>
                <input type="text" id="domain_link" name="domain_link" class="form-control" required="" placeholder="Put Domain link here">
            </div>
        </div>
            
        <div class="col-md-6">
            <div class="form-group">
                <label for="reason" class="col-form-label">Cpanel User Name <span class="text-danger"> *</span></label>
                <input type="text" id="cpanel_username" name="cpanel_username" class="form-control" required="" placeholder="Put C-Panel User Name Of This Software">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="reason" class="col-form-label">Cpanel Password <span class="text-danger"> *</span></label>
                <input type="text" id="password" name="password" class="form-control" required="" placeholder="Put C-Panel Password Of This Software">
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
