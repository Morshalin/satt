<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message', 'Message');
if (isset($_GET['message_type_id'])) {
	$message_type_id = $_GET['message_type_id'];
	$query = "SELECT * FROM satt_message_type WHERE id='$message_type_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Message Type Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/message_type/ajax.php?action=update&message_type_id=<?php echo $row['id'] ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold"> <span class="text-danger">*</span> <small>  Fields can not be empty </small></legend>
    <div class="row text-center">
        <div class="col-lg-8 mx-auto">
            <div class="form-group">
                <label for="type" class="col-form-label">Message type <span class="text-danger">*</span></label>
                <!-- <textarea type="text" name="message_type" id="message_type" class="form-control" autofocus rows="5" cols="80"> <?php echo $row['type'] ?> </textarea> -->
								<input type="text" name="message_type" id="message_type" class="form-control" autofocus value="<?php echo $row['type'] ?>">
            </div>
        </div>
    </div>

		<div class="text-center">
				<button type="submit" name="create" class="btn btn-success ml-31 mr-2 px-5" id="submit">Save changes</button>
				<button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
		</div>

</fieldset>
</form>
<!-- /login form -->
