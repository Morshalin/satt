<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['pay_order_id'])) {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$query = "SELECT * FROM graphics_info WHERE id = '$pay_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Graphics Order Not Found']));
		}
	}
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$error = array();
		$pay_amount = $fm->validation($_POST['pay_amount']);
		$payment_method = $fm->validation($_POST['payment_method']);
		$tx_id_account_no = $fm->validation($_POST['tx_id_account_no']);
		$received_mobile_no = $fm->validation($_POST['received_mobile_no']);
		$received_by = $fm->validation($_POST['received_by']);

		if (!$pay_amount) {
			$error['pay_amount'] = 'Pay Field required';
		}elseif (!$payment_method) {
			$error['payment_method'] = 'Payment Method Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query1 = "INSERT INTO graphics_pay (order_id, pay, payment_method, tx_id_account_no, received_mobile_no, received_by) VALUES ('$pay_order_id','$pay_amount','$payment_method', '$tx_id_account_no', '$received_mobile_no','$received_by')";
				$result1 = $db->insert($query1);
			if ($result1 != false) {
				die(json_encode(['message' => ' New Pay Confirmed Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

