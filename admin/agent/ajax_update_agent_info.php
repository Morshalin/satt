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
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {

	$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
	$result = $db->select($query);
	

	// $error = array();
	// $status = $fm->validation($_POST['status']);
	// $level = $fm->validation($_POST['level']);


	$photo = $_FILES['photo'];
    $file_name_photo = $photo['name'];
    $file_size_photo = $photo['size'];
    $file_temp_photo = $photo['tmp_name'];
    $div_photo = explode(".", $file_name_photo);
    $file_extension_photo = strtolower(end($div_photo));
    $unique_image_photo = md5(time()); 
    $unique_image_photo= "img-".substr($unique_image_photo, 0,10).'.'.$file_extension_photo;
    $uploaded_image_photo = 'images/'.$unique_image_photo;
	
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $occupation = $_POST['occupation'];
    $education_qualification = $_POST['education_qualification'];
    $permanent_house = $_POST['permanent_house'];
    $permanent_road = $_POST['permanent_road'];
    $permanent_village = $_POST['permanent_village'];
    $permanent_post = $_POST['permanent_post'];
    $permanent_up = $_POST['permanent_up'];
    $permanent_dist = $_POST['permanent_dist'];
    $permanent_post_code = $_POST['permanent_post_code'];

    if (isset($_POST['same_as'])) {
    	$same_as = '1';
    }else{
    	$same_as = '0';
    }
    
    $present_house = $_POST['present_house'];
    $present_road = $_POST['present_road'];
    $present_village = $_POST['present_village'];
    $present_post = $_POST['present_post'];
    $present_up = $_POST['present_up'];
    $present_dist = $_POST['present_dist'];
    $present_post_code = $_POST['present_post_code'];

    $mobile_no = $_POST['mobile_no'];
    $alternate_mobile = $_POST['alternate_mobile'];
    $email = $_POST['email'];
    $interested_dist = $_POST['interested_dist'];
    $interested_up = $_POST['interested_up'];

    $document_type = $_POST['document_type'];

	// Document front image 
    $document_front = $_FILES['document_front'];
    $file_name_doc_front = $document_front['name'];
    $file_size_doc_front = $document_front['size'];
    $file_temp_doc_front = $document_front['tmp_name'];
    $div_doc_front = explode(".", $file_name_doc_front);
    $file_extension_doc_front = strtolower(end($div_doc_front));
    $unique_image_doc_front = md5(time()); 
    $unique_image_doc_front= "front-".substr($unique_image_doc_front, 0,10).'.'.$file_extension_doc_front;
    $uploaded_image_doc_front = 'document_image/'.$unique_image_doc_front;

    // Back side image of Document
    $document_back = $_FILES['document_back'];
    $file_name_doc_back = $document_back['name'];
    $file_size_doc_back = $document_back['size'];
    $file_temp_doc_back = $document_back['tmp_name'];
    $div_doc_back = explode(".", $file_name_doc_back);
    $file_extension_doc_back = strtolower(end($div_doc_back));
    $unique_image_doc_back = md5(time()); 
    $unique_image_doc_back= 'back-'.substr($unique_image_doc_back, 0,10).'.'.$file_extension_doc_back;
    $uploaded_image_doc_back = 'document_image/'.$unique_image_doc_back;

    $bussiness_name = $_POST['bussiness_name'];

     // image of Trade License
    $tread_license = $_FILES['tread_license'];
    $file_name_trade = $tread_license['name'];
    $file_size_trade = $tread_license['size'];
    $file_temp_trade = $tread_license['tmp_name'];
    $div_trade = explode(".", $file_name_trade);
    $file_extension_trade = strtolower(end($div_trade));
    $unique_image_trade = md5(time()); 
    $unique_image_trade= 'trade'.substr($unique_image_trade, 0,10).'.'.$file_extension_trade;
    $uploaded_image_trade = 'trade_license_image/'.$unique_image_trade;

    $signature = $_POST['signature'];





    // if ($file_name_photo) {
	    
    // }
    // if ($file_name_doc_front) {

    // }
    // if ($file_name_doc_back) {
	    
    // }
    // if ($file_name_trade) {
	    

    // }


   






































	
	if (!$status) {
		$error['status'] = 'status Field required';
	}

	if (!$level && $status == 'Promoted') {
		$error['level'] = 'Level Field required';
	}



		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {

			$query = "UPDATE agent_list SET 
			status = '$status',
			level = '$level'
			 WHERE id='$agent_id'";
			$result = $db->update($query);
			// $update = "";

					die(json_encode(['message' => 'Developer Updated Successfull']));
				
				if ($update) {
					die(json_encode(['message' => 'Developer Updated Successfull']));
				}else{
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
		}
	}else{
		http_response_code(500);
	die(json_encode(['message' => 'Agent Not Found']));
	}
	
}






