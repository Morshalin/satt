<?php
require_once '../../config/config.php';
ajax();
 Session::checkSession('customer-panel', CUSTOMER_URL . '/pending-new-software','Pending Order');
if (isset($_GET['new_order_id'])) {
	$new_order_id = $_GET['new_order_id'];
	if ($new_order_id) {
		$query = "SELECT * FROM new_product_order WHERE id = '$new_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Order Details Not Found']));
		}
	}else{
		die(json_encode(['message' => 'Order Id Not Found']));
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	
	$cancel_reason = $fm->validation($_POST['cancel_reason']);



		if (!$cancel_reason) {
		$error['cancel_reason'] = 'Cancel Reason Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "UPDATE new_product_order set 
				confirmation_status = '0',
				  delivery_status = '0',
				  cancel_status = '1',
				  cancel_reason = '$cancel_reason',
				  cancel_date = now()
				  WHERE id = '$new_order_id'";
		$update = $db->update($query);
	
			if ($update != false) {
				die(json_encode(['message' => 'Order Cancelled Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	
} 
}
