<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/business-type', 'business-type');
if (isset($_GET['software_id'])) {
	$software_id = $_GET['software_id'];
	if ($software_id) {
		$query = "SELECT * FROM satt_customer_business_type WHERE id = '$software_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Progress State Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_id = $_GET['software_id'];
	if ($software_id) {
		$error = array();
		$software_type = $fm->validation($_POST['software_type']);

		$software_type_check = $fm->dublicateCheck('satt_customer_business_type', 'software_type', $software_type);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$software_type) {
			$error['software_type'] = 'Business Category Field required';
		} elseif ($software_type_check) {
			$software_type_row = $software_type_check->fetch_assoc();
			if ($software_type_row['id'] != $software_id) {
				$error['software_type'] = 'Business Category Already Exists';
			}

		} elseif (strlen($software_type) > 255) {
			$error['software_type'] = 'Business Category Can Not Be More Than 255 Charecters';
		}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_business_type SET software_type = '$software_type', status = '$status' WHERE id='$software_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Business Category Updated Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	$software_type = $fm->validation($_POST['software_type']);
	

	$check_software_type = $fm->dublicateCheck('satt_customer_business_type', 'software_type', $software_type);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$software_type) {
		$error['software_type'] = 'Business Category Field required';
	} elseif ($check_software_type) {
		$error['check_software_type'] = 'Business Category  Already Exits';
	} elseif (strlen($software_type) > 255) {
		$error['software_type'] = 'Business Category Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_customer_business_type (software_type, status) VALUES ('$software_type','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Business Category Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delete  Data into Database
===================================================================*/
// $error['software_type'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$software_id = $_GET['software_id'];
	if ($software_id) {
		$query = "DELETE FROM satt_customer_business_type WHERE id = '$software_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}


/*================================================================
		Change Status  Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$status_id = $_GET['status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($status_id) {
		$query = "UPDATE satt_customer_business_type SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
