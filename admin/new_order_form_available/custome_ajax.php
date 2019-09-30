<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/new_order_form_available', 'order-new-software');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$option = '';
	$option .= '<option value="">Please Select One</option>';

	$agent_id = $_POST['agent_name'];

	if($agent_id == 0 ){
		$query1 = "SELECT * FROM satt_customer_informations";
		$result1 = $db->select($query1);
		if ($result1) {
			while ($data1 = $result1->fetch_assoc()) {
				$option .= '<option value="'.$data1["id"].'"> '.$data1["name"].'</option>';
			}
		}
		die(json_encode($option));

	}else{
		

		$query = "SELECT * FROM agent_client WHERE agent_id = '$agent_id'";
		$get_customer = $db->select($query);
		if ($get_customer) {
			while ($data = $get_customer->fetch_assoc()) {
				$option .= '<option value="'.$data["client_id"].'"> '.$data["client_name"].'</option>';
			}
			
		}
		die(json_encode($option));

	}
}

?>