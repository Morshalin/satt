<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$agent_id = $_POST['agent_id'];

	// $client_id = $_POST['client_id'];
	

	$note = $_POST['note'];

	if (!$note) {
		$error['note'] = 'Note Field required';
	}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		

			$query = "INSERT INTO agent_note (agent_id, note) VALUES ('$agent_id','$note')";

			$result = $db->insert($query);
			if ($result != false) {
				die(json_encode(['message' => 'Note Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	}
}
?>