<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/confirm-order', 'Pay Order');
if (isset($_GET['pay_order_id'])) {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$pay_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Pay Order Not Found']));
		}
	}
}



// order cancel 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$error = array();
		$pay_amount = $fm->validation($_POST['pay_amount']);
		$due_amount = $fm->validation($_POST['due_amount']);
		$payment_method = $fm->validation($_POST['payment_method']);
		$mobile_banking_name = $fm->validation($_POST['mobile_banking_name']);
		$received_phone_number = $fm->validation($_POST['received_phone_number']);
		$tx_id = $fm->validation($_POST['tx_id']);
		$check_no = $fm->validation($_POST['check_no']);

		if (!$pay_amount) {
			$error['pay_amount'] = 'Pay Field required';
		}elseif (!$payment_method) {
			$error['payment_method'] = 'Payment Method Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query1 = "INSERT INTO existing_product_pay (product_order_id, payment_method, check_no, mobile_banking_name, received_phone_number, tx_id, pay_amount, pay_date) VALUES ('$pay_order_id','$payment_method','$check_no', '$mobile_banking_name', '$received_phone_number','$tx_id','$pay_amount', now())";
				$result1 = $db->insert($query1);
			if ($result1 != false) {
				die(json_encode(['message' => ' New Pay Confirm Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

