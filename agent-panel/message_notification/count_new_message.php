<?php
require_once '../../config/config.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$agent_id = $_POST['agent_id'];

	$query = "SELECT * FROM agent_admin_chat WHERE to_user_id = '$agent_id' AND to_whom = 'agent' AND seen_status_agent = '0'";
	$get_agent_admin_chat = $db->select($query);
	$count_chat = 0;
	if ($get_agent_admin_chat) {
		while ($row = $get_agent_admin_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	$query = "SELECT * FROM agent_customer_chat WHERE to_user_id = '$agent_id'  AND to_whom = 'agent' AND seen_status_agent = '0'";
	$get_agent_cus_chat = $db->select($query);
	if ($get_agent_cus_chat) {
		while ($row = $get_agent_cus_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	// 
	echo json_encode($count_chat);
}
?>