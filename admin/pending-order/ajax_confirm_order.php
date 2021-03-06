<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/pending-order', 'Pending Order');
if (isset($_GET['pending_order_id'])) {
	$pending_order_id = $_GET['pending_order_id'];
	if ($pending_order_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$pending_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Pending Order Not Found']));
		}
	}
}




// order cancel 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pending_order_id = $_GET['pending_order_id'];
	if ($pending_order_id) {
		$error = array();

		$product_id = $_POST['product_id'];
		$querys = "SELECT * FROM software_details WHERE id = '$product_id'";
		$results = $db->select($querys);
		if ($results) {
			$rows = $results->fetch_assoc();
			$selling_point = $rows['selling_point'];
		}

		$agent_id = $_POST['agent_id'];
		$agent_querys = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$agent_results = $db->select($agent_querys);
		if ($agent_results) {
			$agent_rows = $agent_results->fetch_assoc();
			$point = $agent_rows['points'];
			$new_point = $point + $selling_point;
		}

		$total_price = $fm->validation($_POST['total_price']);
		$yearly_renew_charge = $fm->validation($_POST['yearly_renew_charge']);
		$installation_charge = $fm->validation($_POST['installation_charge']);

		$seling_total_price = $fm->validation($_POST['seling_total_price']);
		$pay_amount = $fm->validation($_POST['pay_amount']);
		$due_amount = $fm->validation($_POST['due_amount']);
		$payment_method = $fm->validation($_POST['payment_method']);
		$mobile_banking_name = $fm->validation($_POST['mobile_banking_name']);
		$received_phone_number = $fm->validation($_POST['received_phone_number']);
		$tx_id = $fm->validation($_POST['tx_id']);
		$check_no = $fm->validation($_POST['check_no']);

		if (!$seling_total_price) {
			$error['seling_total_price'] = 'Selling Total Price Field required';
		}elseif (!$pay_amount) {
			$error['pay_amount'] = 'Pay Field required';
		}elseif (!$payment_method) {
			$error['payment_method'] = 'Payment Method Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_order_products SET 
			status = '1',
			yearly_renew_charge = '$yearly_renew_charge',
			installation_charge = '$installation_charge',
			seling_total_price = '$seling_total_price',
			confirm_date = now()
			 WHERE id = '$pending_order_id'";
			$result = $db->delete($query);
			if ($result) {
				$query1 = "INSERT INTO existing_product_pay (product_order_id, payment_method, check_no, mobile_banking_name, received_phone_number, tx_id, pay_amount, pay_date) VALUES ('$pending_order_id','$payment_method','$check_no', '$mobile_banking_name', '$received_phone_number','$tx_id','$pay_amount', now())";
				$result1 = $db->insert($query1);

				if ($agent_id) {
					$agentquery = "UPDATE agent_list SET points = '$new_point' WHERE id='$agent_id'";
					$agentresult = $db->update($agentquery);
				}
			}
			if ($result1 != false) {
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

