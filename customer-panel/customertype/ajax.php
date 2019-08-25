<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customertype', 'customertype');
if (isset($_GET['customertype_id'])) {
	$customertype_id = $_GET['customertype_id'];
	if ($customertype_id) {
		$query = "SELECT * FROM satt_customer_type WHERE id = '$customertype_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Customer Type Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$customertype_id = $_GET['customertype_id'];
	if ($customertype_id) {
		$error = array();
		$type = $fm->validation($_POST['type']);

		$typecheck = $fm->dublicateCheck('satt_customer_type', 'type', $type);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$type) {
			$error['type'] = 'Customer Reference Name Field required';
		} elseif ($typecheck) {
			$course_row = $typecheck->fetch_assoc();
			if ($course_row['id'] != $course_id) {
				$error['type'] = 'Course Already Exists';
			}

		} elseif (strlen($type) > 255) {
			$error['type'] = 'Customer Reference Can Not Be More Than 255 Charecters';
		}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_type SET type = '$type', status = '$status' WHERE id='$customertype_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Customer Reference Updated Successfull']));
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
	$type = $fm->validation($_POST['type']);
	

	$typeCheck = $fm->dublicateCheck('satt_customer_type', 'type', $type);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$type) {
		$error['type'] = 'Customer Reference Field required';
	} elseif ($typeCheck) {
		$error['type'] = 'Customer Reference Already Exits';
	} elseif (strlen($type) > 255) {
		$error['type'] = 'Customer Reference Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_customer_type (type, status) VALUES ('$type','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Customer Reference Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delete  Data into Database
===================================================================*/
// $error['type'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$customertype_id = $_GET['customertype_id'];
	if ($customertype_id) {
		$query = "DELETE FROM satt_customer_type WHERE id = '$customertype_id'";
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
		$query = "UPDATE satt_customer_type SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
