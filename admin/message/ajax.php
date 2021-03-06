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
	$course_id = $_GET['message_id'];
	if ($course_id) {
		$error = array();
		$message_type = $fm->validation($_POST['message_type']);
		$customer_question = $fm->validation($_POST['customer_question']);
		$our_reply = $fm->validation($_POST['our_reply']);
		$software_information = $fm->validation($_POST['software_information']);
		$contact_details = $fm->validation($_POST['contact_details']);
		$introduction_message = $fm->validation($_POST['introduction_message']);

		// $courseCheck = $fm->dublicateCheck('satt_courses', 'course_name', $course_name);
		// $codeCheck = $fm->dublicateCheck('satt_courses', 'course_code', $course_code);

		if (!$message_type) {
			$error['message_type'] = 'Message type Field required';
		} else if (strlen($message_type) > 500) {
			$error['message_type'] = 'Message type Can Not Be More Than 500 Charecters';
		}

		if (!$customer_question) {
			$error['customer_question'] = 'Customer question Field required';
		} else if (strlen($customer_question) > 500) {
			$error['customer_question'] = 'Customer question Can Not Be More Than 500 Charecters';
		}

		if (!$our_reply) {
			$error['our_reply'] = 'Our reply Field required';
		} else if (strlen($our_reply) > 500) {
			$error['our_reply'] = 'Our reply Can Not Be More Than 500 Charecters';
		}

		if (!$software_information) {
			$error['software_information'] = 'Software information Field required';
		} else if (strlen($software_information) > 500) {
			$error['software_information'] = 'Software information Can Not Be More Than 500 Charecters';
		}

		if (!$contact_details) {
			$error['contact_details'] = 'Contact details Field required';
		} else if (strlen($contact_details) > 500) {
			$error['contact_details'] = 'Contact details Can Not Be More Than 500 Charecters';
		}

		if (!$introduction_message) {
			$error['introduction_message'] = 'Introduction message Field required';
		} else if (strlen($introduction_message) > 500) {
			$error['introduction_message'] = 'Introduction message Can Not Be More Than 500 Charecters';
		}


		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_message SET message_type = '$message_type', customer_question = '$customer_question', our_reply = '$our_reply', software_information = '$software_information', contact_details = '$contact_details', introduction_message = '$introduction_message' WHERE id='$course_id'";
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
