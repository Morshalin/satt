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
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/add_users/ajax.php?users_id=<?php echo $users_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create New userse <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="id_number" class="col-form-label">ID Number<span class="text-danger">*</span></label>
                    <input type="text" name="id_number" id="id_number" value="<?php echo $row['id_number']; ?>" class="form-control" placeholder="Type ID Number" required autofocus value="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>"  id="name" class="form-control" placeholder="Type Your name" required autofocus value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" id="email" class="form-control" placeholder="Type Your Mobile No" required autofocus value="">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="mobile_no" class="col-form-label">Mobile Number<span class="text-danger">*</span></label>
                    <input type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>"  id="mobile_no" class="form-control" placeholder="Type Your Mobile No" required autofocus value="">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="image" class="col-form-label">Image </label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Your Image" autofocus value="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address" class="col-form-label">Address </label>
                    <input type="text" name="address" value="<?php echo $row['address']; ?>"  id="address" class="form-control" placeholder="Type Your Address" autofocus value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="designation" class="col-form-label">Designation </label>
                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Type  Designation" autofocus value="<?php echo $row['designation']; ?>" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="facebook" class="col-form-label">Facebook Link </label>
                    <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Type Your Facebook Link" autofocus value="<?php echo $row['facebook']; ?>" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="user_name" class="col-form-label">User Nmae</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Type user name " autofocus value="<?php echo $row['user_name']; ?>" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="text" name="password" id="password" class="form-control" placeholder="Password" autofocus value="<?php echo $row['password']; ?>" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="confirm_password" class="col-form-label">Confirm Password</label>
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Password" autofocus value="<?php echo $row['password']; ?>" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                   <div class="pass_confirm_msg"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-check form-check-switchery form-check-inline form-check-right">
                    <label for="course_description" class="form-check-label">Active Status</label>
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
