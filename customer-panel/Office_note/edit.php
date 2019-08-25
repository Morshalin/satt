<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/Office_note', 'Office_note');
if (isset($_GET['Office_note_id'])) {
	$Office_note_id = $_GET['Office_note_id'];
	$query = "SELECT * FROM satt_extra_office_notes WHERE id='$Office_note_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Note Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/Office_note/ajax.php?Office_note_id=<?php echo $Office_note_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Customer Information <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="course_name" class="col-form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook_name" class="col-form-label">Facebook Name<span class="text-danger">*</span></label>
                <input type="text" name="facebook_name" id="facebook_name" class="form-control" value="<?php echo $row['facebook_name']; ?>">

            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="number" class="col-form-label">Mobile Number<span class="text-danger">*</span></label>
                <input type="text" name="number" id="number" value="<?php echo $row['number']; ?>" class="form-control" placeholder="Mobile Number">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email" class="col-form-label">Valid Email Address<span class="text-danger">*</span></label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>" id="email" class="form-control" placeholder="Valid Email Address">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="introduction_date" class="col-form-label">Introduction Date<span class="text-danger">*</span></label>
                <input type="text" name="introduction_date" value="<?php echo $row['introduction_date']; ?>" id="introduction_date" class="form-control date" placeholder="Introduction Date">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="last_contacted_date" class="col-form-label">Last Contacted Date<span class="text-danger">*</span></label>
                <input type="text" name="last_contacted_date" value="<?php echo $row['last_contacted_date']; ?>" id="last_contacted_date" class="form-control date" placeholder="Last Contacted Date">

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <label for="customer_reference" class="col-form-label">Select Customer Reference<span class="text-danger">*</span></label>
              <select class="form-control form-control-lg" id="customer_reference" name="customer_reference">
                <option>Customer Reference</option>
                <?php 
                     $query = "SELECT * FROM satt_customer_type where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($rows = $result->fetch_assoc()) { ?>
                           <option 
                        <?php 
                        if ($row['customer_reference']==$rows['type']) { ?>
                          selected = "selected"
                       <?php } ?>
                         value="<?php echo $rows['type']; ?>" > <?php echo $rows['type']; ?>  </option>  
                     <?php } } ?>
                
              </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
              <label for="progressive_state">Select Progress State</label>
              <select class="form-control" id="progressive_state" name="progressive_state">
                <option>Progress State</option>
                <?php 
                     $query = "SELECT * FROM satt_customer_progres where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($rows = $result->fetch_assoc()) { ?>
                           <option 
                            <?=$row['progressive_state'] ==  $rows['progress_state'] ? ' selected="selected"' : '';?>

                           value="<?php echo $rows['progress_state'] ?>"><?php echo $rows['progress_state']; ?> </option>  
                      <?php  }
                    }
                ?>
              </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <label for="interested_services">Select Interested Service</label>
              <select multiple="multiple" class="form-control select" id="interested_services" name="interested_services[]">
                <?php 
                     $querys = "SELECT * FROM satt_customer_interestedservice where status=1";
                    $results = $db->select($querys);

                    $query_ins= "SELECT * FROM satt_extra_interested_service WHERE cutomer_details_id = '$Office_note_id'";
                   $select1= $db->select($query_ins);
                   $interested_services_id = [];
                   if ($select1) {
                      $j=0;
                      while ($row2 = $select1->fetch_assoc()) {
                       $interested_services_id[$j] = $row2['interested_services_id'];
                       $j++;
                   }
               }

                    if ($results) {
                        while ($rows = $results->fetch_assoc()) { ?>

                           <option value="<?php echo $rows['id'] ?>" <?php if(array_search($rows['id'], $interested_services_id) !== false) {echo 'selected';} ?> ><?php echo $rows['services']; ?></option>  

                      <?php  } }?>
              </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="institute_type" class="col-form-label">Institute Category<span class="text-danger">*</span></label>
                <input type="text" name="institute_type" value="<?php echo $row['institute_type']; ?>" id="institute_type" class="form-control" placeholder="Institute Category">

            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="institute_name" class="col-form-label">Institute Name<span class="text-danger">*</span></label>
                <input type="text" name="institute_name" value="<?php echo $row['institute_name']; ?>" id="institute_name" class="form-control" placeholder="Interested Services">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="institute_address" class="col-form-label">Institute Address</label>
                <textarea name="institute_address" value="<?php echo $row['institute_address']; ?>" id="institute_address" rows="2" class="form-control" style="resize: none;" placeholder="Enter Institute Address"><?php echo $row['institute_address']; ?></textarea>
            </div>
        </div>
    </div>

    <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
                  <label for="institute_district" class="col-form-label">Institute District<span class="text-danger">*</span></label>
                  <input type="text" name="institute_district"  value="<?php echo $row['institute_district']; ?>" id="institute_district" class="form-control" placeholder="Institute District">
              </div>
          </div>
         <div class="col-lg-6">
            <div class="form-group">
              <label for="software_category">Select Software Category</label>


              <select multiple="multiple" class="form-control select" id="software_category" name="software_category[]">
                  <?php 
                    $query_cus = "SELECT * FROM software_details where status=1";
                    $resultcus = $db->select($query_cus);

                   $query_soft= "SELECT * FROM satt_extra__software_category WHERE cutomer_details_id = '$Office_note_id'";
                   $select= $db->select($query_soft);
                   $software_id = [];
                   if ($select) {
                      $k=0;
                      while ($row2 = $select->fetch_assoc()) {
                       $software_id[$k] = $row2['software_id'];
                       $k++;
                   }
               }
               if ($resultcus) {
                  while ($data1 = $resultcus->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $data1['id']; ?>" <?php if(array_search($data1['id'], $software_id) !== false) {echo 'selected';} ?> ><?php echo $data1['software_name']; ?></option>

                    <?php } }?>
                </select>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="note" class="col-form-label">Notes</label>
                <textarea name="note" id="note" rows="2" class="form-control" style="resize: none;" placeholder="Enter Institute Address"><?php echo $row['note']?></textarea>
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
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
