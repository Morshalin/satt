<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/customerdetails/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Customer Information <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Cutomer Name" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook_name" class="col-form-label">Facebook Name<span class="text-danger">*</span></label>
                <input type="text" name="facebook_name" id="facebook_name" class="form-control" placeholder="Facebook Name " required value="">

            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="number" class="col-form-label">Mobile Number<span class="text-danger">*</span></label>
                <input type="text" name="number" id="number" class="form-control" placeholder="Mobile Number" required autofocus value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email" class="col-form-label">Valid Email Address<span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Valid Email Address" required value="">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="introduction_date" class="col-form-label">Introduction Date<span class="text-danger">*</span></label>
                <input type="text" name="introduction_date" id="introduction_date" class="form-control date" placeholder="Select Start Date" required autofocus value="">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
              <label for="customer_reference" class="col-form-label">Select Customer Reference<span class="text-danger">*</span></label>
              <select class="form-control form-control-lg" id="customer_reference" name="customer_reference">
                <option>Customer Reference</option>
                <?php 
                     $query = "SELECT * FROM satt_customer_type where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['type'] ?>"><?php echo $row['type']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Category  Not Found']));
                    }
                ?>
              </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <label for="progressive_state">Select Progress State</label>
              <select class="form-control" id="progressive_state" name="progressive_state">
                <option>Progress State</option>
                <?php 
                     $query = "SELECT * FROM satt_customer_progres where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['progress_state'] ?>"><?php echo $row['progress_state']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Category  Not Found']));
                    }
                ?>
              </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
              <label for="interested_services">Select Interested Service</label>
              <select multiple="multiple" class="form-control select" id="interested_services" name="interested_services[]">
                <?php 
                     $query = "SELECT * FROM satt_customer_interestedservice where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['id'] ?>"><?php echo $row['services']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Category  Not Found']));
                    }
                ?>
              </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="institute_type" class="col-form-label">Institute Category<span class="text-danger">*</span></label>
                <input type="text" name="institute_type" id="institute_type" class="form-control" placeholder="Institute Category" required value="">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="institute_name" class="col-form-label">Institute Name<span class="text-danger">*</span></label>
                <input type="text" name="institute_name" id="institute_name" class="form-control" placeholder="Interested Services" required autofocus value="">
            </div>
        </div>
    </div>


        
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="institute_address" class="col-form-label">Institute Address</label>
                <textarea name="institute_address" id="institute_address" rows="2" class="form-control" style="resize: none;" placeholder="Enter Institute Address"></textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="institute_district" class="col-form-label">Institute District<span class="text-danger">*</span></label>
                <input type="text" name="institute_district" id="institute_district" class="form-control" placeholder="Institute District" required autofocus value="">
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
              <label for="software_category">Select Software Category</label>
              <select multiple="multiple" class="form-control select" id="software_category" name="software_category[]">
                <?php 
                     $query = "SELECT * FROM satt_customer_business_type where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['id'] ?>"><?php echo $row['software_type']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Category  Not Found']));
                    }
                ?>
              </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="last_contacted_date" class="col-form-label">Last Contacted Date<span class="text-danger">*</span></label>
                <input type="date" name="last_contacted_date" id="last_contacted_date" class="form-control" placeholder="Last Contacted Date" required value="">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="status" class="form-check-label">Status</label>
                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc checked>

            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="submit" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
