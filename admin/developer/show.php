<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/developer', 'View Developer Profile');
if (isset($_GET['developer_id'])) {
	$developer_id = $_GET['developer_id'];
	$query = "SELECT * FROM developer WHERE id='$developer_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Developer Not Found']));
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
                    <b class="col-md-3">Developer Name :</b>
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
                    <b class="col-md-3">Bio :</b>
                    <h6 class="col-md-9"><?php echo $row['bio']; ?></h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-8">
            <br>
            <legend class="text-uppercase font-size-m font-weight-bold">Contact Informantion </legend>
            <div class="row">
                    <b class="col-md-3">Facebook :</b>
                    <a target='_blank' href="<?php echo $row['facebook']; ?>" ><h6 class="col-md-9"><?php echo $row['facebook']; ?></h6></a>
            </div>
            <div class="row">
                    <b class="col-md-3">Twitter :</b>
                    <a target='_blank' href="<?php echo $row['twitter']; ?>" ><h6 class="col-md-9"><?php echo $row['twitter']; ?></h6></a>
            </div>
            <div class="row">
                    <b class="col-md-3">Instagram :</b>
                    <a target='_blank' href="<?php echo $row['instagram']; ?>" ><h6 class="col-md-9"><?php echo $row['instagram']; ?></h6></a>
            </div>
            <div class="row">
                    <b class="col-md-3">Linkedin :</b>
                    <a target='_blank' href="<?php echo $row['linkedin']; ?>" ><h6 class="col-md-9"><?php echo $row['linkedin']; ?></h6></a>
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
