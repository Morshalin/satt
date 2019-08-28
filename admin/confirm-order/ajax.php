<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/confirm-order', 'Confirm Order');
if (isset($_GET['confirm_order_id'])) {
	$confirm_order_id = $_GET['confirm_order_id'];
	if ($confirm_order_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$confirm_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Confirm Order Not Found']));
		}
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$confirm_order_id = $_GET['confirm_order_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($confirm_order_id) {
		$query = "UPDATE satt_order_products SET 
		status = '$status',
		confirm_date = now()
		 WHERE id = '$confirm_order_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Order Confirmation Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}

