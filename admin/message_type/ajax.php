<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message', 'Message');
if (isset($_GET['message_type_id'])) {
	$course_id = $_GET['message_type_id'];
	if ($course_id) {
		$query = "SELECT * FROM satt_message_type WHERE id = '$course_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Message Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$course_id = $_GET['message_type_id'];
	if ($course_id) {
		$error = array();
		$message_type = $fm->validation($_POST['message_type']);

		// $courseCheck = $fm->dublicateCheck('satt_courses', 'course_name', $course_name);
		// $codeCheck = $fm->dublicateCheck('satt_courses', 'course_code', $course_code);

		if (!$message_type) {
			$error['message_type'] = 'Message type Field required';
		} else if (strlen($message_type) > 500) {
			$error['message_type'] = 'Message type Can Not Be More Than 500 Charecters';
		}


		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_message_type SET type = '$message_type' WHERE id='$course_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Message Updated Successfull']));
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
	$message_type = $fm->validation($_POST['message_type']);

	if (!$message_type) {
		$error['message_type'] = 'Message required';
	}  elseif (strlen($message_type) > 255) {
		$error['message_type'] = 'Message Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_message_type(type) VALUES ('$message_type')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Message Type Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['type'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$message_type_id = $_GET['message_type_id'];
	if ($message_type_id) {
		$query = "DELETE FROM satt_message_type WHERE id = '$message_type_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Message Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$message_type_id = $_GET['message_type_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($message_type_id) {
		$query = "UPDATE satt_message SET status = '$status' WHERE id = '$message_type_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Message Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
