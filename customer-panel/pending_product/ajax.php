<?php
require_once '../../config/config.php';
ajax();
 Session::checkSession('customer-panel', CUSTOMER_URL . '/pending_product','Pending Product');
if (isset($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	if ($product_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$product_id'";
		$result = $db->select($query);
		if (!$result) {
			$row = $result->fetch_assoc();
			http_response_code(500);
			die(json_encode(['message' => 'Software Details Not Found']));
		}
	}
}

/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	$roll = $fm->validation($_POST['roll']);
	$cancel_reason = $fm->validation($_POST['reason']);
	if (!$cancel_reason) {
		$error['cancel_reason'] = 'Order Cancel flied required';
	}
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "UPDATE satt_order_products SET 
		roll = '$roll', 
		cancel_reason='$cancel_reason'
		WHERE id = '$product_id'";
		$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Order Cancel Successfuly']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	} 
}