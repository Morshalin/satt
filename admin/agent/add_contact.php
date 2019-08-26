<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM agent_contact WHERE agent_id='$agent_id' ORDER BY id DESC";
    $result = $db->select($query);
    

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_add_contact.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Contact Info <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
   <div class="row">
         <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Type The Note Here  <span class="text-danger">*</span></label>
               
                <textarea name="contact_note" id="contact_note"class="form-control" cols="30" rows="7"></textarea>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

   <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Contact By  <span class="text-danger">*</span></label>
               
               
                <select name="contact_by" id="contact_by" class="form-control select" required="">
                    <option value="">Please Select One</option>
                    <?php 
                        $query = "SELECT * FROM agent_contact_by WHERE status = '1'";
                        $get_person = $db->select($query);
                        if ($get_person) {
                            while ($person = $get_person->fetch_assoc()) {
                               ?>
                                <option value="<?php echo 'ID: '.$person['contact_person_id'].', Name: '.$person['name'] ?>"><?php echo 'ID: '.$person['contact_person_id'].', Name: '.$person['name'] ?></option>
                               <?php
                            }
                        }
                     ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

   <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Contact Time  <span class="text-danger">*</span></label>
               
                <input type="time" id="content_time" name="contact_time" class="form-control" placeholder="Select Time">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

   <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Contact Date  <span class="text-danger">*</span></label>
               
                <input type="text" id="contact_date" name= "contact_date" class="form-control date" placeholder="Select Date">
            </div>
        </div>
        <div class="col-lg-4"></div>
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

<div class="content">
  <div class="card border-top-success rounded-top-0" id="table_card">
    <div class="card-header header-elements-inline bg-light border-grey-300" >
        <h5 class="card-title text-center"><?php echo isset($data['page_title']) ? $data['page_title'] : 'List Of Contact Info'; ?>
        
        </h5>
       
    </div>
    <div class="card-body">
       
        <div id="table_display">
            <table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contact By</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                        if ($result) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $id = $row['id'];
                                ?>
                                <tr id="tr_<?php echo $id ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['contact_by']; ?></td>
                                    <td><?php echo $row['contact_note']; ?></td>
                                    <td><?php echo $row['contact_time']; ?></td>
                                    <td><?php echo $row['contact_date']; ?></td>
                                    <td><button class="btn btn-danger delete_agetnt_contact" data-url="<?php echo ADMIN_URL ?>/agent/ajax_delete.php?agent_contact_id=<?php echo $id ?>" id="<?php echo $id ?>">Delete</button></td>
                                </tr>
                                <?php
                            }
                        }


                     ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<!-- /login form -->
