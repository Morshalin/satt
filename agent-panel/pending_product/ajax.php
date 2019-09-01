<?php
require_once '../../config/config.php';
ajax();
 Session::checkSession('agent-panel', AGENT_URL . '/pending_product','Pending Product');
if (isset($_GET['order_id'])) {
	$order_id = $_GET['order_id'];
	if ($order_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$order_id'";
		$result = $db->select($query);
		if (!$result) {
			$row = $result->fetch_assoc();
			http_response_code(500);
			die(json_encode(['message' => 'Order Details Not Found']));
		}
	}
}

/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	$cancel_reason = $fm->validation($_POST['reason']);
	if (!$cancel_reason) {
		$error['cancel_reason'] = 'Order Cancel Reason flied required';
	}
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "UPDATE satt_order_products SET 
		roll = '1',
		status = '0', 
		cancel_reason='$cancel_reason',
		cancel_date = now()
		WHERE id = '$order_id'";
		$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Order Cancelled Successfuly']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	} 
}