<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/confirm-new-software', 'Confirm New Software');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$new_order_id = $_GET['new_order_id'];
	if ($new_order_id) {
		$error = array();

		$pay_amount = $fm->validation($_POST['installation_charge_pay']);
		$payment_method = $fm->validation($_POST['payment_method']);
		$mobile_banking_name = $fm->validation($_POST['mobile_banking_name']);
		$received_phone_number = $fm->validation($_POST['received_phone_number']);
		$tx_id = $fm->validation($_POST['tx_id']);
		$check_no = $fm->validation($_POST['check_no']);
		$domain_link =  $fm->validation($_POST['domain_link']);
		$cpanel_username =  $fm->validation($_POST['cpanel_username']);
		$password =  $fm->validation($_POST['password']);
		$delivery_status = '1';



		if (!$domain_link) {
			$error['domain_link'] = 'Domain Link  Field required';
		}elseif (!$cpanel_username) {
			$error['cpanel_username'] = 'C Panel User Name Field  required';
		}elseif (!$password) {
			$error['password'] = 'Password  Field required';
		}elseif (!$pay_amount) {
			$error['installation_charge_pay'] = 'Installation Charge Pay Field required';
		}elseif (!$payment_method) {
			$error['payment_method'] = 'Payment Method Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE new_product_order 
			SET 
			delivery_status = '$delivery_status',
			delivery_date = now(),
			domain_link = '$domain_link',
			cpanel_username = '$cpanel_username',
			password = '$password'

			WHERE id = '$new_order_id'";
			$order_update = $db->update($query);
			if ($order_update != false) {

				$query1 = "INSERT INTO new_product_installation_pay (new_product_order_id, payment_type, check_numer, mobile_banking_name, received_phone_number, tx_id, pay_amount, `date` ) VALUES ('$new_order_id','$payment_method','$check_no', '$mobile_banking_name', '$received_phone_number','$tx_id','$pay_amount', now())";
				$result1 = $db->insert($query1);
					if ($result1) {
						die(json_encode(['message' => 'Product Order Delivered Successfully']));
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

