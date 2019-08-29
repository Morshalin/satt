<?php
require_once '../../config/config.php';
ajax();
 Session::checkSession('customer-panel', CUSTOMER_URL . '/pending_product','Pending Product');
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
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	
	$yearly_renew_charge = $fm->validation($_POST['yearly_renew_charge']);



		if (!$short_feature) {
		$error['short_feature'] = 'Short Feature Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO software_details (software_name,software_status_name,) VALUES ('$software_name','$software_status_name')";
	
			if ($result != false) {
				die(json_encode(['message' => 'Software Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
	
} 
