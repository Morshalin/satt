<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/new_orders', 'Order New Software');

/*================================================================
		Insert Data into Database
		===================================================================*/
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$error = array();

			$customer_id = $_POST['customer_id'];
			$query = "SELECT * FROM satt_customer_informations WHERE id = '$customer_id'";
			$get_customer = $db->select($query);
			if ($get_customer) {
				$customer = $get_customer->fetch_assoc();
				$customer_name = $customer['name'];
				$customer_phn = $customer['number'];
			}
			$expected_name_software = $fm->validation($_POST['expected_name_software']);
			$documentation_note = $fm->validation($_POST['documentation_note']);
			// $file_upload_documentation = $fm->validation($_POST['file_upload_documentation']);

			if (!$expected_name_software) {
				$error['expected_name_software'] = 'Expected Name Field required';
			}
			if (!$documentation_note) {
				$error['documentation_note'] = 'End Date Field required';
			}



			$documentation_file = $_FILES['file_upload_documentation'];
			$file_name = $documentation_file['name'];
			$file_size = $documentation_file['size'];
			$file_temp = $documentation_file['tmp_name'];

			$div = explode(".", $file_name);
			$file_extension = strtolower(end($div));
			$unique_file = md5(time()); 
			$unique_file= "feature-".substr($unique_file, 0,10).'.'.$file_extension;
			$uploaded_file = 'software_feature/'.$unique_file;

			$permitted = array('jpg','png','gif','jpeg','txt','doc','docx','ppt','pptx','csv','xls','xlsx','zip','rar','pdf');
			if ($file_name) {
				
				if (!in_array($file_extension, $permitted)) {
					$message = "File Formate Must Be :".implode(", ", $permitted);
					$title = "error";
					echo json_encode(['message'=>$message,'title'=>$title]);
					die();
				}
			}




			if ($error) {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			} else {

				$query = "SELECT * FROM agent_client WHERE client_id = '$customer_id'";
				$get_agent = $db->select($query);
				if ($get_agent) {
					$agent = $get_agent->fetch_assoc();
					$agent_id = $agent['agent_id'];
					$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
					$get_agent_details = $db->select($query)->fetch_assoc();
					$agent_name = $get_agent_details['name'];
					$agent_phn = $get_agent_details['mobile_no'];
				}else{
					$agent_id = '';
					$agent_name = '';
					$agent_phn = '';
				}

				$query = "INSERT INTO new_product_order(customer_id,customer_name,customer_phn,agent_id,agent_name,agent_phn,documentation_note,expected_name_software, order_date) VALUES ('$customer_id','$customer_name','$customer_phn','$agent_id','$agent_name','$agent_phn','$documentation_note','$expected_name_software', now())";

				$last_id = $db->custom_insert($query);
				if ($last_id) {
			// multi Language insert

					if ($file_name) {
						if (move_uploaded_file($file_temp, '../../uploads/'.$uploaded_file)) {
							$query  = "UPDATE new_product_order SET file_upload_documentation = '$uploaded_file' WHERE id = '$last_id'";
							$update_tbl = $db->update($query);
						}
					}
					

					die(json_encode(['message' => 'Order Taken Successfully']));

				} else {
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
	} //else end
} 

/*================================================================
		Delate  Data into Database
		===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
		// if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
		// 	$promote_product_id = $_GET['promote_product_id'];
		// 	if ($promote_product_id) {
		// 		$query = "DELETE FROM promote_product WHERE id = '$promote_product_id'";
		// 		$result = $db->delete($query);
		// 		$query1 = "DELETE FROM promote_product_multi WHERE promote_product_id = '$promote_product_id'";
		// 		$result1 = $db->delete($query1);
		// 		if ($result) {
		// 			die(json_encode(['message' => 'Promote Products Deleted Successfull']));
		// 		}
		// 	}
		// 	http_response_code(500);
		// 	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
		// }



		// if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
		// 	$promote_product_id = $_GET['promote_product_id'];
		// 	$status = $_GET['status'];
		// 	$status = $status ? 0 : 1;

		// 	if ($promote_product_id) {
		// 		$query = "UPDATE promote_product SET status = '$status' WHERE id = '$promote_product_id'";
		// 		$result = $db->delete($query);
		// 		if ($result) {
		// 			die(json_encode(['message' => 'Software Language Status Changed Successfull']));
		// 		}
		// 	}
		// 	http_response_code(500);
		// 	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

		// }
