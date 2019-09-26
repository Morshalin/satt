<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/role/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Role <small style="color: red"> (* Marked Fields Are Required)</small></legend>
    
                    <div class="form-group row" >
                      <div class="col-lg-3"></div>
                      <div class="col-lg-6">
                        <label class="control-label" for="first-name">Role Name <span class="required">*</span>
                      </label>
                      <div>
                        <input type="text" id="role_name" name="role_name" required="required" class="form-control" placeholder="Provie A Role Name">
                      </div>
                      </div>
                      <div class="col-lg-3"></div>
                      
                    </div>


                    <div class="form-group" style="margin-bottom: 30px" >
                      <h2 style="text-align: center;color: red">Select The Following Options To Give Permission </h2>

                      <label>
                        <input type="checkbox" id="all_checked"> <b style="margin-top: 0px; font-sixe:18px;color: red">SELECT ALL :</b>
                      </label>
                    </div>

<!-- Important Setting section -->

                    <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox"  id="software_setup"> <b style="margin-top: 0px; font-sixe:18px;color: red">Software Setup :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` limit 5";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);

                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="software_setup" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div><hr>

<!-- Company section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="promote_product"> <b style="margin-top: 0px; font-sixe:18px;color: red">Promote Product :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 5, 1";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="promote_product" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


<!-- Employee section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="existing_software"> <b style="margin-top: 0px; font-sixe:18px;color: red">Existing Software Order :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 6, 5";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="existing_software" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>

<!-- Customers section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="new_software"> <b style="margin-top: 0px; font-sixe:18px;color: red">New Software Order :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 11, 5";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="new_software" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


<!-- Own Shop section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="graphics_detail"><b style="margin-top: 0px; font-sixe:18px;color: red">Graphics Details :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 16, 6";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="graphics_detail" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>

<!-- Transport section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="customer_details"> <b style="margin-top: 0px; font-sixe:18px;color: red">Customer Details :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 22, 7";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="customer_details" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


<!-- Product section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="messaging"> <b style="margin-top: 0px; font-sixe:18px;color: red">Messaging :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 29, 3";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="messaging" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


<!-- Order & Delivery section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="message_note"> <b style="margin-top: 0px; font-sixe:18px;color: red">Message Note :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 32, 3";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="message_note" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>



<!-- Account section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="developer_setup"> <b style="margin-top: 0px; font-sixe:18px;color: red">Developer Setup :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 35, 1";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="developer_setup" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


<!-- Reports section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="agents"> <b style="margin-top: 0px; font-sixe:18px;color: red">Agent :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 36, 5";

                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="agents" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>

<!-- Role section -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="role"> <b style="margin-top: 0px; font-sixe:18px;color: red">Role :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 41, 1";
                          $get_permission = $db->select($query);

                          if ($get_permission) {
                            while ($row = $get_permission->fetch_assoc()) {
                              $name = $row['permission_name'];
                              $name1 = explode("_",$name);
                              $final_name = implode(" ",$name1);
                              ?>

                              <div class="col-md-4">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" class="role" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }

                          ?>

                        </div>
                      </div>
                    </div>
                    <hr>


                    <div style="display: none;">
                      <input type="number" id="edit_id" name="edit_id">
                    </div>

                    <div class="ln_solid"></div>
                    
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


<script>
  // software_setup checkbox
$(document).on('change','#software_setup',function(){

  if (this.checked) {
    $('.software_setup').prop('checked', true);
  }else{
    $('.software_setup').prop('checked', false);
  }

});

// promote_product checkbox
$(document).on('change','#promote_product',function(){

  if (this.checked) {
    $('.promote_product').prop('checked', true);
  }else{
    $('.promote_product').prop('checked', false);
  }

});

// existing_software checkbox
$(document).on('change','#existing_software',function(){

  if (this.checked) {
    $('.existing_software').prop('checked', true);
  }else{
    $('.existing_software').prop('checked', false);
  }

});

// new_software checkbox
$(document).on('change','#new_software',function(){

  if (this.checked) {
    $('.new_software').prop('checked', true);
  }else{
    $('.new_software').prop('checked', false);
  }

});

// graphics_detail checkbox
$(document).on('change','#graphics_detail',function(){

  if (this.checked) {
    $('.graphics_detail').prop('checked', true);
  }else{
    $('.graphics_detail').prop('checked', false);
  }

});

// customer_details checkbox
$(document).on('change','#customer_details',function(){

  if (this.checked) {
    $('.customer_details').prop('checked', true);
  }else{
    $('.customer_details').prop('checked', false);
  }

});

// messaging checkbox
$(document).on('change','#messaging',function(){

  if (this.checked) {
    $('.messaging').prop('checked', true);
  }else{
    $('.messaging').prop('checked', false);
  }

});

// message_note checkbox
$(document).on('change','#message_note',function(){

  if (this.checked) {
    $('.message_note').prop('checked', true);
  }else{
    $('.message_note').prop('checked', false);
  }

});

// developer_setup checkbox
$(document).on('change','#developer_setup',function(){

  if (this.checked) {
    $('.developer_setup').prop('checked', true);
  }else{
    $('.developer_setup').prop('checked', false);
  }

});

// agents checkbox
$(document).on('change','#agents',function(){

  if (this.checked) {
    $('.agents').prop('checked', true);
  }else{
    $('.agents').prop('checked', false);
  }

});

// role checkbox
$(document).on('change','#role',function(){

  if (this.checked) {
    $('.role').prop('checked', true);
  }else{
    $('.role').prop('checked', false);
  }

});

// all_checked checkbox
$(document).on('change','#all_checked',function(){

  if (this.checked) {
    $('.software_setup').prop('checked', true);
    $('#software_setup').prop('checked', true);
    $('.promote_product').prop('checked', true);
    $('#promote_product').prop('checked', true);
    $('.existing_software').prop('checked', true);
    $('#existing_software').prop('checked', true);
    $('.new_software').prop('checked', true);
    $('#new_software').prop('checked', true);
    $('.graphics_detail').prop('checked', true);
    $('#graphics_detail').prop('checked', true);
    $('.customer_details').prop('checked', true);
    $('#customer_details').prop('checked', true);
    $('.messaging').prop('checked', true);
    $('#messaging').prop('checked', true);
    $('.message_note').prop('checked', true);
    $('#message_note').prop('checked', true);
    $('.developer_setup').prop('checked', true);
    $('#developer_setup').prop('checked', true);
    $('.agents').prop('checked', true);
    $('#agents').prop('checked', true);
    $('.role').prop('checked', true);
    $('#role').prop('checked', true);
  }else{
    $('.software_setup').prop('checked', false);
    $('#software_setup').prop('checked', false);
    $('.promote_product').prop('checked', false);
    $('#promote_product').prop('checked', false);
    $('.existing_software').prop('checked', false);
    $('#existing_software').prop('checked', false);
    $('.new_software').prop('checked', false);
    $('#new_software').prop('checked', false);
    $('.graphics_detail').prop('checked', false);
    $('#graphics_detail').prop('checked', false);
    $('.customer_details').prop('checked', false);
    $('#customer_details').prop('checked', false);
    $('.messaging').prop('checked', false);
    $('#messaging').prop('checked', false);
    $('.message_note').prop('checked', false);
    $('#message_note').prop('checked', false);
    $('.developer_setup').prop('checked', false);
    $('#developer_setup').prop('checked', false);
    $('.agents').prop('checked', false);
    $('#agents').prop('checked', false);
    $('.role').prop('checked', false);
    $('#role').prop('checked', false);
  }

});
</script>


                   
