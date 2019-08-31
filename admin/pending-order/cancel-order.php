<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/pending-order', 'Pending Order');
if (isset($_GET['pending_order_id'])) {
    $pending_order_id = $_GET['pending_order_id'];
    $query = "SELECT * FROM satt_order_products WHERE id='$pending_order_id'";
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
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/pending-order/ajax.php?pending_order_id=<?php echo $pending_order_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Cancel Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Cancel Reason <span class="text-danger">*</span></label>
                <textarea name="cancel_reason" id="cancel_reason" class="form-control" placeholder="Type Cancel Reason" required autofocus></textarea>

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
