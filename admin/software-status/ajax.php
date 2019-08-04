<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-status', 'Software Status');
if (isset($_GET['software_status_id'])) {
	$software_status_id = $_GET['software_status_id'];
	if ($software_status_id) {
		$query = "SELECT * FROM software_status WHERE id = '$software_status_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Status Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_status_id = $_GET['software_status_id'];
	if ($software_status_id) {
		$error = array();
		$software_status_name = $fm->validation($_POST['software_status_name']);

		$courseCheck = $fm->dublicateCheck('software_status', 'software_status_name', $software_status_name);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$software_status_name) {
			$error['software_status_name'] = 'Software Status Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $software_status_id) {
				$error['software_status_name'] = 'Software Status Already Exists';
			}

		} elseif (strlen($software_status_name) > 255) {
			$error['software_status_name'] = 'Software Status Name Can Not Be More Than 255 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE software_status SET software_status_name = '$software_status_name', status = '$status' WHERE id='$software_status_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Software Status Updated Successfull']));
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
	$software_status_name = $fm->validation($_POST['software_status_name']);

	$courseCheck = $fm->dublicateCheck('software_status', 'software_status_name', $software_status_name);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$software_status_name) {
		$error['software_status_name'] = 'Software Status Name Field required';
	} elseif ($courseCheck) {
		$error['software_status_name'] = 'Software Status Already Exits';
	} elseif (strlen($software_status_name) > 255) {
		$error['software_status_name'] = 'Software Status Name Can Not Be More Than 255 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO software_status (software_status_name, status) VALUES ('$software_status_name', '$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Software Status Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_status_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$software_status_id = $_GET['software_status_id'];
	if ($software_status_id) {
		$query = "DELETE FROM software_status WHERE id = '$software_status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Status Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$software_status_id = $_GET['software_status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($software_status_id) {
		$query = "UPDATE software_status SET status = '$status' WHERE id = '$software_status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Status Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
