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
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/software-details/ajax.php?software_details_id=<?php echo $software_details_id; ?>&action=update" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Software Details</legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_name" class="col-form-label">Software Name <span class="text-danger">*</span></label>
                <input type="text" name="software_name" id="software_name" class="form-control" placeholder="Type Software Name" required autofocus value="<?php echo $row['software_name']; ?>">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Software Status <span class="text-danger">*</span></label>
                <select class="select form-control"  name="software_status" id="software_status">
                    <option value="">Select Software Status</option>
                    <?php
                    $query_software_status = "SELECT * FROM software_status";
                    $select_software_status = $db->select($query_software_status);
                    if ($select_software_status) {
                        while ($software_status = $select_software_status->fetch_assoc()) {
                            $status_id = $software_status['id'];
                            ?>

                            <option value="<?php echo $software_status['software_status_name'].','.$software_status['id']; ?>" <?=$row['software_status_id'] == $status_id ? ' selected="selected"' : '';?>   > <?php echo $software_status['software_status_name']; ?></option>

                            <?php } }?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="software_status_name" class="col-form-label">Software Language <span class="text-danger">*</span></label>
                        <select class="select form-control"  multiple="multiple" name="language_name[]" id="language_name">
                         <?php
                         $query_software_language = "SELECT * FROM software_language";
                         $select_software_language = $db->select($query_software_language);

                         $query= "SELECT * FROM software_language_multi WHERE software_id = '$software_details_id'";
                         $select= $db->select($query);
                         $language_id = [];
                         if ($select) {
                            $j=0;
                            while ($row1 = $select->fetch_assoc()) {
                             $language_id[$j] = $row1['language_id'];
                             $j++;
                         }
                     }
                     if ($select_software_language) {
                        while ($software_language = $select_software_language->fetch_assoc()) {
                            $lang_id = $software_language['id'];
                            ?>
                            <option value="<?php echo $software_language['id']; ?>" <?php if(array_search($software_language['id'], $language_id) !== false) {echo 'selected';} ?> ><?php echo $software_language['software_language_name']; ?></option>
                            <?php } }?>
                        </select>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="software_status_name" class="col-form-label">Developed By <span class="text-danger">*</span></label>
                        <select class="select form-control"  multiple="multiple" name="developer_name[]" id="developer_name">
                         <?php
                         $query_developer = "SELECT * FROM developer";
                         $select_developer = $db->select($query_developer);
                         $query= "SELECT * FROM software_develope_by WHERE software_id = '$software_details_id'";
                         $select= $db->select($query);
                         $developer_id = [];
                         if ($select) {
                            $k=0;
                            while ($row2 = $select->fetch_assoc()) {
                             $developer_id[$k] = $row2['developer_id'];
                             $k++;
                         }
                     }
                     if ($select_developer) {
                        while ($developer = $select_developer->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $developer['id']; ?>" <?php if(array_search($developer['id'], $developer_id) !== false) {echo 'selected';} ?> ><?php echo $developer['name']; ?></option>

                          <?php } }?>
                      </select>

                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                    <label for="create_date" class="col-form-label">Software Start Date <span class="text-danger">*</span></label>
                    <input type="text" name="create_date" id="create_date" class="form-control date" placeholder="Select Start Date" required autofocus value="<?php echo $row['create_date']; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="end_date" class="col-form-label">Software End Date</label>
                    <input type="text" name="end_date" id="end_date" class="form-control date" placeholder="Select End Date " required autofocus value="<?php echo $row['end_date']; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="short_feature" class="col-form-label">Software Short Features <span class="text-danger">*</span></label>
                    <textarea name="short_feature" id="short_feature" class="form-control" placeholder="Type Short Features " required autofocus ><?php echo $row['short_feature']; ?></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="user_manual" class="col-form-label">Software User Manual</label>
                    <input type="text" name="user_manual" id="user_manual" class="form-control" placeholder="Type User Manual " required autofocus value="<?php echo $row['user_manual']; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="condition_details" class="col-form-label">Software Proposal and Condition Demo Details </label>
                    <textarea name="condition_details" id="condition_details" class="form-control" placeholder="Software End Date " required autofocus ><?php echo $row['condition_details']; ?></textarea>
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
