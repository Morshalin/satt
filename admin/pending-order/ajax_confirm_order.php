<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/pending-order', 'Pending Order');
// if (isset($_GET['pending_order_id'])) {
// 	$pending_order_id = $_GET['pending_order_id'];
// 	if ($pending_order_id) {
// 		$query = "SELECT * FROM satt_order_products WHERE id = '$pending_order_id'";
// 		$result = $db->select($query);
// 		if (!$result) {
// 			http_response_code(500);
// 			die(json_encode(['message' => 'Pending Order Not Found']));
// 		}
// 	}
// }




// order cancel 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pending_order_id = $_GET['pending_order_id'];
	if ($pending_order_id) {
		$error = array();

		$cancel_reason = $fm->validation($_POST['cancel_reason']);

		if (!$cancel_reason) {
			$error['cancel_reason'] = 'Cancel Reason Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_order_products SET cancel_reason = '$cancel_reason', roll = '1' WHERE id='$pending_order_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => ' Product Order Cancel Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

