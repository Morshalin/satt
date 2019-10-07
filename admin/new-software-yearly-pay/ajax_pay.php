<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/New Software Monthly Pay', 'Pay Order');
if (isset($_GET['pay_order_id'])) {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$query = "select * from new_product_order WHERE delivery_status = '1' and id = '$pay_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Order Not Found']));
		}
	}
}



// order cancel 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pay_order_id = $_GET['pay_order_id'];
	if ($pay_order_id) {
		$error = array();
		$pay_amount = $fm->validation($_POST['pay_amount']);
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
				$query1 = "INSERT INTO new_product_pay (new_product_order_id, payment_type, check_numer, mobile_banking_name, received_phone_number, tx_id, pay_amount, date) VALUES ('$pay_order_id','$payment_method','$check_no', '$mobile_banking_name', '$received_phone_number','$tx_id','$pay_amount', now())";
				$result1 = $db->insert($query1);
			if ($result1 != false) {
				die(json_encode(['message' => 'New Pay Inserted Successfully.']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Sorry Pay Information Not Inserted.']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happened Wrong. Please Try Again Later']));
}
