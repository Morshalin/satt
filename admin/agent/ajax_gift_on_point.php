<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$agent_id = $_POST['agent_id'];

	$gift_id = $_POST['gift_id'];

	if (!$gift_id) {
		$error['gift_id'] = 'Gift Field required';
	}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		
			$query = "SELECT * FROM agent_gift WHERE id = '$gift_id'";
			$get_gift_info = $db->select($query)->fetch_assoc();

			$gift_name = $get_gift_info['gift_name'];
			$cost_point = $get_gift_info['points'];

			$query ="SELECT * FROM agent_list WHERE id = '$agent_id'";
			$available_point = $db->select($query)->fetch_assoc()['points'];

			$updated_point = (int)$available_point - (int)$cost_point;

			$query = "INSERT INTO agent_provide_gift (agent_id,gift_tbl_id,cost_point,gift_name) VALUES ('$agent_id','$gift_id','$cost_point','$gift_name')";

			$result = $db->insert($query);
			if ($result != false) {
				$query = "UPDATE agent_list set points = '$updated_point' WHERE id = '$agent_id'";
				$update_agent = $db->update($query);
				if ($update_agent) {
					die(json_encode(['message' => 'Gift Added Successfull']));
				}
				
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	}
}
?>