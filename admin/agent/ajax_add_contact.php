<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$contact_note = $_POST['contact_note'];
	$contact_by = $_POST['contact_by'];
	$contact_time = $_POST['contact_time'];
	$contact_date = $_POST['contact_date'];

	$agent_id = $_POST['agent_id'];
	


	if (!$contact_note) {
		$error['contact_note'] = 'Contact Note Field required';
	}

	if (!$contact_by) {
		$error['contact_by'] = 'Contact By Field required';
	}

	if (!$contact_time) {
		$error['contact_time'] = 'Contact Time Field required';
	}

	if (!$contact_date) {
		$error['contact_date'] = 'Contact Date Field required';
	}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		

			$query = "INSERT INTO agent_contact (agent_id, contact_note, contact_by, contact_time,contact_date) VALUES ('$agent_id', '$contact_note', '$contact_by', '$contact_time','$contact_date')";

			$result = $db->insert($query);
			if ($result != false) {
				die(json_encode(['message' => 'Contact Information Added Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	}
}
?>