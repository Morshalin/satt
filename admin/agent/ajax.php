<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

// if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
// 	$agent_id = $_GET['agent_id'];
// 	if ($agent_id) {

// 	$query = "SELECT * FROM developer WHERE id = '$developer_id'";
// 	$result = $db->select($query);
// 	if ($result) {
// 	$img = $result->fetch_assoc()['image'];
// 	}

// 	$error = array();
// 	$name = $fm->validation($_POST['name']);
// 	$email = $fm->validation($_POST['email']);
// 	$mobile_no = $fm->validation($_POST['mobile_no']);
// 	$address = $fm->validation($_POST['address']);
// 	$bio = $fm->validation($_POST['bio']);
// 	$facebook = $fm->validation($_POST['facebook']);
// 	$twitter = $fm->validation($_POST['twitter']);
// 	$linkedin = $fm->validation($_POST['linkedin']);
// 	$instagram = $fm->validation($_POST['instagram']);


// 	$image = $_FILES['image'];
//     $file_name = $image['name'];
//     $file_size = $image['size'];
//     $file_temp = $image['tmp_name'];
//     $div = explode(".", $file_name);
//     $file_extension = strtolower(end($div));
//     $unique_image = md5(time()); 
//     $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
//     $uploaded_image = 'image/'.$unique_image;

// 	$courseCheck = $fm->dublicateCheck('developer', 'email', $email);
// 	$courseCheck = $fm->dublicateCheck('developer', 'mobile_no', $mobile_no);

// 		if (isset($_POST['status'])) {
// 			$status = 1;
// 		} else {
// 			$status = 0;
// 		}

// 	if (!$name) {
// 		$error['name'] = 'Developer Name Field required';
// 	}elseif (strlen($name) > 255) {
// 		$error['name'] = 'Developer Name Can Not Be More Than 255 Charecters';
// 	}

// 	if (!$email) {
// 		$error['email'] = 'Email Field required';
// 	}elseif (strlen($email) > 255) {
// 		$error['email'] = 'Email Can Not Be More Than 255 Charecters';
// 	}

// 	if (!$mobile_no) {
// 		$error['mobile_no'] = 'Mobile No Field required';
// 	}

// 		if ($error) {
// 			http_response_code(500);
// 			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
// 		} else {
// 			$query = "UPDATE developer SET 
// 			name = '$name',
// 			email = '$email',
// 			mobile_no = '$mobile_no',
// 			address = '$address',
// 			bio = '$bio',
// 			facebook = '$facebook',
// 			twitter = '$twitter',
// 			linkedin = '$linkedin',
// 			instagram = '$instagram',
// 			 status = '$status' WHERE id='$developer_id'";
// 			$result = $db->update($query);
// 			$update = "";

// 			if ($result) {
// 				if ($file_name) {
// 					if ($img) {
// 						unlink($img);
// 					}
// 					if (move_uploaded_file($file_temp, $uploaded_image)) {
// 						$query = "UPDATE developer SET image = '$uploaded_image' where id = '$developer_id'";
// 						$update = $db->update($query);
// 					}
// 				}else{
// 					die(json_encode(['message' => 'Developer Updated Successfull']));
// 				}
				
// 				if ($update) {
// 					die(json_encode(['message' => 'Developer Updated Successfull']));
// 				}else{
// 					http_response_code(500);
// 					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
// 				}
// 			}
// 		}
// 	}
// 	http_response_code(500);
// 	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
// }
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$agent_id = $_POST['agent_id'];
	$software = $_POST['software_id'];
	

	$customer = $_POST['customer_id'];

	if (!$software) {
		$error['software_id'] = 'Software Field required';
	}

	if (!$customer) {
		$error['customer_id'] = 'Customer Field required';
	}


	
	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$customer1 = explode(',', $customer);
		$customer_id = $customer1[0];
		$customer_name = $customer1[1];
		$software1 = explode(',', $software);
		$software_id = $software1[0];
		$software_name = $software1[1];
			// move_uploaded_file($file_temp, $uploaded_image);	

			$query = "INSERT INTO agent_selling_product_list (agent_id, software_id, software_name, client_id, client_name) VALUES ('$agent_id','$software_id','$software_name', '$customer_id', '$customer_name')";

			$result = $db->insert($query);
			if ($result != false) {
				die(json_encode(['message' => 'Software Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$get_agent = $db->select($query)->fetch_assoc();

		if ($get_agent['photo']) {
			unlink('../../agent/'.$get_agent['photo']);
		}
		if ($get_agent['document_front']) {
			unlink('../../agent/'.$get_agent['document_front']);
		}
		if ($get_agent['document_back']) {
			unlink('../../agent/'.$get_agent['document_back']);
		}
		if ($get_agent['tread_license']) {
			unlink('../../agent/'.$get_agent['tread_license']);
		}
		$query = "DELETE FROM agent_list WHERE id = '$agent_id'";
		$result = $db->delete($query);
		if ($result) {

			$query = "DELETE FROM agent_selling_product_list WHERE agent_id = '$agent_id'";
			$delete_product = $db->delete($query);


			$query = "DELETE FROM agent_client WHERE agent_id = '$agent_id'";
			$delete_client = $db->delete($query);


			$query = "DELETE FROM agent_note WHERE agent_id = '$agent_id'";
			$delete_note = $db->delete($query);

			$query = "DELETE FROM agent_contact WHERE agent_id = '$agent_id'";
			$delete_contact = $db->delete($query);

			die(json_encode(['message' => 'agent Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



