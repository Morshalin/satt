<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$agent_id = $_POST['agent_id'];

	// $client_id = $_POST['client_id'];
	

	$customer = $_POST['client_id'];
	$agent_id = $_POST['agent_id'];

	if (!$customer) {
		$error['customer_id'] = 'Customer Field required';
	}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$customer1 = explode(',', $customer);
		$client_id = $customer1[0];
		$client_name = $customer1[1];
		$query = "SELECT * FROM agent_client WHERE agent_id = '$agent_id' AND client_id = '$client_id'";
		$get_cli = $db->select($query);
		if ($get_cli) {
			die(json_encode(['errors' => $error, 'message' => 'Client Is Already Added']));
		}else{

			$query = "INSERT INTO agent_client (agent_id, client_id, client_name) VALUES ('$agent_id','$client_id', '$client_name')";

			$result = $db->insert($query);
			if ($result != false) {
				die(json_encode(['message' => 'Client Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
}
?>