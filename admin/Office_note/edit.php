<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/Office_note', 'Office_note');
if (isset($_GET['note_id'])) {
	$note_id = $_GET['note_id'];
	$query = "SELECT * FROM satt_official_notes WHERE id='$note_id'";
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
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/Office_note/ajax.php?note_id=<?php echo $note_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Note Description <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="note" class="col-form-label">Note Description</label>
                <textarea name="note" id="note" rows="3" class="form-control" style="resize: none;"><?php echo $row['note'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
             <label for="customerdetails_id"><strong>Check Reason</strong></label>
            <div class="">
                <label for="check" class="form-check-label">On/Off</label>
                  <input type="checkbox" name="check" id="check" value="0" class="mt-2">
            </div>
        </div>
        <div class="col-lg-10" id="flied"
        style="display: none;">
            <div class="form-group leave">
                <label for="institute_name" class="col-form-label">Leave Reason<span class="text-danger">*</span></label>
                <select class="form-control" id="leave_reason" name="leave_reason">
                <option></option>
                <?php 
                     $query = "SELECT * FROM satt_customer_notes";
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
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="course_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Update</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
