<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/role', 'Role');
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM role WHERE serial_no='$id'";
  $result = $db->select($query);
  if ($result) {
    $row1 = $result->fetch_assoc();
  } else {
    http_response_code(500);
    die(json_encode(['message' => 'Role Not Found']));
  }

} else {
  http_response_code(500);
  die(json_encode(['message' => 'UnAthorized']));
}


  $query = "SELECT * FROM role_has_permission WHERE role_serial_no ='$id'";
  $get_permission = $db->select($query);
  $permission = [];
  if ($get_permission) {
    while ($row = $get_permission->fetch_assoc()) {
      $permission[] = $row['permission_serial_no'];
    }
  }

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/role/ajax_edit.php?id=<?php echo $id; ?>&action=update" id="content_form" method="post">
    <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Edit Role <small style="color: red"> (* Marked Fields Are Required)</small></legend>
    
                    <div class="form-group row" >
                      <div class="col-lg-3"></div>
                      <div class="col-lg-6">
                        <label class="control-label" for="first-name">Role Name <span class="required">*</span>
                      </label>
                      <div>
                        <input type="text" id="role_name" name="role_name" value="<?php echo $row1['role_name'] ?>" required="required" class="form-control" placeholder="Provie A Role Name">
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
                                    <input type="checkbox" class="software_setup" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
<!-- System User section -->

                    <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox"  id="system_user"> <b style="margin-top: 0px; font-sixe:18px;color: red">System User :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` limit 53,1";

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
                                    <input type="checkbox" class="system_user" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                                    <input type="checkbox" class="promote_product" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                          $query = "SELECT * FROM `permission` LIMIT 57, 1";
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
                                    <input type="checkbox" class="existing_software" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>

                              <?php
                            }
                          }
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
                                    <input type="checkbox" class="existing_software" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                          $query = "SELECT * FROM `permission` LIMIT 58, 1";
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
                                    <input type="checkbox" class="new_software" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
                                  </label>
                                </div>
                              </div>
                              <?php
                            }
                          }
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
                                    <input type="checkbox" class="new_software" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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

<!-- Collect Software Due -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="collect_software_due"><b style="margin-top: 0px; font-sixe:18px;color: red">Collect Software Due :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 41, 3";

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
                                    <input type="checkbox" class="collect_software_due" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                                    <input type="checkbox" class="graphics_detail" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
<!-- Office Account -->
                  <div class="row">
                      <div class="col-md-2">
                        <div class="checkbox">
                          <label class="text-uppercase">
                            <input type="checkbox" id="office_account"><b style="margin-top: 0px; font-sixe:18px;color: red">Office Account :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 44, 3";

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
                                    <input type="checkbox" class="office_account" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                            <input type="checkbox" id="reports"> <b style="margin-top: 0px; font-sixe:18px;color: red">Reports :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 47, 6";

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
                                    <input type="checkbox" class="reports" value="<?php echo $row['serial_no'] ?>" id="checkbox_<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> name="permission[]"> <?php echo ucwords($final_name); ?>
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
                                    <input type="checkbox" class="customer_details" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                                    <input type="checkbox" class="messaging" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                                    <input type="checkbox" class="message_note" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                            <input type="checkbox" id="developer_setup"> <b style="margin-top: 0px; font-sixe:18px;color: red">Office Stuff :</b>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <?php 
                          $query = "SELECT * FROM `permission` LIMIT 54, 3";

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
                                    <input type="checkbox" class="developer_setup" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                          $query = "SELECT * FROM `permission` LIMIT 35, 5";

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
                                    <input type="checkbox" class="agents" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
                          $query = "SELECT * FROM `permission` LIMIT 40, 1";
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
                                    <input type="checkbox" class="role" value="<?php echo $row['serial_no'] ?>" <?php 
                                    foreach($permission as $value){
                                        if ($row['serial_no'] == $value) {
                                          echo "checked";
                                          break;
                                        }
                                      } ?> id="checkbox_<?php echo $row['serial_no'] ?>" name="permission[]"> <?php echo ucwords($final_name); ?>
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
