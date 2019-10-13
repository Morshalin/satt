<?php
require_once '../../config/config.php';
ajax();
?>
<?php 
    if (isset($_GET['Office_note_id'])) {
       $Office_note_id = $_GET['Office_note_id'];
?>
<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/office_note/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create Notes <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <label for="Office_note_id">Select Customer Name</label>
              <select class="form-control" id="Office_note_id" name="Office_note_id">
                <?php 
                     $query = "SELECT * FROM satt_extra_office_notes where id ='$Office_note_id'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Note Not Found']));
                    }
                ?>
              </select>
            </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
              <label for="next_contact" class="col-form-label">Next Contacted Date<span class="text-danger">*</span></label>
              <input type="text" name="next_contact" id="next_contact" class="form-control date" placeholder="Select Start Date" required autofocus value="">
          </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="course_description" class="col-form-label">Satt Notes</label>
                <textarea name="note" id="note" rows="3" class="form-control" style="resize: none;" placeholder=" New Note Description Here"></textarea>
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
    <input type="hidden" name="contact" value="next_contact">
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<br>

<table class="table">
  <tr>
   <th>Admin Name</th>
   <th>Customer name</th>
   <th>Customer Note</th>
   <th>Next Contacted Date</th>
   <th>Create Date</th>
   <th>Action</th>
</tr>
<?php 

$notequery = "SELECT *, a.user_name, c.name, n.id, n.note, n.next_contact, n.create_date
from satt_exter_next_contacted  n
join satt_admins  a on a.id = n.admin_id 
join satt_extra_office_notes  c on c.id = n.customer_id 
and n.customer_id = '$Office_note_id'";
  $noteresult = $db->select($notequery);
  if ($noteresult) {
    while ($notedata = $noteresult->fetch_assoc()) { 
      ?>
        <tr id="tr_<?php echo $notedata['id']; ?>">
        <td><?php echo $notedata['user_name'];?></td>
        <td><?php echo $notedata['name'];?></td>
        <td><?php echo $notedata['note'];?></td>
        <td><?php echo $notedata['next_contact'];?></td>
        <td><?php echo $notedata['create_date'];?></td>
        <td><button class="btn btn-danger btn-small delete_note" data-url="<?php echo ADMIN_URL ?>/office_note/ajax.php?contactnotedelid=<?php echo $notedata['id']; ?>" id="<?php echo $notedata['id']; ?>">Delete </button></td>
    </tr>
   <?php } } ?>

</table>




<?php } ?>
<!-- /login form -->
