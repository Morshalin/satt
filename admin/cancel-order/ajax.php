<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/cancel-order', 'Cancel Order');
if (isset($_GET['cancel_order_id'])) {
	$cancel_order_id = $_GET['cancel_order_id'];
	if ($cancel_order_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$cancel_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Cancel Order Not Found']));
		}
	}
}


