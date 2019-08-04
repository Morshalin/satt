<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message', 'Message');
if (isset($_GET['message_id'])) {
	$course_id = $_GET['message_id'];
	if ($course_id) {
		$query = "SELECT * FROM satt_message WHERE id = '$course_id'";
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
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$error = array();
		$course_name = $fm->validation($_POST['course_name']);
		$course_code = $fm->validation($_POST['course_code']);
		$course_description = $fm->validation($_POST['course_description']);

		$courseCheck = $fm->dublicateCheck('satt_courses', 'course_name', $course_name);
		$codeCheck = $fm->dublicateCheck('satt_courses', 'course_code', $course_code);

		if (isset($_POST['course_status'])) {
			$course_status = 1;
		} else {
			$course_status = 0;
		}

		if (!$course_name) {
			$error['course_name'] = 'Course Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $course_id) {
				$error['course_name'] = 'Course Already Exists';
			}

		} elseif (strlen($course_name) > 255) {
			$error['course_name'] = 'Course Name Can Not Be More Than 255 Charecters';
		}

		if (!$course_code) {
			$error['course_code'] = 'Course Code Field required';
		} elseif ($codeCheck) {
			$code_row = $codeCheck->fetch_assoc();
			if ($code_row['id'] != $course_id) {
				$error['course_code'] = 'Course Code Already Exits';
			}
		} elseif (strlen($course_code) > 255) {
			$error['course_code'] = 'Course Code Can Not Be More Than 255 Charecters';
		}

		if (strlen($course_description) > 500) {
			$error['course_description'] = 'Course Code Can Not Be More Than 500 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_courses SET course_name = '$course_name', course_code = '$course_code', course_description = '$course_description', course_status = '$course_status' WHERE id='$course_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Course Updated Successfull']));
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
	$customer_question = $fm->validation($_POST['customer_question']);
	$our_reply = $fm->validation($_POST['our_reply']);
	$software_information = $fm->validation($_POST['software_information']);
	$contact_details = $fm->validation($_POST['contact_details']);
	$introduction_message = $fm->validation($_POST['introduction_message']);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$message_type) {
		$error['message_type'] = 'Message required';
	}  elseif (strlen($message_type) > 255) {
		$error['message_type'] = 'Message Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_message(message_type, customer_question, our_reply, software_information, contact_details, introduction_message, status) VALUES ('$message_type', '$customer_question', '$our_reply', '$software_information', '$contact_details', '$introduction_message', '$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Message Added Successfull']));
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
	$message_id = $_GET['message_id'];
	if ($message_id) {
		$query = "DELETE FROM satt_message WHERE id = '$message_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Message Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$message_id = $_GET['message_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($message_id) {
		$query = "UPDATE satt_message SET status = '$status' WHERE id = '$message_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Message Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
