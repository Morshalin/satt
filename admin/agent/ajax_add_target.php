<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$agent_id = $_POST['agent_id'];

	$month = $_POST['month'];
	$target_amount = $_POST['target_amount'];

	if (!$month) {
		$error['month'] = 'Month Field Is Required';
	}

	if (!$target_amount) {
		$error['target_amount'] = 'Target Amount Field Is Required';
	}



		$query = "SELECT * FROM agent_target WHERE month = '$month' AND agent_id = '$agent_id'";
		$get_target = $db->select($query);
		if ($get_target) {
			$error['month'] = 'Target Of This Month Is Available';
			http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Target Of This Month Already Added']));
		}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {

		
			$query = "INSERT INTO agent_target (agent_id,month,target_amount) VALUES ('$agent_id','$month','$target_amount')";

			$result = $db->insert($query);

			if ($result != false) {
				die(json_encode(['message' => 'Target Added Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}


	}
}
?>