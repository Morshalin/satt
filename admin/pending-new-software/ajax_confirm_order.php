<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/pending-new-softare', 'Pending New Software');
if (isset($_GET['new_order_id'])) {
	$new_order_id = $_GET['new_order_id'];
	if ($new_order_id) {
		$query = "SELECT * FROM new_product_order WHERE id = '$new_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'New Software Order Not Found']));
		}
	}
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$new_order_id = $_GET['new_order_id'];
	if ($new_order_id) {
		$error = array();

		$developer_id = $_POST['developer_id'];
		$language_id = $_POST['language_id'];
		$development_start_date = $_POST['development_start_date'];
		$expected_dead_line = $_POST['expected_dead_line'];

		$selling_method = $fm->validation($_POST['selling_method']);
		$installation_charge = $fm->validation($_POST['installation_charge']);
		$agent_comission = $fm->validation($_POST['agent_comission']);
		$yearly_renew_charge = $fm->validation($_POST['yearly_renew_charge']);
		$sell_price = $fm->validation($_POST['seling_total_price']);


		$pay_amount = $fm->validation($_POST['pay_amount']);
		$payment_type = $fm->validation($_POST['payment_method']);
		$check_numer = $fm->validation($_POST['check_no']);
		$mobile_banking_name = $fm->validation($_POST['mobile_banking_name']);
		$received_phone_number = $fm->validation($_POST['received_phone_number']);
		$tx_id = $fm->validation($_POST['tx_id']);
		;

		if (!$sell_price) {
			$error['seling_total_price'] = 'Selling Total Price Field required';
		}elseif (!$pay_amount) {
			$error['pay_amount'] = 'Pay Field required';
		}elseif (!$developer_id) {
			$error['developer_id'] = 'Developer Field required';
		}elseif (!$language_id) {
			$error['language_id'] = 'Language Field required';
		}elseif (!$selling_method) {
			$error['selling_method'] = 'Selling Method Field required';
		}elseif (!$installation_charge) {
			$error['installation_charge'] = 'Installation Cahrge Field required';
		}elseif (!$yearly_renew_charge) {
			$error['yearly_renew_charge'] = 'Yearly Renew Cahrge Field required';
		}elseif (!$payment_type) {
			$error['payment_method'] = 'Payment Method Field required';
		}

		if ($payment_type == 'mobile' && !$mobile_banking_name) {
			$error['mobile_banking_name'] = 'Mobile Baking Name Field required';
		}elseif ($payment_type == 'mobile' && !$received_phone_number) {
			$error['received_phone_number'] = 'Receive Phone No Field required';
		}elseif ($payment_type == 'check' && !$check_no) {
			$error['check_no'] = 'Check No Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE new_product_order 
			SET 
			sell_price = '$sell_price',
			selling_method = '$selling_method',
			installation_charge = '$installation_charge',
			agent_comission = '$agent_comission',
			yearly_renew_charge = '$yearly_renew_charge',
			confirmation_status = '1',
			confirm_date = now(),
			development_start_date = '$development_start_date',
			expected_dead_line = '$expected_dead_line'
			WHERE id = '$new_order_id'";
			$order_update = $db->update($query);
			if ($order_update) {
				for ($i=0; $i <count($developer_id) ; $i++) { 
					$dev_id = $developer_id[$i];
					$query = "INSERT INTO new_product_developer (new_product_order_id,	developer_id) VALUES ('$new_order_id','$dev_id') ";
					$insert_developer = $db->insert($query);
				}
				
				if ($insert_developer) {
					for ($i=0; $i <count($language_id) ; $i++) { 
						$lang_id = $language_id[$i];
						$query = "INSERT INTO new_product_language (new_product_order_id,	language_id) VALUES ('$new_order_id','$lang_id') ";
						$insert_language = $db->insert($query);
					}
				}
				if ($insert_language) {
					$query = "INSERT INTO new_product_pay 
							(new_product_order_id,payment_type,check_numer,mobile_banking_name,received_phone_number,tx_id,pay_amount,date) 
							VALUES 
							('$new_order_id','$payment_type','$check_numer','$mobile_banking_name','$received_phone_number','$tx_id','$pay_amount',now())";
					$insert_pay = $db->insert($query);
				}
			}
			if ($insert_pay != false) {
				die(json_encode(['message' => ' Product Order Confirm Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

