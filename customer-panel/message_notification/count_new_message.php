<?php
require_once '../../config/config.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$customer_id = $_POST['customer_id'];

	$query = "SELECT * FROM admin_customer_chat WHERE to_user_id = '$customer_id' AND to_whom = 'client' AND seen_status_customer = '0'";
	$get_admin_cus_chat = $db->select($query);
	$count_chat = 0;
	if ($get_admin_cus_chat) {
		while ($row = $get_admin_cus_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	$query = "SELECT * FROM agent_customer_chat WHERE to_user_id = '$customer_id'  AND to_whom = 'client' AND seen_status_client = '0'";
	$get_agent_cust_chat = $db->select($query);
	if ($get_agent_cust_chat) {
		while ($row = $get_agent_cust_chat->fetch_assoc()) {
			$count_chat = (int)$count_chat + 1;
		}
	}

	// 
	echo json_encode($count_chat);
}
?>