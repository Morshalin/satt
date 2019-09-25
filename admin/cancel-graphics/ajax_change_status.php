<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL.'/cancel-graphics', 'Cancel Graphics Order');
if (isset($_GET['change_order_id'])) {
	$change_order_id = $_GET['change_order_id'];
	if ($change_order_id) {
		$query = "SELECT * FROM graphics_info WHERE id = '$change_order_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Graphics Order Not Found']));
		}
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$change_order_id = $_GET['change_order_id'];
	if ($change_order_id) {
		$error = array();
		$order_status = $fm->validation($_POST['order_status']);

		$image = $_FILES['photo'];
	    $file_name = $image['name'];
	    $file_size = $image['size'];
	    $file_temp = $image['tmp_name'];
	    $div = explode(".", $file_name);
	    $file_extension = strtolower(end($div));
	    $unique_image = md5(time()); 
	    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
	    $uploaded_image = '../image/'.$unique_image;

if ($file_name) {
	if (!$order_status) {
			$error['order_status'] = 'Order Status Field required';
		}elseif(!$file_name){
			$error['photo'] = 'Photo Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				if (move_uploaded_file($file_temp, $uploaded_image)) {
					$query1 = "UPDATE graphics_info SET image = '$uploaded_image' where id = '$change_order_id'";
					$update1 = $db->update($query1);
				}
				$query = "UPDATE graphics_info SET status = '$order_status' WHERE id = '$change_order_id' ";
				$update = $db->update($query);
			if ($update != false) {
				die(json_encode(['message' => ' Status Changed Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
}elseif($order_status == 'Delivered'){

		if (!$order_status) {
			$error['order_status'] = 'Order Status Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query = "UPDATE graphics_info SET status = '$order_status' , delivery_date = now() WHERE id = '$change_order_id' ";
				$update = $db->update($query);
			if ($update != false) {
				die(json_encode(['message' => ' Status Changed Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}else{
		if (!$order_status) {
			$error['order_status'] = 'Order Status Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query = "UPDATE graphics_info SET status = '$order_status' WHERE id = '$change_order_id' ";
				$update = $db->update($query);
			if ($update != false) {
				die(json_encode(['message' => ' Status Changed Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

