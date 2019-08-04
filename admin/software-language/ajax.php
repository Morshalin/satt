<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-language', 'Software Language');
if (isset($_GET['software_language_id'])) {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$query = "SELECT * FROM software_language WHERE id = '$software_language_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Language Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$error = array();
		$software_language_name = $fm->validation($_POST['software_language_name']);

		$courseCheck = $fm->dublicateCheck('software_language', 'software_language_name', $software_language_name);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$software_language_name) {
			$error['software_language_name'] = 'Software Language Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $software_language_id) {
				$error['software_language_name'] = 'Software Language Already Exists';
			}

		} elseif (strlen($software_language_name) > 255) {
			$error['software_language_name'] = 'Software Language Name Can Not Be More Than 255 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE software_language SET software_language_name = '$software_language_name', status = '$status' WHERE id='$software_language_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Software Language Updated Successfull']));
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
	$software_language_name = $fm->validation($_POST['software_language_name']);

	$courseCheck = $fm->dublicateCheck('software_language', 'software_language_name', $software_language_name);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$software_language_name) {
		$error['software_language_name'] = 'Software Language Name Field required';
	} elseif ($courseCheck) {
		$error['software_language_name'] = 'Software Language Already Exits';
	} elseif (strlen($software_language_name) > 255) {
		$error['software_language_name'] = 'Software Language Name Can Not Be More Than 255 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO software_language (software_language_name, status) VALUES ('$software_language_name', '$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Software Language Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$query = "DELETE FROM software_language WHERE id = '$software_language_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Language Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$software_language_id = $_GET['software_language_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($software_language_id) {
		$query = "UPDATE software_language SET status = '$status' WHERE id = '$software_language_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Language Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
