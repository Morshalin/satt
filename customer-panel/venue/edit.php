<?php
require_once '../../config/config.php';
ajax();
if (isset($_GET['venue_id'])) {
	$venue_id = $_GET['venue_id'];
	$query = "SELECT * FROM satt_venues WHERE id='$venue_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Venue Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/venue/ajax.php?venue_id=<?php echo $venue_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Venue <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="venue_name" class="col-form-label">Venue Name <span class="text-danger">*</span></label>
                <input type="text" name="venue_name" id="venue_name" class="form-control" venueholder="New Venue Name" required autofocus value="<?php echo $row['venue_name'] ?>">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="venue_code" class="col-form-label">Venue Code <span class="text-danger">*</span></label>
                <input type="text" name="venue_code" id="venue_code" class="form-control" venueholder="New Venue Code" required value="<?php echo $row['venue_code'] ?>">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="venue_description" class="col-form-label">Venue Description</label>
                <textarea name="venue_description" id="venue_description" rows="3" class="form-control" style="resize: none;" venueholder="Enter New Venue Description Here"><?php echo $row['venue_description'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="venue_description" class="form-check-label">Status</label>
                  <input type="checkbox" name="venue_status" id="venue_status" value="1" class="form-check-input-switchery mt-3" data-fouc <?php echo $row['venue_status'] == 1 ? 'checked' : ''; ?>>

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
