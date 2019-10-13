<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/office_stuff', 'View Office Stuff Profile');
if (isset($_GET['office_stuff_id'])) {
	$office_stuff_id = $_GET['office_stuff_id'];
	$query = "SELECT * FROM office_stuff WHERE id='$office_stuff_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Office Stuff Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAuthorized']));
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
    <legend class="text-uppercase font-size-m font-weight-bold">Personal Information </legend>
            <div class="row">
                    <b class="col-md-4">Stuff ID :</b>
                    <h6 class="col-md-8"><?php echo $row['stuff_id']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Name :</b>
                    <h6 class="col-md-8"><?php echo $row['name']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Email :</b>
                    <h6 class="col-md-8"><?php echo $row['email']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Mobile No(Personal) :</b>
                    <h6 class="col-md-8"><?php echo $row['mobile_no_personal']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Mobile No(Home) :</b>
                    <h6 class="col-md-8"><?php echo $row['mobile_no_alternative']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Present Address :</b>
                    <h6 class="col-md-8"><?php echo $row['present_address']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Permanent Address :</b>
                    <h6 class="col-md-8"><?php echo $row['permanent_address']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Bio :</b>
                    <h6 class="col-md-8"><?php echo $row['bio']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Blood Group :</b>
                    <h6 class="col-md-8"><?php echo $row['blood_group']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Designation :</b>
                    <h6 class="col-md-8"><?php echo $row['designation']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Skill :</b>
                    <h6 class="col-md-8"><?php echo $row['skill']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Projects :</b>
                    <h6 class="col-md-8"><?php echo $row['projects']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Joining Date :</b>
                    <h6 class="col-md-8"><?php echo $row['joining_date']; ?></h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-8">
            <br>
            <legend class="text-uppercase font-size-m font-weight-bold">Contact Information </legend>
            <div class="row">
                    <b class="col-md-4">Facebook :</b>
                    <h6 class="col-md-8"> 
                    <?php 
                        if ($row['facebook']) {
                                ?>
                                <a href="<?php echo $row['facebook']; ?>" target="_blank" rel="noopener noreferrer">Click To Visite Facebook Profile</a>
                                <?php
                        }else{
                                echo "Link Not Assigned";
                        }
                        ?>
                            
                    </h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Twitter :</b>
                    <h6 class="col-md-8">
                    <?php 
                        if ($row['twitter']) {
                                ?>
                                <a href="<?php echo $row['twitter']; ?>" target="_blank" rel="noopener noreferrer">Click To Visite Twitter Profile</a>
                                <?php
                        }else{
                                echo "Link Not Assigned";
                        }
                        ?>
                        </h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Instagram :</b>
                    <h6 class="col-md-8">
                    <?php 
                        if ($row['instagram']) {
                                ?>
                                <a href="<?php echo $row['instagram']; ?>" target="_blank" rel="noopener noreferrer">Click To Visite Instagram Profile</a>
                                <?php
                        }else{
                                echo "Link Not Assigned";
                        }
                        ?>
                    </h6>
            </div>
            <div class="row">
                    <b class="col-md-4">LinkedIn :</b>
                    <h6 class="col-md-8">
                     <?php 
                        if ($row['linked_in']) {
                                ?>
                                <a href="<?php echo $row['linked_in']; ?>" target="_blank" rel="noopener noreferrer">Click To Visite LinkedIn Profile</a>
                                <?php
                        }else{
                                echo "Link Not Assigned";
                        }
                     ?>
                    </h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Active Status :</b>
                    <h6 class="col-md-8"><?php  echo $row['status']=='1'?'Active':"Inactive" ;?></h6>
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
