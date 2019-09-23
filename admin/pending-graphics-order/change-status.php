<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['pending_graphics_order_id'])) {
    $pending_graphics_order_id = $_GET['pending_graphics_order_id'];
    $query = "SELECT * FROM graphics_info WHERE id='$pending_graphics_order_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Graphics Order Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}


?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/pending-graphics-order/ajax_change_status.php?change_order_id=<?php echo $pending_graphics_order_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Change Order Status <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


     <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
                <label for="due_amount" class="col-form-label">Order Status<span class="text-danger">*</span> </label>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <select class="form-control mt-1" name="order_status" required="" id="order_status">
                          <option value="">Select Order Status</option>
                          <option value="Pending" <?php if ($status == 'Pending') {echo 'selected'; } ?>>Pending</option>
                          <option value="Developing" <?php if ($status == 'Developing') {echo 'selected'; } ?>>Developing</option>
                          <option value="Printing" <?php if ($status == 'Printing') {echo 'selected'; } ?>>Printing</option>
                          <option value="Sent To Currier" <?php if ($status == 'Sent To Currier') {echo 'selected'; } ?>>Sent To Currier</option>
                          <option value="Delivered" <?php if ($status == 'Delivered') {echo 'selected'; } ?>>Delivered</option>
                </select>
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
