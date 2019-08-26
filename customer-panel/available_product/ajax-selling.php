<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details', 'Software Details');
if (isset($_GET['software_details_id'])) {
	$software_details_id = $_GET['software_details_id'];
	if ($software_details_id) {
		$query = "SELECT * FROM software_details WHERE id = '$software_details_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_details_id = $_GET['software_details_id'];
	if ($software_details_id) {
		$error = array();

		$selling_point = $_POST['selling_point'];


		if (!$selling_point) {
			$error['selling_point'] = 'Selling Point Field required';
		}
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE software_details SET selling_point = '$selling_point' WHERE id='$software_details_id'";
			$result = $db->update($query);

			if ($result) {
					die(json_encode(['message' => 'Selling Point Updated Successfull']));
			}else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

