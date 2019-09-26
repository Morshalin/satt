<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/add_users', 'Add Users');
if (isset($_GET['users_id'])) {
	$users_id = $_GET['users_id'];
	$query = "SELECT * FROM users WHERE id = '$users_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'users Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/add_users/ajax_add_role.php?users_id=<?php echo $users_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Assign Role <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
    <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="id_number" class="col-form-label">Select Role<span class="text-danger">*</span></label>
                    
                    <select name="role_id" id="role_id" class="form-control" required autofocus>
                        <option value="">Please Select One</option>
                        <?php
                            $query = "SELECT * FROM role";
                            $get_role = $db->select($query);
                            if ($get_role) {
                                while ($row = $get_role->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['serial_no']?>"><?php echo $row['role_name']?></option>
                                    <?php
                                }
                            }
                        ?>
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
