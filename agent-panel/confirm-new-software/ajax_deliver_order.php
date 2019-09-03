<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/confirm-new-software', 'Confirm New Software');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$new_order_id = $_GET['new_order_id'];
	if ($new_order_id) {
		$error = array();

		

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
				die(json_encode(['message' => ' Product Order Delivered Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

