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



if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$deliver_order_id = $_GET['deliver_order_id'];
	if ($deliver_order_id) {
	$error = array();

	$pay_amount = $fm->validation($_POST['installation_charge_pay']);
	$payment_method = $fm->validation($_POST['payment_method']);
	$mobile_banking_name = $fm->validation($_POST['mobile_banking_name']);
	$received_phone_number = $fm->validation($_POST['received_phone_number']);
	$tx_id = $fm->validation($_POST['tx_id']);
	$check_no = $fm->validation($_POST['check_no']);
	$cpanel_user = $fm->validation($_POST['cpanel_user']);
	$cpanel_pass = $fm->validation($_POST['cpanel_pass']);

	if (!$cpanel_user) {
		$error['cpanel_user'] = 'Cpanel Username Field required';
	}elseif (!$pay_amount) {
			$error['installation_charge_pay'] = 'Installation Charge Pay Field required';
		}

	if (!$cpanel_pass) {
		$error['cpanel_pass'] = 'Cpanel Password Field required';
	}elseif (!$payment_method) {
			$error['payment_method'] = 'Payment Method Field required';
		}

	if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_order_products SET 
				delivery_status = '1',
				cpanel_user = '$cpanel_user',
				cpanel_pass = '$cpanel_pass',
				delivery_date = now()
				 WHERE id = '$deliver_order_id'";
				$result = $db->update($query);
				if ($result) {
						$query1 = "INSERT INTO existing_product_installation_pay (product_order_id, payment_method, check_no, mobile_banking_name, received_phone_number, tx_id, pay_amount, pay_date) VALUES ('$deliver_order_id','$payment_method','$check_no', '$mobile_banking_name', '$received_phone_number','$tx_id','$pay_amount', now())";
						$result1 = $db->insert($query1);
						if ($result1) {
							die(json_encode(['message' => 'Deliver Order Successfull']));
						}
				} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

