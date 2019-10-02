<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/office_stuff/ajax.php?" id="content_form" method="post" enctype="multipart/form-data">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">ADD NEW OFFICE STUFF <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
    <legend class="text-uppercase font-size-sm font-weight-bold text-center text-danger" style="border-bottom: none">Basic Information</legend>
    <div class="row">

        <div class="col-lg-6">
            <div class="form-group">
                <label for="stuff_id" class="col-form-label">Stuff Id <span class="text-danger">*</span></label>
                <input type="text" name="stuff_id" id="stuff_id" class="form-control" placeholder="Type  ID" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type  name" required autofocus value="">
            </div>
        </div>
        
        
    </div>
    <!-- <legend class="text-uppercase font-size-sm font-weight-bold">ADD NEW OFFICE STUFF <span class="text-danger">*</span> <small>  Fields Are Required </small></legend> -->
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="designation" class="col-form-label">Designation <span class="text-danger">*</span></label>
                <input type="text" name="designation" id="designation" class="form-control" placeholder="Type Designation" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="joining_date" class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                <input type="text" name="joining_date" id="joining_date" class="form-control date" placeholder="Type Joining Date" required autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        
    <div class="col-lg-6">
            <div class="form-group">
                <label for="skill" class="col-form-label">Skill  <span class="text-danger">*</span></label>
                <input type="text" name="skill" id="skill" class="form-control tokenfield" placeholder="Type Skill" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="projects" class="col-form-label">Projects  <span class="text-danger">*</span></label>
                <input type="text" name="projects" id="projects" class="form-control tokenfield" placeholder="Type Projects" required autofocus value="">
            </div>
        </div>
    </div>
    <!-- <legend class="text-uppercase font-size-sm font-weight-bold">ADD NEW OFFICE STUFF <span class="text-danger">*</span> <small>  Fields Are Required </small></legend> -->
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="designation" class="col-form-label">Blood Group <span class="text-danger">*</span></label>
                <select name="blood_group" id="blood_group" class="form-control" required>
                    <option value="">Please Select One</option>
                    <option value="A+(ve)">A+(ve)</option>
                    <option value="A-(ve)">A-(ve)</option>
                    <option value="AB+(ve)">AB+(ve)</option>
                    <option value="AB-(ve)">AB-(ve)</option>
                    <option value="O-(ve)">O-(ve)</option>
                    <option value="O+(ve)">O+(ve)</option>
                </select>
            </div>
        </div>
            
    <div class="col-lg-6">
            <div class="form-group">
                <label for="bio" class="col-form-label">Bio </label>
                <textarea name="bio" id="bio" class="form-control" placeholder="Type  bio" autofocus ></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="image" class="col-form-label">Image </label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>
        </div>
    </div>


    <legend class="text-uppercase font-size-sm font-weight-bold text-center mt-3 text-danger" style="border-bottom: none">Contact Information</legend>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="present_address" class="col-form-label">Present Address  <span class="text-danger">*</span></label>
                <textarea name="present_address" id="present_address" class="form-control" required></textarea>
            </div>
        </div>
        <div class="col-lg-4 mt-4 pl-5" >
        <label for="permanent_address" class="col-form-label">Same As Present </label>
               <input type="checkbox" id="same" name="same">
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="permanent_address" class="col-form-label">Permanent Address </label>
                <textarea name="permanent_address" id="permanent_address" class="form-control"></textarea>
            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="mobile_no_personal" class="col-form-label">Mobile No (Personal) <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no_personal" id="mobile_no_personal" class="form-control" placeholder="Type  Mobile No" required autofocus value="" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="mobile_no_alternative" class="col-form-label">Alternative Mobile No (Home) <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no_alternative" id="mobile_no_alternative" class="form-control" placeholder="Type  Mobile No" required autofocus value="" required>
            </div>
        </div>
    </div>

  
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook" class="col-form-label">Facebook Link </label>
                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Type  Facebook Link" autofocus value="" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="twitter" class="col-form-label">Twitter link </label>
                <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Type  Twitter link" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="instagram" class="col-form-label">Instagram Link </label>
                <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Type  Instagram Link" autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="linkedin" class="col-form-label">Linkedin link</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Type  Linkedin link" autofocus value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email" class="col-form-label">Email </label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Type  Email Address" autofocus value="">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
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
