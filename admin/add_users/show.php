<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/add_users', 'View users Profile');
if (isset($_GET['users_id'])) {
	$users_id = $_GET['users_id'];
	$query = "SELECT * FROM users WHERE id='$users_id'";
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
  <fieldset class="mb-3">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <img src="<?php echo $row['image']; ?>" alt="" style="width: 220px; ">

            </div>
        </div>
        <div class="col-lg-8">
    <legend class="text-uppercase font-size-m font-weight-bold">Personal Informantion </legend>
            <div class="row">
                    <b class="col-md-3">ID Number :</b>
                    <h6 class="col-md-9"><?php echo $row['id_number']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Name :</b>
                    <h6 class="col-md-9"><?php echo $row['name']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Email :</b>
                    <h6 class="col-md-9"><?php echo $row['email']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Mobile No :</b>
                    <h6 class="col-md-9"><?php echo $row['mobile_no']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Address :</b>
                    <h6 class="col-md-9"><?php echo $row['address']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Designation :</b>
                    <h6 class="col-md-9"><?php echo $row['designation']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Facebook :</b>
                    <h6 class="col-md-9"> <a target="_blank" href="<?php echo $row['facebook']; ?>">Facebook Profile</a> </h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-8">
            <br>
            <legend class="text-uppercase font-size-m font-weight-bold">Login Informantion </legend>
            <div class="row">
                    <b class="col-md-3">User Name :</b>
                    <h6 class="col-md-9"><?php echo $row['user_name']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Password :</b>
                    <h6 class="col-md-9"><?php echo $row['password']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-3">Active Status :</b>
                    <?php
                        if ($row['status'] == 1) { ?>
                            <h6 class="col-md-9"><span class="badge badge-success">Active</span></h6>
                        <?php } else { ?>
                    <h6 class="col-md-9"><span class="badge badge-danger">Inactive</span></h6>
                <?php } ?>
            </div>

        </div>
    </div>
 <!--    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4 pt-3">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div> -->
</fieldset>
<!-- /login form -->
