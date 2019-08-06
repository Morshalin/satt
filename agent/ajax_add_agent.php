<?php 
include_once('../config/config.php');
include_once('../classes/Database.php');
$db = new Database();

if (isset($_POST['submit'])) {

	$photo_size = $_POST['photo_size'];
	$photo = $_FILES['photo'];
	$permitted = array('jpg','png','gif','jpeg');
    $file_name_photo = $photo['name'];
    $file_size_photo = $photo['size'];
    $file_temp_photo = $photo['tmp_name'];
    $div_photo = explode(".", $file_name_photo);
    $file_extension_photo = strtolower(end($div_photo));
    $unique_image_photo = md5(time()); 
    $unique_image_photo= "img-".substr($unique_image_photo, 0,10).'.'.$file_extension_photo;
    $uploaded_image_photo = 'images/'.$unique_image_photo;
    // main image validation
    if ($file_name_photo) {
	    if (!in_array($file_extension_photo, $permitted)) {
	    	$message = "Image Formate Must Be:".implode(", ", $permitted);
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
	    }
		if($photo_size > 1048576) {
		    $message = "Please Make Sure Your Image Size Is Less Than 1 MB";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
		}
    }

	
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

    if (isset( $_POST['terms_agree'])) {
    	$terms_agree = '1';
    }else{
    	$terms_agree = '0';
    }
    $document_type = $_POST['document_type'];

	// Documernt front image 
	$document_front_size = $_POST['document_front_size']; 
    $document_front = $_FILES['document_front'];
	$permitted_doc_front = array('jpg','png','gif','jpeg');
    $file_name_doc_front = $document_front['name'];
    $file_size_doc_front = $document_front['size'];
    $file_temp_doc_front = $document_front['tmp_name'];
    $div_doc_front = explode(".", $file_name_doc_front);
    $file_extension_doc_front = strtolower(end($div_doc_front));
    $unique_image_doc_front = md5(time()); 
    $unique_image_doc_front= "front-".substr($unique_image_doc_front, 0,10).'.'.$file_extension_doc_front;
    $uploaded_image_doc_front = 'document_image/'.$unique_image_doc_front;

    if ($file_name_doc_front) {
	    if (!in_array($file_extension_doc_front, $permitted_doc_front)) {
	    	if ($document_type == 'Passport') {
	    		$message = $document_type."Image Formate Must Be:".implode(", ", $permitted_doc_front);
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    	}else if ($document_type == 'Birth_Certificate') {
	    		$message = "Birth Certificate Image Formate Must Be:".implode(", ", $permitted_doc_front);
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    	}else{
	    		$message = "NID Frontend Image Formate Must Be:".implode(", ", $permitted_doc_front);
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();

	    	}
	    	
	    }else if($document_front_size > 1048576) {
	    	if ($document_type == 'Passport') {
	    		$message = 'Please Make Sure Image Size Of Your Passport Is Less Than 1 MB';
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    	}else if ($document_type == 'Birth_Certificate') {
	    		$message = "Please Make Sure Image Size Of Your Birth Certificate Is Less Than 1 MB";
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    	}else if($document_type == 'NID'){
	    		$message = "Please Make Sure Frontend Image Size Of Your NID Is Less Than 1 MB";
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    	}
		}
    }


    // Back side image of Document
    $document_back_size = '';
    if (isset($_POST['document_back_size'])) {
    	$document_back_size = $_POST['document_back_size'] ; 
    }
    $document_back = $_FILES['document_back'];
	$permitted_doc_back = array('jpg','png','gif','jpeg');
    $file_name_doc_back = $document_back['name'];
    $file_size_doc_back = $document_back['size'];
    $file_temp_doc_back = $document_back['tmp_name'];
    $div_doc_back = explode(".", $file_name_doc_back);
    $file_extension_doc_back = strtolower(end($div_doc_back));
    $unique_image_doc_back = md5(time()); 
    $unique_image_doc_back= 'back-'.substr($unique_image_doc_back, 0,10).'.'.$file_extension_doc_back;
    $uploaded_image_doc_back = 'document_image/'.$unique_image_doc_back;

    if ($file_name_doc_back) {
	    if (!in_array($file_extension_doc_back, $permitted_doc_back)) {
	    		$message = "NID Backend Image Formate Must Be:".implode(", ", $permitted_doc_front);
		    	$title = "error";
		    	echo json_encode(['message'=>$message,'title'=>$title]);
		    	die();
	    }else if($document_back_size > 1048576) {
		    $message = "Please Make Sure Backend Image Size Of Your NID Is Less Than 1 MB";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
		}
    }
    
    $bussiness_name = $_POST['bussiness_name'];

     // image of Trade License
    $tread_license_size = $_POST['tread_license_size'];
    $tread_license = $_FILES['tread_license'];
	$permitted_trade = array('jpg','png','gif','jpeg');
    $file_name_trade = $tread_license['name'];
    $file_size_trade = $tread_license['size'];
    $file_temp_trade = $tread_license['tmp_name'];
    $div_trade = explode(".", $file_name_trade);
    $file_extension_trade = strtolower(end($div_trade));
    $unique_image_trade = md5(time()); 
    $unique_image_trade= 'trade'.substr($unique_image_trade, 0,10).'.'.$file_extension_trade;
    $uploaded_image_trade = 'trade_license_image/'.$unique_image_trade;

    if ($file_name_trade) {
	    if (!in_array($file_extension_trade, $permitted_trade)) {
	    	$message = "Trade License Image Formate Must Be:".implode(", ", $permitted);
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
	    }
		if($tread_license_size > 1048576) {
		    $message = "Please Make Sure Trade License Image Size Is Less Than 1 MB";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
		}
    }


    $signature = $_POST['signature'];
   


    // vlaidating if required fields are filled up or not.
    if (
	    	
	    	empty($name) ||
	    	 empty($father_name) ||
	    	 empty($mother_name) ||
	    	 empty($occupation) ||
	    	 empty($education_qualification) ||
	    	 empty($present_village) ||
	    	 empty($permanent_village) ||
	    	 empty($present_post) ||
	    	 empty($permanent_post) ||
	    	 empty($present_up) ||
	    	 empty($permanent_up) ||
	    	 empty($present_dist) ||
	    	 empty($permanent_dist) ||
	    	 empty($present_post_code) ||
	    	 empty($permanent_post) ||
	    	 empty($mobile_no) ||
	    	 empty($email) ||
	    	 empty($interested_dist) ||
	    	 empty($interested_up) ||
	    	 empty($signature) 
	    	 
 	) {
    	$message = "Please Make Sure All Required Fields Are Filled Up.";
    	$title = "error";
    	echo json_encode(['message'=>$message,'title'=>$title]);
    	die();
    }else if(empty($file_name_photo)){
	    	$message = "Please Upload Your Image.";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();

    }else if($document_type == 'NID'){
    	if (empty($file_name_doc_back)) {
	    	$message = "Please Upload Backend Image Of NID.";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
    	}elseif (empty($file_name_doc_front)) {
	    	$message = "Please Upload Frontend Image Of NID.";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
    	}

    }else if($document_type == 'Birth_Certificate'){
    	if (empty($file_name_doc_front)) {
	    	$message = "Please Upload Birth Certificate Image.";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
    	}

    }else if($document_type == 'Passport'){
    	if (empty($file_name_doc_front)) {
	    	$message = "Please Upload Image Of Your Passport.";
	    	$title = "error";
	    	echo json_encode(['message'=>$message,'title'=>$title]);
	    	die();
    	}

    }

    // now its time to insert data in database 
    $query = "INSERT INTO agent_list 
    			(name,father_name,mother_name,occupation,education_qualification,permanent_house,permanent_road,permanent_village,permanent_post,permanent_up,permanent_dist,permanent_post_code,same_as,present_house,present_road,present_village,present_post,present_up,present_dist,present_post_code,mobile_no,alternate_mobile,email,interested_dist,interested_up,document_type,bussiness_name,terms_agree,signature,created_at,status)

    			VALUES

				('$name','$father_name','$mother_name','$occupation','$education_qualification','$permanent_house','$permanent_road','$permanent_village','$permanent_post','$permanent_up','$permanent_dist','$permanent_post_code','$same_as','$present_house','$present_road','$present_village','$present_post','$present_up','$present_dist','$present_post_code','$mobile_no','$alternate_mobile','$email','$interested_dist','$interested_up','$document_type','$bussiness_name','$terms_agree','$signature',now(),'Registered')";

    $last_insert_id = $db->custom_insert($query);

    if ($last_insert_id) {
    	$upload_img = '';
    	if (move_uploaded_file($file_temp_photo, $uploaded_image_photo)) {
    		$query = "UPDATE agent_list SET photo = '$uploaded_image_photo' WHERE id = '$last_insert_id'";
    		$upload_img = $db->update($query);
    		if ($upload_img) {
    			if (move_uploaded_file($file_temp_doc_front, $uploaded_image_doc_front)) {
    				$query = "UPDATE agent_list SET document_front = '$uploaded_image_doc_front' WHERE id = '$last_insert_id'";
    				$upload_frontend = $db->update($query);
    			}
    			if ($upload_frontend) {
    				if ($file_name_doc_back) {
		    			if (move_uploaded_file($file_temp_doc_back, $uploaded_image_doc_back)) {
		    				$query = "UPDATE agent_list SET document_back = '$uploaded_image_doc_back' WHERE id = '$last_insert_id'";
		    				$upload_back = $db->update($query);
		    			}
    				}
    				if ($file_name_trade) {
		    			if (move_uploaded_file($file_temp_trade, $uploaded_image_trade)) {
		    				$query = "UPDATE agent_list SET tread_license = '$uploaded_image_trade' WHERE id = '$last_insert_id'";
		    				$upload_trade = $db->update($query);
		    			}
    				}

    				$message = "Congratulations! Your Application Is Submitted Successfully";
			    	$title = "success";
			    	echo json_encode(['message'=>$message,'title'=>$title]);
			    	die();
    			}
    		}
    	}
    }else{
    	$message = "Sorry Failed To Save Information.";
    	$title = "error";
    	echo json_encode(['message'=>$message,'title'=>$title]);
    	die();

    }





}
?>