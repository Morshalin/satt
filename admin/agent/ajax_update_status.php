<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}
	}
}


/*================================================================
	Update data into database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {

	$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
	$result = $db->select($query);
	

	$error = array();
	$status = $fm->validation($_POST['status']);
	$level = $fm->validation($_POST['level']);


	
	if (!$status) {
		$error['status'] = 'status Field required';
	}

	if (!$level && $status == 'Promoted') {
		$error['level'] = 'Level Field required';
	}



		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {

			$query = "UPDATE agent_list SET 
			status = '$status',
			level = '$level'
			 WHERE id='$agent_id'";
			$result = $db->update($query);
			// $update = "";

					die(json_encode(['message' => 'Developer Updated Successfull']));
				
				if ($update) {
					die(json_encode(['message' => 'Developer Updated Successfull']));
				}else{
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
		}
	}else{
		http_response_code(500);
	die(json_encode(['message' => 'Agent Not Found']));
	}
	
}






