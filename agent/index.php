<?php 
include_once('../config/config.php');
include_once('../classes/Database.php');
$db = new Database();

?>
<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Apply Online - Satt IT Agent Managment</title>

        <meta name="description" content="">
        <meta name="author" content="Satt IT">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="eH5l3sXFjaNy3gRWnxsyRV2DS08xpw64uFLFK18K">

        <!-- Icons -->
        <link rel="shortcut icon" href="media/photos/favicon.png">
        <link rel="icon" sizes="192x192" type="image/png" href="media/photos/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="media/photos/apple-touch-icon-180x180.png">

        <!-- Fonts and Styles -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="css/codebase.css">

        <!-- <link rel="stylesheet" id="css-theme" href="/css/themes/corporate.css"> -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Scripts -->
        <script>window.Laravel = {"csrfToken":"eH5l3sXFjaNy3gRWnxsyRV2DS08xpw64uFLFK18K"};</script>
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <form class="mt-4" id="agent_form" action="" method="POST" enctype="multipart/form-data">
    <section class="fromarea">
        <div class="container py-5 bg-white" style="width: 100%; padding-right: 5%; padding-left: 5%; margin-top: -20px">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <img class="" src="https://agent.sattit.com/media/photos/logo.png" alt="satt itlogo" style="width: 180px; height: 50px;">
                    <address class="mt-2">
                        <span>524, Manik Mia Road </span> <br>
                        <span> Talaimari, Rajshahi-6204</span> <br>
                        <span> +8801850054500</span> <br>
                        <span>info@sattit.com</span><br>
                        <span>www.sattit.com</span>
                    </address>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="" style="background: #52c234;  /* fallback for old browsers */
                        background: -webkit-linear-gradient(to right, #061700, #52c234);  /* Chrome 10-25, Safari 5.1-6 */
                        background: linear-gradient(to right, #061700, #52c234); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                        ">
                        <p class="text-center h4 text-white py-2"> Agent Application Form </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="upload-btn-wrapper">
                        <img class="pic" src="media/photos/upload.png" alt="" id="photo_preview"><br>
                        <span>Upload Image <small class="text-danger"><br>(Max Size: 1 MB)</small></span>
                        <input type="file" name="photo" id="photo" required="" />
                        <input type="hidden" id="photo_size" name="photo_size">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 mt-3">
                            <label for="name"> Name: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-3">
                            <input class="from_area" type="text" name="name" placeholder="Your name " required id="name">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-3">
                            <label for="father_name"> Father's name: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-3">
                            <input class="from_area" type="text" name="father_name" placeholder="Father's name" id="father_name" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-3">
                            <label for="mother_name"> Mother's name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-3">
                            <input class="from_area" type="text" name="mother_name" placeholder="Mother's name" id="mother_name" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-3">
                            <label for="occupation"> Occupation: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-3">
                            <input class="from_area" type="text" name="occupation" placeholder="Occupation " id="occupation" required="">
                        </div>
                        <div class="col-sm-3 col-xs-12 mt-3">
                            <label for="education_qualification"> Eduactional qualification: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-9 col-xs-12 mt-3">
                            <input class="from_area" type="text" name="education_qualification" placeholder="Education qualification  " id="education_qualification" required="">
                        </div>
                        <div class="mt-5">
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <p> <span class="text-danger"></span></p>
                        </div>
                        <div class="col-sm-9 col-xs-12 mb-5">
                            <div class="row mt-5" id="address_area">
                                <div class="col-lg-6">
                                    <p class="font-weight-bold"> Permanent address: </p> <br>
                                    <div class="mt-1">
                                        <label for="permanent_house"> House no: </label>
                                        <input contenteditable="py-2 px-1" type="text" class="" placeholder="if available" id="permanent_house" name="permanent_house">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_road"> Road no:  </label>
                                        <input contenteditable="py-2 px-1" type="text" class="" placeholder="Road no" id="permanent_road" name="permanent_road">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_village"> Village: <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Village" class="" id="permanent_village" name="permanent_village" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_post"> Post:  <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="post" class="" id="permanent_post" name="permanent_post" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_up"> Thana: <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Thana" class="" name="permanent_up" id="permanent_up" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_dist"> District: <span class="text-danger">*</span></label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="District" class="" id="permanent_dist" name="permanent_dist" required="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="permanent_post_code"> Postal code:  <span class="text-danger">*</span> </label>
                                        <input contenteditable="py-2 px-1" type="text" placeholder="Postal code " class="" id="permanent_post_code" name="permanent_post_code" required="">
                                    </div>
                                </div>
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
</form>
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="js/codebase.app.js"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="js/laravel.app.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
        <script src="js/parsley.js"></script>
<script src="js/main.js"></script>


<script>

 $(document).ready(function() {       
    $('#photo').bind('change', function() {
        var a=(this.files[0].size);
        // alert(a)
        $("#photo_size").val(a);
        if ( a > 1048576) {
             $('#photo').val("");
             $('#photo_preview').attr("src","media/photos/upload.png");

            Swal.fire({
                        title: "error",
                        text: "Please Make Sure The Image Size Is Less Than 1 MB" ,
                        type: "error"
                    });
        }
        
    });      
    $('#document_front').bind('change', function() {
        var a=(this.files[0].size);
        $("#document_front_size").val(a);
        if ( a > 1048576) {
             $('#document_front').val("");
            Swal.fire({
                        title: "error",
                        text: "Please Make Sure The Image Size Is Less Than 1 MB" ,
                        type: "error"
                    });
        }
        
    });      
    $('#document_back').bind('change', function() {
        var a=(this.files[0].size);
        $("#document_back_size").val(a);
        if ( a > 1048576) {
             $('#document_back').val("");
            Swal.fire({
                        title: "error",
                        text: "Please Make Sure The Backend Image Size Of NID Is Less Than 1 MB" ,
                        type: "error"
                    });
        }
        
    });    
    $('#tread_license').bind('change', function() {
        var a=(this.files[0].size);
        $("#tread_license_size").val(a);
        if ( a > 1048576) {
             $('#tread_license').val("");
            Swal.fire({
                        title: "error",
                        text: "Please Make Sure The Image Size Of Trade License Is Less Than 1 MB" ,
                        type: "error"
                    });
        }
        
    });
});
</script>


    </body>
</html>
