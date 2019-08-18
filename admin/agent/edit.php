<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	$query = "SELECT * FROM agent_list WHERE id='$agent_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $display = "none";
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Agent Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_update_status.php?agent_id=<?php echo $agent_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Status <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Status <span class="text-danger">*</span></label>
                
                <select class="select form-control"  name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="Registered"<?php if ($row['status']=='Registered') {
                        echo 'selected';
                    } ?>>Registered</option>
                    <option value="Pending" <?php if ($row['status']=='Pending') {
                        echo 'selected';
                    } ?>>Pending</option>
                    <option value="Processing" <?php if ($row['status']=='Processing') {
                        echo 'selected';
                    } ?>>Processing</option>
                    <option value="Active" <?php if ($row['status']=='Active') {
                        echo 'selected';
                    } ?>>Active</option>
                    <option value="Deactive" <?php if ($row['status']=='Deactive') {
                        echo 'selected';
                    } ?>>Deactive</option>
                    <option value="Promote" <?php if ($row['status']=='Promote') {
                        echo 'selected';
                        $display = '';
                    } ?>>Promote</option>
                    
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="level_div" style="display: <?php echo $display; ?>">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Level <span class="text-danger">*</span></label>
                
                <select class="select form-control"  name="level" id="level">
                    <option value="">Select Level</option>
                    <option value="Silver"<?php if ($row['level']=='Silver') {
                        echo 'selected';
                    } ?>>Silver</option>
                    <option value="Golden" <?php if ($row['level']=='Golden') {
                        echo 'selected';
                    } ?>>Golden</option>
                    <option value="Premium" <?php if ($row['level']=='Premium') {
                        echo 'selected';
                    } ?>>Premium</option>
                    
                </select>
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
