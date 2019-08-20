<?php
require_once '../../config/config.php';
ajax();
?>
<?php 
  if (isset($_GET['delid'])) {
   $delid = $_GET['delid'];
   $delquery = "DELETE FROM  satt_official_notes WHERE id ='$delid'";
   $delresult = $db->delete($delquery);
   if ($delresult) {
    die(json_encode(['message' => 'Note Delete Successfuly']));
  } else {
    http_response_code(500);
    die(json_encode(['message' => 'Note Not Found']));
  }

}
?>

<?php 
    if (isset($_GET['customerdetails_id'])) {
       $customerdetails_id = $_GET['customerdetails_id'];
?>
<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/customerdetails/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create Notes <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <label for="customerdetails_id">Select Customer Name</label>
              <select class="form-control" id="customerdetails_id" name="customerdetails_id">
                <?php 
                     $query = "SELECT * FROM satt_customer_informations where id ='$customerdetails_id'";
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

        <div class="col-lg-2">
             <label for="check"><strong>Check Reason</strong></label>
            <div class="">
                <label for="check" class="form-check-label">On/Off</label>
                  <input type="checkbox" name="check" id="check" value="0" class="mt-2">
            </div>
        </div>
        <div class="col-lg-4" id="flied"
        style="display: none;">
            <div class="form-group leave">
                <label for="institute_name" class="col-form-label">Leave Reason<span class="text-danger">*</span></label>
              <select multiple="multiple" class="form-control select" id="leave_reason" name="leave_reason[]">
                <?php 
                     $query = "SELECT * FROM satt_customer_notes where status=1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                           <option value="<?php echo $row['id'] ?>"><?php echo $row['reason']; ?> </option>  
                      <?php  }
                        $row = $result->fetch_assoc();
                    } else {
                        http_response_code(500);
                        die(json_encode(['message' => 'Reasion Not Found']));
                    }
                ?>
              </select>

                   
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
    <input type="hidden" name="action" value="add_note">
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
   <th>Leave Reasion</th>
   <th>Customer Note</th>
   <th>Create Date</th>
   <th>update Date</th>
   <th>Action</th>
</tr>
<?php 

$notequery = "SELECT *, a.user_name, c.name, n.id, n.note, n.creat_date, n.update_date
from satt_official_notes  n
join satt_admins  a on a.id = n.admin_id 
join satt_customer_informations  c on c.id = n.customer_id 
and n.customer_id = '$customerdetails_id'";
  $noteresult = $db->select($notequery);
  if ($noteresult) {
    while ($notedata = $noteresult->fetch_assoc()) { 
      ?>
        <tr id="tr_<?php echo $notedata['id']; ?>">
        <td><?php echo $notedata['user_name'];?></td>
        <td><?php echo $notedata['name'];?></td>
        <td>
          <?php
            $reason = '';
            $sql = "SELECT satt_customer_notes.reason from  satt_leave_reason inner join  satt_customer_notes on satt_leave_reason.leave_reason = satt_customer_notes.id where  satt_leave_reason.custimer_id = '$customerdetails_id'";
        
              $result = $db->select($sql);
              if ($result) {
                  while ($data = $result->fetch_assoc()) { ?>
                     <span class="badge badge-success mr-1"><?php echo $data['reason']; ?> </span>
                  <?php }  ?>
                  <button class="mt-1 btn btn-danger btn-sm delete_note" data-dismiss="modal" data-url="<?php echo ADMIN_URL ?>/customerdetails/ajax.php?notedelid=<?php echo $customerdetails_id; ?>">Delete</button>
                <?php } ?>
        </td>
        <td><?php echo $notedata['note'];?></td>
        <td><?php echo $notedata['creat_date'];?></td>
        <td><?php echo $notedata['update_date'];?></td>
        <td><button class="btn btn-danger btn-small delete_note" data-url="<?php echo ADMIN_URL ?>/customerdetails/ajax.php?delid=<?php echo $notedata['id']; ?>" id="<?php echo $notedata['id']; ?>">Delete </button></td>
    </tr>
   <?php } } ?>

</table>




<?php } ?>
<!-- /login form -->
