<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['change_order_id'])) {
	$change_order_id = $_GET['change_order_id'];
	if ($change_order_id) {
		$query = "SELECT * FROM graphics_info WHERE id = '$change_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Graphics Order Not Found']));
		}
	}
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$change_order_id = $_GET['change_order_id'];
	if ($change_order_id) {
		$error = array();
		$order_status = $fm->validation($_POST['order_status']);

		if (!$order_status) {
			$error['order_status'] = 'Order Status Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query = "UPDATE graphics_info SET status = '$order_status' WHERE id = '$change_order_id' ";
				$update = $db->update($query);
			if ($update != false) {
				die(json_encode(['message' => ' Status Changed Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

