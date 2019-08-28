<?php
require_once '../../config/config.php';
ajax();
 Session::checkSession('customer-panel', CUSTOMER_URL . '/available_product','Available Product');
if (isset($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	if ($product_id) {
		$query = "SELECT * FROM satt_order_products WHERE id = '$product_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Details Not Found']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$product_id = $_GET['product_id'];
	if ($product_id) {
		$query = "DELETE FROM satt_order_products WHERE id = '$product_id'";
		$result = $db->delete($query);
		if ($result) {
				die(json_encode(['message' => 'Software Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
