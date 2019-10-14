<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details', 'Software Details');
if (isset($_GET['software_details_id'])) {
  $software_details_id = $_GET['software_details_id'];
  $query = "SELECT * FROM software_details WHERE id='$software_details_id'";
  $result = $db->select($query);
  if ($result) {
    $row = $result->fetch_assoc();
  } else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Details Not Found']));
  }

} else {
  http_response_code(500);
  die(json_encode(['message' => 'UnAthorized']));
}

?>
<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/software-details/ajax-selling.php?software_details_id=<?php echo $software_details_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Selling Point</legend>
    <div class="row">
      <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="selling_point" class="col-form-label">Selling Point <span class="text-danger">*</span></label>
                <input type="number" name="selling_point" id="selling_point" class="form-control" placeholder="Type Selling point" required autofocus value="<?php echo $row['selling_point']; ?>">

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
<!-- /login form -->
