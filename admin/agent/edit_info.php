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
        $read_only = '';
        
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



<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_update_agent_info.php?agent_id=<?php echo $agent_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Agent Information <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


    <section class="fromarea">
        <div class="container py-5 bg-white" style="width: 100%; padding-right: 5%; padding-left: 5%; margin-top: -20px">



            <div class="row">
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <label for="name" class="col-form-label"><span>Upload Image <small class="text-danger">(Max Size: 1 MB)</small></span> </label>
                        <input type="file" name="photo" id="photo" class="form-control"  autofocus onchange="readURL(this,'#show_image','#photo')">
                        <input type="hidden" id="photo_size" name="photo_size">
                    </div>
                </div>
                <div class="col-lg-6"  align="center">
                    <div class="form-group">
                        <img id="show_image" src="<?php echo BASE_URL.'/agent/'.$row['photo'] ?>" alt="No image found" width="160px" height="190px">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Your name " required id="name" autofocus value="<?php echo $row['name'] ?>">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="father_name"> Father's name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="father_name" placeholder="Father's name" id="father_name" required="" autofocus value="<?php echo $row['father_name'] ?>">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mother_name" class="col-form-label">Mother's name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mother_name" placeholder="Mother's name" required id="mother_name" autofocus value="<?php echo $row['mother_name'] ?>">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="occupation"> Occupation: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="occupation" placeholder="Occupation" id="occupation" required="" autofocus  value="<?php echo $row['occupation'] ?>">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="education_qualification" class="col-form-label"> Eduactional qualification: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="education_qualification" placeholder=" Eduactional qualification" required id="education_qualification" autofocus value="<?php echo $row['education_qualification'] ?>">
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Permanent Address:</h5>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_house" class="col-form-label"> House no: </label>
                        <input class="form-control" type="text" name="permanent_house" placeholder="If Avialable" id="permanent_house" autofocus value="<?php echo $row['permanent_house'] ?>" onkeyup="makeSamePresent('permanent_house','present_house')">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_road"> Road no: </label>
                        <input class="form-control" type="text" name="permanent_road" placeholder="If Available" id="permanent_road"  autofocus  value="<?php echo $row['permanent_road'] ?>" onkeyup="makeSamePresent('permanent_road','present_road')">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_village" class="col-form-label"> Village: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_village" placeholder="Village" id="permanent_village" autofocus required="" value="<?php echo $row['permanent_village'] ?>" onkeyup="makeSamePresent('permanent_village','present_village')">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_post"> Post: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_post" placeholder="Post" id="permanent_post" required="" autofocus value="<?php echo $row['permanent_post'] ?>" onkeyup="makeSamePresent('permanent_post','present_post')">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_up" class="col-form-label"> Thana: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_up" placeholder="Thana" id="permanent_up" autofocus required="" value="<?php echo $row['permanent_up'] ?>" onkeyup="makeSamePresent('permanent_up','present_up')">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_dist"> District: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_dist" placeholder="Post" id="permanent_dist" required="" autofocus value="<?php echo $row['permanent_dist'] ?>" onkeyup="makeSamePresent('permanent_dist','present_dist')">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="permanent_post_code" class="col-form-label"> Postal code: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_post_code" placeholder="Postal code" id="permanent_post_code" autofocus required="" value="<?php echo $row['permanent_post_code'] ?>" onkeyup="makeSamePresent('permanent_post_code','present_post_code')">
                    </div>
                </div>
                
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Present Address:</h5>
                        <span>
                            <input type="checkbox" <?php if ($row['same_as'] == '1') {
                               echo "checked";
                               $read_only = "readonly";
                            } ?>  name="same_as" id="same_as"> <span style="font-size: 12px">Same As Permanent</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_house" class="col-form-label"> House no: </label>
                        <input class="form-control present_address" type="text" name="present_house" placeholder="If Avialable" id="present_house" autofocus value="<?php echo $row['present_house'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_road"> Road no: </label>
                        <input class="form-control present_address" type="text" name="present_road" placeholder="If Available" id="present_road"  autofocus value="<?php echo $row['present_road'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_village" class="col-form-label"> Village: <span class="text-danger">*</span></label>
                        <input class="form-control present_address" type="text" name="present_village" placeholder="Village" id="present_village" autofocus required="" value="<?php echo $row['present_village'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_post"> Post: <span class="text-danger">*</span></label>
                        <input class="form-control present_address" type="text" name="present_post" placeholder="Post" id="present_post" required="" autofocus value="<?php echo $row['present_post'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_up" class="col-form-label"> Thana: <span class="text-danger">*</span></label>
                        <input class="form-control present_address" type="text" name="present_up" placeholder="Thana" id="present_up" autofocus required="" value="<?php echo $row['present_up'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_dist"> District: <span class="text-danger">*</span></label>
                        <input class="form-control present_address" type="text" name="present_dist" placeholder="Post" id="present_dist" required="" autofocus value="<?php echo $row['present_dist'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="present_post_code" class="col-form-label"> Postal code: <span class="text-danger">*</span></label>
                        <input class="form-control present_address" type="text" name="present_post_code" placeholder="Postal code" id="present_post_code" autofocus required="" value="<?php echo $row['present_post_code'] ?>" <?php echo $read_only ?>>
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Contact Information:</h5>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mobile_no" class="col-form-label"> Mobile No: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mobile_no" placeholder="01*********" id="mobile_no" autofocus required="" value="<?php echo $row['mobile_no'] ?>">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="alternate_mobile"> Alternate mobile no: </label>
                        <input class="form-control" type="text" name="alternate_mobile" placeholder="01*********  " id="alternate_mobile"  autofocus  value="<?php echo $row['alternate_mobile'] ?>">
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email" class="col-form-label">  E-mail: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="email" placeholder="name@mail.com " id="email" autofocus required="" value="<?php echo $row['email'] ?>">
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Interested Working Area:</h5>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="interested_dist" class="col-form-label"> Working district: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="interested_dist" placeholder="Working district" id="interested_dist" autofocus required="" value="<?php echo $row['interested_dist'] ?>">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="interested_up"> Working thana: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="interested_up" placeholder="Working thana  " id="interested_up"  autofocus required="" value="<?php echo $row['interested_up'] ?>">
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Important Documents:</h5>
                    </div>
                </div>
            </div>

            <div class="row" >
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label for="document_type" class="col-form-label"> Document Type: <span class="text-danger">*</span></label>
                        <select name="document_type" id="document_type" required="" class="form-control">
                            <option value=""> select one </option>
                            <option value="Passport" <?php if ($row['document_type'] == 'Passport') {
                                echo 'selected';
                            } ?>> Passport </option>
                            <option value="Birth_Certificate" <?php if ($row['document_type'] == 'Birth_Certificate') {
                                echo 'selected';
                            } ?>> Birth certificate</option>
                            <option value="NID" <?php if ($row['document_type'] == 'NID') {
                                echo 'selected';
                            } ?>> NID card </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row" id="frontend_img_div">
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <label for="document_front" class="col-form-label"><span id="up_front_text">Upload Image Of <?php echo $row['document_type'] ?> </span> <small class="text-danger">(Max Size: 1 MB) </small></label>
                        <input type="file" name="document_front" id="document_front" class="form-control"   autofocus  onchange="readURL(this,'#show_dock_front_img','#document_front')">
                    </div>
                </div>
                <div class="col-lg-6"  align="center">
                    <div class="form-group">
                        <img id="show_dock_front_img" src="<?php echo BASE_URL.'/agent/'.$row['document_front'] ?>" alt="No image found" width="160px" height="190px">
                    </div>
                </div>
            </div>

            
            <div class="row" id="backend_img_div" style="display: <?php if ($row['document_type']!='NID') {
                echo 'none';
            } ?>">
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <label for="document_back" class="col-form-label"><span>Upload Your Nid's Backend Image:  <small class="text-danger">(Max Size: 1 MB)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="document_back" id="document_back" class="form-control" autofocus onchange="readURL(this,'#show_dock_back_img','#document_back')">
                        <input type="hidden" id="document_back_size" name="document_back_size">
                    </div>
                </div>
                <div class="col-lg-6"  align="center">
                    <div class="form-group">
                        <img id="show_dock_back_img" src="<?php echo BASE_URL.'/agent/'.$row['document_back'] ?>" alt="No image found" width="160px" height="190px">
                    </div>
                </div>
            </div>


     


            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <label for="document_front" class="col-form-label"> Organization name: </label>
                        <input type="text" placeholder="if available" name="bussiness_name" id="bussiness_name" class="form-control"  autofocus value="<?php echo $row['bussiness_name'] ?>">
                    </div>
                </div>
            </div>


            <div class="row" id="frontend_img_div">
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <label for="tread_license" class="col-form-label"> Trade lisence: <span><small class="text-danger">(max size 1 Mb)</small></label>
                        <input type="file" name="tread_license" id="tread_license" class="form-control"   autofocus  onchange="readURL(this,'#show_dock_trade_license_img','#tread_license')">
                    </div>
                </div>
                <div class="col-lg-6"  align="center">
                    <div class="form-group">
                        <img id="show_dock_trade_license_img" src="<?php echo BASE_URL.'/agent/'.$row['tread_license'] ?>" alt="Image not vailable" width="160px" height="190px">
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label for="tread_license" class="col-form-label"> E-signatuire: <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Your Full Name" name="signature" id="signature" class="form-control"  autofocus value="<?php echo $row['signature'] ?>">
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group" align="center">
                        
                        <input type="submit"   name="submit" style="width: 40%;" id="submit" class="btn btn-success"  value="Submit" >
                        <input type="button"   name="submiting" style="width: 40%; display: none;" id="submiting" class="btn btn-success"  value="Submitting" disabled="">
                    </div>
                </div>
            </div>




          
        </div>
    </section>





</fieldset>
</form>
<!-- /login form -->
