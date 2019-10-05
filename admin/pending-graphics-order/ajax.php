<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/pending-graphics-order', 'Pending Graphics Order');
if (isset($_GET['change_order_id'])) {
	$change_order_id = $_GET['change_order_id'];
	if ($change_order_id) {
		$query = "SELECT * FROM graphics_info WHERE id = '$change_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Graphics Order Not Found']));
		}
	}else{
		$result = $result->fetch_assoc();
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$error = array();
	$order_id = $_GET['order_id'];
	if ($order_id) {

			$client_name = $fm->validation($_POST['client_name']);
			$mobile_no = $fm->validation($_POST['mobile_no']);
			$facebook_link = $fm->validation($_POST['facebook_link']);
			$shipping_address = $fm->validation($_POST['shipping_address']);
			$currier_name = $fm->validation($_POST['currier_name']);
			$product_name = $fm->validation($_POST['product_name']);
			$order_date = $fm->validation($_POST['order_date']);
			$qty = $fm->validation($_POST['qty']);
			$probable_delivery_date = $fm->validation($_POST['probable_delivery_date']);
			$price = $fm->validation($_POST['price']);
			$advance = $fm->validation($_POST['advance']);
			$printing_cost = $fm->validation($_POST['printing_cost']);

			$image = $_FILES['demo_photo'];
		    $file_name = $image['name'];
		    $file_size = $image['size'];
		    $file_temp = $image['tmp_name'];
		    $div = explode(".", $file_name);
		    $file_extension = strtolower(end($div));
		    $unique_image = md5(time()); 
		    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
		    $uploaded_image = '../image/'.$unique_image;


			if ($printing_cost == "") {
				$printing_cost = 0;
			}
			$currier_cost = $fm->validation($_POST['currier_cost']);
			if ($currier_cost == "") {
				$currier_cost = 0;
			}
			$others_cost = $fm->validation($_POST['others_cost']);
			if ($others_cost == "") {
				$others_cost = 0;
			}
			$order_status = $fm->validation($_POST['order_status']);
			$notes = $fm->validation($_POST['notes']);
			$order_taken_by = $fm->validation($_POST['order_taken_by']);
			
			
			$payment_method = $fm->validation($_POST['payment_method']);
			$tx_id_account_no = $fm->validation($_POST['tx_id_account_no']);
			$received_mobile_no = $fm->validation($_POST['received_mobile_no']);


			if ($error) {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			} else {

			$query = "UPDATE graphics_info SET 
			client_name = '$client_name',
			mobile_no = '$mobile_no',
			facebook_link = '$facebook_link',
			shipping_address = '$shipping_address',
			currier_name = '$currier_name',
			product_name = '$product_name',
			order_date = '$order_date',
			probable_delivery_date = '$probable_delivery_date',
			price = '$price',
			advance = '$advance',
			printing_cost = '$printing_cost',
			currier_cost = '$currier_cost',
			others_cost = '$others_cost',
			status = '$order_status',
			notes = '$notes',
			order_taken_by = '$order_taken_by' WHERE id='$order_id'";
			$result = $db->update($query);
			$update = "";

			if ($result) {

				$query1 = "UPDATE graphics_pay SET 
				pay = '$advance',
				payment_method = '$payment_method',
				tx_id_account_no = '$tx_id_account_no',
				received_mobile_no = '$received_mobile_no',
				received_by = '$order_taken_by' WHERE order_id='$order_id' limit 1";
				$result1 = $db->update($query1);
				$update = "";


				if ($file_name) {
					if ($result['demo_photo']) {
						unlink($result['demo_photo']);
					}
					if (move_uploaded_file($file_temp, $uploaded_image)) {
						$query = "UPDATE graphics_info SET demo_photo = '$uploaded_image' where id = '$order_id'";
						$update = $db->update($query);
					}
				}else{
					die(json_encode(['message' => 'Order Updated Successfull']));
				}
				
				if ($update) {
					die(json_encode(['message' => 'Order Updated Successfull']));
				}else{
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
/*================================================================
		Delate  Data from Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$pending_graphics_order_id = $_GET['pending_graphics_order_id'];
	if ($pending_graphics_order_id) {
		$query = "DELETE FROM graphics_info WHERE id = '$pending_graphics_order_id'";
		$result = $db->delete($query);
		if ($result) {
			$query1 = "DELETE FROM graphics_pay WHERE order_id = '$pending_graphics_order_id'";
			$result1 = $db->delete($query1);
			die(json_encode(['message' => 'Order Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

