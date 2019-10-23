<?php
require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL.'/customerdetails', 'customerdetails');
ajax();
$user_id = $user['id'];
$user_name = $user['user_name'];
$form_table = Session::get('table_name');
?>



<form action="">
        <legend class="text-uppercase font-size-sm font-weight-bold">Customer Information <span class="text-danger">*</span> <small>  Fields Are Required </small></legend> 
    
      <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name" class="col-form-label">Select Customer Category <span class="text-danger">*</span></label>
                <select class="form-control form-control-lg" id="customer_category" name="customer_category">
                    <option value="">Please Select One</option>
                    <option value="new_ustomer">New Customers</option>
                    <option value="contacted_customers">Contacted Customers</option>
            </select>
        </div>
    </div>
</div>

<div class="row" style="display: none;" id="cust_select_div">
        
    <div class="col-lg-12">
        <div class="form-group">
            <label for="facebook_name" class="col-form-label">Select Customer<span class="text-danger">*</span></label>
            <select class="form-control form-control-lg select" id="select_customer" name="select_customer">
                    <option value="">Please Select One</option>
                    <?php 
                        $query = "SELECT * FROM satt_extra_office_notes";
                        $get_customer = $db->select($query);
                        if ($get_customer) {
                            while ($row = $get_customer->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'].', '.$row['number'] ?></option>
                                <?php
                            }
                        }

                     ?>
                    
            </select>

        </div>
    </div>
</div>
</form>




<!-- Submit form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/customerdetails/ajax.php" id="content_form" method="post">
<fieldset class="mb-3">
    <?php 
        $query = "SELECT * FROM satt_extra_office_notes";
        $get_customer = $db->select($query);
        if ($get_customer) {
            while ($row = $get_customer->fetch_assoc()) {
                ?>
                <input type="hidden" value="<?php echo $row['id'] ?>" name="contaced_cus_id">
                <?php
            }
        }

     ?>

<div  style="display: none" id="customer_form">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name" class="col-form-label">Customer Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Cutomer Name" required autofocus value="">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="facebook_name" class="col-form-label">Facebook Link<span class="text-danger"></span></label>
            <input type="text" name="facebook_name" id="facebook_name" class="form-control" placeholder="Facebook Name ">

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
            <label for="email" class="col-form-label">Valid Email Address<span class="text-danger"></span></label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Valid Email Address">

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
            <label for="last_contacted_date" class="col-form-label">Last Contacted Date<span class="text-danger">*</span></label>
            <input type="text" name="last_contacted_date" id="last_contacted_date" class="form-control date" placeholder="Last Contacted Date" required value="">

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_reference" class="col-form-label">Select Customer Type<span class="text-danger"></span></label>
          <select class="form-control form-control-lg select" id="customer_reference" name="customer_reference">
            <option value="">Select One</option>
            <?php 
            $query = "SELECT * FROM satt_customer_type where status=1";
            $result = $db->select($query);
            if ($result) {
                while ($rows = $result->fetch_assoc()) { ?>
                <option 
                            <?=$row['customer_reference'] ==  $rows['type'] ? ' selected="selected"' : '';?>

                           value="<?php echo $rows['type'] ?>"><?php echo $rows['type']; ?> </option>
                <?php  }
            }
            ?>
        </select>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
      <label for="progressive_state">Select Progress State</label>
      <select class="form-control select" id="progressive_state" name="progressive_state">
        <option value="">Select One</option>
        <?php 
        $query = "SELECT * FROM satt_customer_progres where status=1";
        $result = $db->select($query);
        if ($result) {
            while ($rows = $result->fetch_assoc()) { ?>
            <option
                <?=$row['progressive_state'] ==  $rows['progress_state'] ? ' selected="selected"' : '';?>
                
            value="<?php echo $rows['progress_state'] ?>"><?php echo $rows['progress_state']; ?> </option>  
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
               <label for="interested_services">Select Interested Service<span class="text-danger">*</span></label>
              <select multiple="multiple" class="form-control select" id="interested_services" name="interested_services[]">
                <!-- <option value=""></option> -->
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
    <div class="col-lg-6">
        <div class="form-group">
            <label for="institute_type" class="col-form-label">Institute Category<span class="text-danger"></span></label>
            <input type="text" name="institute_type" id="institute_type" class="form-control" placeholder="Institute Category" value="">
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="institute_name" class="col-form-label">Institute Name<span class="text-danger"></span></label>
            <input type="text" name="institute_name" id="institute_name" class="form-control" placeholder="Interested Services" value="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="institute_address" class="col-form-label">Institute Address</label>
            <textarea name="institute_address" id="institute_address" rows="2" class="form-control" style="resize: none;" placeholder="Enter Institute Address"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
              <label for="institute_district">Select Districts </label>
              <select class="form-control select" id="institute_district" name="institute_district">
                <option value="">Select One</option>
                <?php 
                $dis_query = "SELECT * FROM satt_districts";
                $dis_result = $db->select($dis_query);
                if ($dis_result) {
                    while ($dis_row = $dis_result->fetch_assoc()) { ?>
                    <option value="<?php echo $dis_row['name'] ?>"><?php echo $dis_row['name']; ?> </option>
                    <?php  } } ?>
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
          <label for="software_category">Select Software Category<span class="text-danger">*</span></label>
          <input type="text"  name="software_category" id="software_category" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
          <label for="domain_name">Domain Name<span class="text-danger">*</span></label>
          <input type="text"  name="domain_name" id="domain_name" class="form-control">
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12">
             <div class="form-group">
              <label for="user_name">Added By<span class="text-danger">*</span></label>
              <input type="text" readonly name="user_name" id="user_name" class="form-control" value="<?php echo $user_name; ?>">
              <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id="user_id" class="form-control">
              <input type="hidden" value="<?php echo $form_table; ?>" name="form_table" id="form_table" class="form-control">
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
