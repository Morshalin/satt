<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/confirm-order', 'Confirm Order');
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

	$cpanel_user = $fm->validation($_POST['cpanel_user']);
	$cpanel_pass = $fm->validation($_POST['cpanel_pass']);

	if (!$cpanel_user) {
		$error['cpanel_user'] = 'Cpanel Username Field required';
	}elseif (strlen($cpanel_user) > 255) {
		$error['cpanel_user'] = 'Cpanel Username Can Not Be More Than 255 Charecters';
	}

	if (!$cpanel_pass) {
		$error['cpanel_pass'] = 'Cpanel Password Field required';
	}elseif (strlen($cpanel_pass) > 255) {
		$error['cpanel_pass'] = 'Cpanel Password Can Not Be More Than 255 Charecters';
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
				$result = $db->delete($query);
				if ($result) {
					die(json_encode(['message' => 'Deliver Order Successfull']));
				} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

