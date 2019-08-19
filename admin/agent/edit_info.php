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



<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_update_agent_info.php?agent_id=<?php echo $agent_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Agent Information <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


    <section class="fromarea">
        <div class="container py-5 bg-white" style="width: 100%; padding-right: 5%; padding-left: 5%; margin-top: -20px">



            <div class="row">
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <label for="name" class="col-form-label"><span>Upload Image <small class="text-danger">(Max Size: 1 MB)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="photo" id="photo" class="form-control"  required autofocus >
                        <input type="hidden" id="photo_size" name="photo_size">
                    </div>
                </div>
                <div class="col-lg-6"  align="center">
                    <div class="form-group">
                        <img src="images/Letterhead-96.png" alt="No image found" width="150px" height="190px">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Your name " required id="name" autofocus>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="father_name"> Father's name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="father_name" placeholder="Father's name" id="father_name" required="" autofocus>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mother_name" class="col-form-label">Mother's name: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mother_name" placeholder="Mother's name" required id="mother_name" autofocus>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="occupation"> Occupation: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="occupation" placeholder="Occupation" id="occupation" required="" autofocus>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="education_qualification" class="col-form-label"> Eduactional qualification: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="education_qualification" placeholder=" Eduactional qualification" required id="education_qualification" autofocus>
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
                        <input class="form-control" type="text" name="permanent_house" placeholder="If Avialable" id="permanent_house" autofocus>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_road"> Road no: </label>
                        <input class="form-control" type="text" name="permanent_road" placeholder="If Available" id="permanent_road"  autofocus>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_village" class="col-form-label"> Village: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_village" placeholder="Village" id="permanent_village" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_post"> Post: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_post" placeholder="Post" id="permanent_post" required="" autofocus>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_up" class="col-form-label"> Thana: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_up" placeholder="Thana" id="permanent_up" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_dist"> District: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_dist" placeholder="Post" id="permanent_dist" required="" autofocus>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="permanent_post_code" class="col-form-label"> Postal code: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_post_code" placeholder="Postal code" id="permanent_post_code" autofocus required="">
                    </div>
                </div>
                
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Current Address:</h5>
                        <span>
                            <input type="checkbox"  name="same_as" id="same_as"> <span style="font-size: 12px">Same As Permanent</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_house" class="col-form-label"> House no: </label>
                        <input class="form-control" type="text" name="present_house" placeholder="If Avialable" id="present_house" autofocus>
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_road"> Road no: </label>
                        <input class="form-control" type="text" name="present_road" placeholder="If Available" id="present_road"  autofocus>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_village" class="col-form-label"> Village: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="present_village" placeholder="Village" id="present_village" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_post"> Post: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="present_post" placeholder="Post" id="present_post" required="" autofocus>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="present_up" class="col-form-label"> Thana: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="present_up" placeholder="Thana" id="present_up" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="present_dist"> District: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="present_dist" placeholder="Post" id="present_dist" required="" autofocus>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="present_post_code" class="col-form-label"> Postal code: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="present_post_code" placeholder="Postal code" id="present_post_code" autofocus required="">
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
                        <input class="form-control" type="text" name="mobile_no" placeholder="01*********" id="mobile_no" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="alternate_mobile"> Alternate mobile no: </label>
                        <input class="form-control" type="text" name="alternate_mobile" placeholder="01*********  " id="alternate_mobile"  autofocus>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email" class="col-form-label">  E-mail: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="email" placeholder="name@mail.com " id="email" autofocus required="">
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
                        <input class="form-control" type="text" name="interested_dist" placeholder="Working district" id="interested_dist" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="interested_up"> Working thana: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="interested_up" placeholder="Working thana  " id="interested_up"  autofocus required="">
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

            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label for="document_type" class="col-form-label"> Document Type: <span class="text-danger">*</span></label>
                        <select name="document_type" id="document_type" required="" class="form-control"> Select one
                            <option value=""> select one </option>
                            <option value="Passport"> Passport </option>
                            <option value="Birth_Certificate"> Birth certificate</option>
                            <option value="NID"> NID card </option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label for="document_front" class="col-form-label"> Upload Your Nid's Frontend Image: <span><small class="text-danger"><br>(max size 1 Mb)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="document_front" id="document_front" class="form-control"  required autofocus >
                        <input type="hidden" id="document_front_size" name="document_front_size">
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label for="document_back" class="col-form-label"> Upload Your Nid's Backend Image: <span><small class="text-danger"><br>(max size 1 Mb)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="document_back" id="document_back" class="form-control"  required autofocus >
                        <input type="hidden" id="document_back_size" name="document_back_size">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6 mt-3">
                    <div class="form-group">
                        <label for="document_front" class="col-form-label"> Organization name: <span class="text-danger">*</span></label>
                        <input type="text" placeholder="if available" name="bussiness_name" id="bussiness_name" class="form-control"  autofocus >
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label for="tread_license" class="col-form-label"> Trade lisence: <span><small class="text-danger"><br>(max size 1 Mb)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="tread_license" id="tread_license" class="form-control"  required autofocus >
                        <input type="hidden" id="tread_license_size" name="tread_license_size">
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label for="tread_license" class="col-form-label"> E-signatuire: <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Your Full Name" name="signature" id="signature" class="form-control"  autofocus >
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group" align="center">
                        
                        <input type="button"   name="submit" style="width: 40%;" id="submit" class="btn btn-success"  value="Submit" >
                        <input type="button"   name="submiting" style="width: 40%; display: none;" id="submiting" class="btn btn-success"  value="Submitting" disabled="">
                    </div>
                </div>
            </div>




          
        </div>
    </section>





</fieldset>
</form>
<!-- /login form -->
