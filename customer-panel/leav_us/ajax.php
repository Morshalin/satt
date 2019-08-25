<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/leav_us', 'leav_us');
if (isset($_GET['reason_id'])) {
	$reason_id = $_GET['reason_id'];
	if ($reason_id) {
		$query = "SELECT * FROM satt_customer_notes WHERE id = '$reason_id'";
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
	$reason_id = $_GET['reason_id'];
	if ($reason_id) {
		$error = array();
		$reason = $fm->validation($_POST['reason']);

		$reason_check = $fm->dublicateCheck('satt_customer_notes', 'reason', $reason);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$reason) {
			$error['reason'] = 'Field required';
		} elseif ($reason_check) {
			$reason_row = $reason_check->fetch_assoc();
			if ($reason_row['id'] != $reason_id) {
				$error['reason'] = 'Already Exists';
			}

		} elseif (strlen($reason) > 255) {
			$error['reason'] = 'Can Not Be More Than 255 Charecters';
		}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_notes SET reason = '$reason', status = '$status' WHERE id='$reason_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'I Updated Successfull']));
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
	$reason = $fm->validation($_POST['reason']);
	

	$check_reason = $fm->dublicateCheck('satt_customer_notes', 'reason', $reason);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$reason) {
		$error['reason'] = 'Field required';
	} elseif ($check_reason) {
		$error['check_reason'] = 'Already Exits';
	} elseif (strlen($reason) > 255) {
		$error['reason'] = 'Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_customer_notes (reason, status) VALUES ('$reason','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delete  Data into Database
===================================================================*/
// $error['reason'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$reason_id = $_GET['reason_id'];
	if ($reason_id) {
		$query = "DELETE FROM satt_customer_notes WHERE id = '$reason_id'";
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
		$query = "UPDATE satt_customer_notes SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
