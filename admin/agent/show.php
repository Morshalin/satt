<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'View Agent Info');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	$query = "SELECT * FROM agent_list WHERE id='$agent_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'agent Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
  <fieldset class="mb-3">
    <div class="row">
                <div class="col-md-12">
                    <h3>Status</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td class="text-center">
                                <?php echo $row['status'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
                        <div class="row">
                <div class="col-md-6">
                    <h3>Photo</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td class="text-center">
                               <a href="<?php echo '../../agent/'.$row['photo'] ?>" target="_blank"> <img src="<?php echo '../../agent/'.$row['photo'] ?>" alt="" height="300px" width="300px"></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Agent Data</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>
                                <strong>Name:</strong> <?php echo $row['name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Father Name:</strong> <?php echo $row['father_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Mother Name:</strong> <?php echo $row['mother_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Occupation:</strong> <?php echo $row['occupation'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Eduactional qualification:</strong> <?php echo $row['education_qualification'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Interested District:</strong> <?php echo $row['interested_dist'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Interested Upazila:</strong> <?php echo $row['interested_up'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Permanent Address</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Road: </td>
                            <?php 
                                if ($row['permanent_road']) {
                                    ?>
                                        <td><?php echo $row['permanent_road'] ?></td>
                                    <?php
                                }else{
                                    ?>
                                        <td>N/A</td>
                                    <?php
                                }
                             ?>
                            
                        </tr>
                        <tr>
                            <td>House: </td>
                            <?php 
                                if ($row['permanent_house']) {
                                    ?>
                                        <td><?php echo $row['permanent_house'] ?></td>
                                    <?php
                                }else{
                                    ?>
                                        <td>N/A</td>
                                    <?php
                                }
                             ?>
                        </tr>
                        <tr>
                            <td>Village: </td>
                            <td><?php echo $row['permanent_village'] ?></td>
                        </tr>
                        <tr>
                            <td>Post: </td>
                            <td><?php echo $row['permanent_post'] ?></td>
                        </tr>
                        <tr>
                            <td>Upazila: </td>
                            <td><?php echo $row['permanent_up'] ?></td>
                        </tr>
                        <tr>
                            <td>District: </td>
                            <td><?php echo $row['permanent_dist'] ?></td>
                        </tr>
                        <tr>
                            <td>Post Code: </td>
                            <td><?php echo $row['permanent_post_code'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Present Address 
                        <?php 
                        if ($row['same_as'] == '1') {
                           ?>
                           <small>Same As Present</small>
                           <?php
                        } ?>
                        
                    </h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Road: </td>
                            <?php 
                                if ($row['present_road']) {
                                    ?>
                                        <td><?php echo $row['present_road'] ?></td>
                                    <?php
                                }else{
                                    ?>
                                        <td>N/A</td>
                                    <?php
                                }
                             ?>
                            
                        </tr>
                        <tr>
                            <td>House: </td>
                            <?php 
                                if ($row['present_house']) {
                                    ?>
                                        <td><?php echo $row['present_house'] ?></td>
                                    <?php
                                }else{
                                    ?>
                                        <td>N/A</td>
                                    <?php
                                }
                             ?>
                        </tr>
                        <tr>
                            <td>Village: </td>
                            <td><?php echo $row['present_village'] ?></td>
                        </tr>
                        <tr>
                            <td>Post: </td>
                            <td><?php echo $row['present_post'] ?></td>
                        </tr>
                        <tr>
                            <td>Upazila: </td>
                            <td><?php echo $row['present_up'] ?></td>
                        </tr>
                        <tr>
                            <td>District: </td>
                            <td><?php  echo $row['present_dist'] ?></td>
                        </tr>
                        <tr>
                            <td>Post Code: </td>
                            <td><?php echo $row['present_post_code'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Contact Info</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Mobile: </td>
                            <td><?php echo $row['mobile_no'] ?></td>
                        </tr>
                        <tr>
                            <td>Alternate Mobile: </td>
                            <?php 
                                if ($row['alternate_mobile']) {
                                    ?>
                                    <td><?php echo $row['alternate_mobile'] ?></td>
                                    <?php
                                }else{
                                    ?>
                                     <td>N/A</td>
                                    <?php
                                }
                             ?>
                            
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Signature: </td>
                            <td><?php echo $row['signature'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>
                    <?php 
                    if ($row['document_type'] == "Birth_Certificate") {
                        $sohag = explode('_', $row['document_type']);
                        echo implode(' ', $sohag);
                    }else{
                        echo $row['document_type'];
                    } 
                    ?>
                    </h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td><?php 

                                if ($row['document_type'] == "NID") {
                                   echo('NID Front Page:');
                                }else{
                                    echo("Document:");
                                }

                             ?></td>
                            <td> <a href="<?php echo('../../agent/'.$row['document_front']) ?>" target="_blank"><img src="<?php echo('../../agent/'.$row['document_front']) ?>" alt="" width="300px"></a></td>
                        </tr>
                         <tr>
                            <td><?php 

                                if ($row['document_type'] == "NID") {
                                   echo('NID Back Page:');
                                   ?>
                                   </td>
                            <td> 
                                <a href="<?php echo('../../agent/'.$row['document_back']) ?>" target="_blank"><img src="<?php echo('../../agent/'.$row['document_back']) ?>" alt="" width="300px"></a>
                            </td>


                                   <?php
                                }

                             ?>
                        </tr>
                                            </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Bussiness</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td >Organization Name : <?php echo($row['bussiness_name']) ?></td>
                            <td> <a href="<?php echo('../../agent/'.$row['tread_license']) ?>" target="_blank"><img src="<?php echo('../../agent/'.$row['tread_license']) ?>" alt="" width="300px"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
</fieldset>
<!-- /login form -->
