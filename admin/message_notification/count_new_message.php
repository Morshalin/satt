<?php
require_once '../../config/config.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$admin_id = $_POST['admin_id'];

	$query = "SELECT * FROM admin_customer_chat WHERE to_user_id = '$admin_id' AND to_whom = 'admin' AND seen_status_admin = '0'";
	$get_admin_cus_chat = $db->select($query);
	$count_chat = 0;
	if ($get_admin_cus_chat) {
		while ($row = $get_admin_cus_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	$query = "SELECT * FROM agent_admin_chat WHERE to_user_id = '$admin_id'  AND to_whom = 'admin' AND seen_status_admin = '0'";
	$get_admin_agent_chat = $db->select($query);
	if ($get_admin_agent_chat) {
		while ($row = $get_admin_agent_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	// 
	echo json_encode($count_chat);
}
?>