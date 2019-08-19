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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name" class="col-form-label"><span>Upload Image <small class="text-danger">(Max Size: 1 MB)</small></span> <span class="text-danger">*</span></label>
                        <input type="file" name="photo" id="photo" class="form-control"  required autofocus >
                        <input type="hidden" id="photo_size" name="photo_size">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 40px;">
                    <div class="form-group">
                        <img src="" alt="No image found">
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
                <div class="col-lg-6">
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
                        <label for="permanent_road"> Road no: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_road" placeholder="If Available" id="permanent_road" required="" autofocus>
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="permanent_post_code" class="col-form-label"> Postal code: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_post_code" placeholder="Postal code" id="permanent_post_code" autofocus required="">
                    </div>
                </div>
                <div class="col-lg-6" style=" margin-top: 8px;">
                    <div class="form-group">
                        <label for="permanent_dist"> District: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="permanent_dist" placeholder="Post" id="permanent_dist" required="" autofocus>
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="font-weight-bold">Current Address:</h5>
                        <input type="checkbox" name="same_as" id="same_as"> <span style="font-size: 12px">Same As Permanent</span>
                    </div>
                </div>
            </div>













            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">


                       
                        
                        
                        <div class="mt-5">
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <p> <span class="text-danger"></span></p>
                        </div>
                        <div class="col-sm-9 col-xs-12 mb-5">
                            <div class="row mt-5" id="address_area">
                               
                                <div class="col-lg-6" id="presend">
                                    <p class="font-weight-bold"> Current address <br>
                                        <input type="checkbox" name="same_as" id="same_as"> <span style="font-size: 12px">Same As Permanent</span>
                                    </p>
                                    <div class="mt-1">
                                        <label for="present_house"> House no: </label>
                                        <input contenteditable="py-2 px-1" type="text" class="" placeholder="if available" id="present_house"  name="present_house">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_road"> Road no:  </label>
                                        <input contenteditable="py-2 px-1" type="text" class="" placeholder="Road no" id="present_road" name="present_road">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_village"> Village: <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Village" class="" id="present_village" name="present_village" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_post"> Post:  <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Post" class="" name="present_post" id="present_post" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_up"> Thana: <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Thana" name="present_up" id="present_up" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_dist"> District <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="District " class="" id="present_dist" name="present_dist" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="present_post_code"> Postal code:   <span class="text-danger">*</span> </label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Postal code" class="" id="present_post_code" name="present_post_code" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-2">
                            <label for="mobile_no"> Mobile No: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-2">
                            <input class="from_area" type="text" placeholder="01*********" name="mobile_no" id="mobile_no" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-2">
                            <label for="alternate_mobile"> Alternate mobile no: </label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-2">
                            <input class="from_area" type="text" placeholder="01********* " name="alternate_mobile" id="alternate_mobile">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-2">
                            <label for="email"> E-mail: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-2">
                            <input class="from_area" type="email" placeholder="name@mail.com  " name="email" id="email" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-2">
                            <label for="interested_dist"> Working district: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-2">
                            <input class="from_area" type="text" name="interested_dist" placeholder="Working district" id="interested_dist" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-2">
                            <label for="interested_up"> Working thana: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-2">
                            <input class="from_area" type="text" name="interested_up" placeholder="Working thana" id="interested_up" required="">
                        </div>
                        <div class="col-lg-3 col-md-3"></div>
                        <div class="col-lg-6 col-md-6">
                            <div class="custom-control custom-checkbox mt-5">
                                <input type="checkbox" class="custom-control-input" id="terms_agree" name="terms_agree" required="" data-parsley-errors-container="#terms_agree_error">
                                <label class="custom-control-label ml-4 mt-2" for="terms_agree">I promise all the information given above is correct </label>
                                <span id="terms_agree_error"></span>
                            </div>
                            <div class="col-lg-3 col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-3 bg-white" style="width: 100%; padding-right: 10%; padding-left: 10%">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <p class="document">Upload document:</p>
            </div>
            <div class="col-lg-9 col-md-9">
                <select class="" name="document_type" id="select_another" required=""> Select one
                    <option value=""> select one </option>
                    <option value="Passport"> Passport </option>
                    <option value="Birth_Certificate"> Birth certificate</option>
                    <option value="NID"> NID card </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="" id="front_end" style="display: none">
                <br>
                <input class="form-control-file" type="file" name="document_front" id="document_front" required="">
                <span class="text-muted" id="document_front_end_help">Upload Your Nid's Frontend Image</span><span><small class="text-danger"><br>(max size 1 Mb)</small></span>
                <input type="hidden" id="document_front_size" name="document_front_size">
            </div>
            <div  id="backend" style="display: none;">
                <div class="col-9 px-0">
                    <br>
                    <input type="file" class="form-control-file"  name="document_back" id="document_back">
                    <span class="text-muted" id="document_back_end_help">Upload Your Nid's Backend Image</span><span><small class="text-danger"><br>(max size 1 Mb)</small></span>
                    <input type="hidden" id="document_back_size" name="document_back_size">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <p class="prothisthan_name mt-2">Organization name </p>
            </div>
            <div class="col-lg-3">
                <input type="text" class="protgisthan" placeholder="if available" name="bussiness_name">
            </div>
            <div class="col-lg-2">
                <p class="treand"> Trade lisence</p>
            </div>
            <div class="col-lg-4" style="margin-top: 10px">
                <input type="file" class="form-control-file" id="tread_license" name="tread_license">
                <input type="hidden" id="tread_license_size" name="tread_license_size">
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <input type="text" class="name protgisthan py-2" placeholder="E-signatuire (your full name):" name="signature" id="signature" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-8 mx-auto mt-2 mt-3 mb-5">
                <button class="btn bg-success text-white" style="width: 100%;" type="submit" id="submit" disabled=""> Submit</button>
                <button class="btn bg-info text-white" style="width: 100%; display: none; " id="submiting" disabled="" > Submitting</button>
            </div>
        </div>
    </div>




</fieldset>
</form>
<!-- /login form -->
