<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/progressivestate', 'progressivestate');
if (isset($_GET['progress_id'])) {
	$progress_id = $_GET['progress_id'];
	if ($progress_id) {
		$query = "SELECT * FROM satt_customer_progres WHERE id = '$progress_id'";
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
	$progress_id = $_GET['progress_id'];
	if ($progress_id) {
		$error = array();
		$progress_state = $fm->validation($_POST['progress_state']);

		$progress_state_check = $fm->dublicateCheck('satt_customer_progres', 'progress_state', $progress_state);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$progress_state) {
			$error['progress_state'] = 'progress state Field required';
		} elseif ($progress_state_check) {
			$progress_state_row = $progress_state_check->fetch_assoc();
			if ($progress_state_row['id'] != $progress_id) {
				$error['progress_state'] = 'Course Already Exists';
			}

		} elseif (strlen($progress_state) > 255) {
			$error['progress_state'] = 'Progress State Can Not Be More Than 255 Charecters';
		}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_progres SET progress_state = '$progress_state', status = '$status' WHERE id='$progress_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Progress State Updated Successfull']));
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
	$progress_state = $fm->validation($_POST['progress_state']);
	

	$check_progress_state = $fm->dublicateCheck('satt_customer_progres', 'progress_state', $progress_state);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$progress_state) {
		$error['progress_state'] = 'progress state Field required';
	} elseif ($check_progress_state) {
		$error['check_progress_state'] = 'progress state  Already Exits';
	} elseif (strlen($progress_state) > 255) {
		$error['progress_state'] = 'progress state Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_customer_progres (progress_state, status) VALUES ('$progress_state','$status')";
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
// $error['progress_state'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$progress_id = $_GET['progress_id'];
	if ($progress_id) {
		$query = "DELETE FROM satt_customer_progres WHERE id = '$progress_id'";
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
		$query = "UPDATE satt_customer_progres SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
