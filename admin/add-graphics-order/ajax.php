<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/add-graphics-order', 'add-graphics-order');
// if (isset($_GET['promote_product_id'])) {
// 	$promote_product_id = $_GET['promote_product_id'];
// 	if ($promote_product_id) {
// 		$query = "SELECT * FROM promote_product WHERE id = '$promote_product_id'";
// 		$result = $db->select($query);
// 		if (!$result) {
// 			http_response_code(500);
// 			die(json_encode(['message' => 'Promote Products Not Found']));
// 		}
// 	}
// }

/*================================================================
		Insert Data into Database
		===================================================================*/
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$error = array();

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


				
				$query = "INSERT INTO graphics_info 
						(client_name, mobile_no, facebook_link, shipping_address, currier_name, product_name, order_date, qty, probable_delivery_date, price, advance, printing_cost, currier_cost, others_cost, status, notes, order_taken_by) 
						VALUES 
						('$client_name','$mobile_no','$facebook_link','$shipping_address','$currier_name','$product_name','$order_date','$qty','$probable_delivery_date','$price','$advance','$printing_cost','$currier_cost','$others_cost','$order_status','$notes','$order_taken_by')";

				$order_id = $db->custom_insert($query);
				if ($order_id) {
				
					$query  = "INSERT INTO graphics_pay 
						(order_id, pay, payment_method, tx_id_account_no, received_mobile_no, received_by	) 
						VALUES 
						('$order_id', '$advance', '$payment_method', '$tx_id_account_no', '$received_mobile_no', '$order_taken_by')";
					$insert_pay = $db->insert($query);


					if ($file_name) {
						if (move_uploaded_file($file_temp, $uploaded_image)) {
							$query1 = "UPDATE graphics_info SET demo_photo = '$uploaded_image' where id = '$order_id'";
							$update1 = $db->update($query1);
						}
					}

					if ($insert_pay) {
						die(json_encode(['message' => 'Order Taken Successfully']));
					}else{
						die(json_encode(['errors' => $error, 'message' => 'Order Added But Pay History Not Added']));
					}
					
					

				} else {
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
	} //else end
} 

