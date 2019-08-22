<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/developer', 'Developer');
if (isset($_GET['developer_id'])) {
	$developer_id = $_GET['developer_id'];
	if ($developer_id) {
		$query = "SELECT * FROM developer WHERE id = '$developer_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Developer Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$developer_id = $_GET['developer_id'];
	if ($developer_id) {

	$query = "SELECT * FROM developer WHERE id = '$developer_id'";
	$result = $db->select($query);
	if ($result) {
	$img = $result->fetch_assoc()['image'];
	}

	$error = array();
	$name = $fm->validation($_POST['name']);
	$email = $fm->validation($_POST['email']);
	$mobile_no = $fm->validation($_POST['mobile_no']);
	$address = $fm->validation($_POST['address']);
	$bio = $fm->validation($_POST['bio']);
	$facebook = $fm->validation($_POST['facebook']);
	$twitter = $fm->validation($_POST['twitter']);
	$linkedin = $fm->validation($_POST['linkedin']);
	$instagram = $fm->validation($_POST['instagram']);

	$courseCheck = $fm->dublicateCheck('developer', 'email', $email);
	$courseCheck = $fm->dublicateCheck('developer', 'mobile_no', $mobile_no);

	$image = $_FILES['image'];
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_temp = $image['tmp_name'];
    $div = explode(".", $file_name);
    $file_extension = strtolower(end($div));
    $unique_image = md5(time()); 
    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
    $uploaded_image = 'image/'.$unique_image;



		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

	if (!$name) {
		$error['name'] = 'Developer Name Field required';
	}elseif (strlen($name) > 255) {
		$error['name'] = 'Developer Name Can Not Be More Than 255 Charecters';
	}

	if (!$email) {
		$error['email'] = 'Email Field required';
	}elseif (strlen($email) > 255) {
		$error['email'] = 'Email Can Not Be More Than 255 Charecters';
	}

	if (!$mobile_no) {
		$error['mobile_no'] = 'Mobile No Field required';
	}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE developer SET 
			name = '$name',
			email = '$email',
			mobile_no = '$mobile_no',
			address = '$address',
			bio = '$bio',
			facebook = '$facebook',
			twitter = '$twitter',
			linkedin = '$linkedin',
			instagram = '$instagram',
			 status = '$status' WHERE id='$developer_id'";
			$result = $db->update($query);
			$update = "";

			if ($result) {
				if ($file_name) {
					if ($img) {
						unlink($img);
					}
					if (move_uploaded_file($file_temp, $uploaded_image)) {
						$query = "UPDATE developer SET image = '$uploaded_image' where id = '$developer_id'";
						$update = $db->update($query);
					}
				}else{
					die(json_encode(['message' => 'Developer Updated Successfull']));
				}
				
				if ($update) {
					die(json_encode(['message' => 'Developer Updated Successfull']));
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
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	$name = $fm->validation($_POST['name']);
	$email = $fm->validation($_POST['email']);
	$mobile_no = $fm->validation($_POST['mobile_no']);
	$address = $fm->validation($_POST['address']);
	$bio = $fm->validation($_POST['bio']);
	$facebook = $fm->validation($_POST['facebook']);
	$twitter = $fm->validation($_POST['twitter']);
	$linkedin = $fm->validation($_POST['linkedin']);
	$instagram = $fm->validation($_POST['instagram']);


	$image = $_FILES['image'];
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_temp = $image['tmp_name'];
    $div = explode(".", $file_name);
    $file_extension = strtolower(end($div));
    $unique_image = md5(time()); 
    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
    $uploaded_image = 'image/'.$unique_image;

	$courseCheck = $fm->dublicateCheck('developer', 'email', $email);
	$courseCheck = $fm->dublicateCheck('developer', 'mobile_no', $mobile_no);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$name) {
		$error['name'] = 'Developer Name Field required';
	}elseif (strlen($name) > 255) {
		$error['name'] = 'Developer Name Can Not Be More Than 255 Charecters';
	}

	if (!$email) {
		$error['email'] = 'Email Field required';
	} elseif ($courseCheck) {
		$error['email'] = 'Email Already Exits';
	} elseif (strlen($email) > 255) {
		$error['email'] = 'Email Can Not Be More Than 255 Charecters';
	}

	if (!$mobile_no) {
		$error['mobile_no'] = 'Mobile No Field required';
	} elseif ($courseCheck) {
		$error['mobile_no'] = 'Mobile No Already Exits';
	} elseif (strlen($mobile_no) > 255) {
		$error['mobile_no'] = 'Mobile No Can Not Be More Than 255 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		move_uploaded_file($file_temp, $uploaded_image);	

		$query = "INSERT INTO developer (name, email, mobile_no, image, address, bio, facebook, twitter, linkedin, instagram, status) VALUES ('$name','$email','$mobile_no', '$uploaded_image', '$address','$bio','$facebook','$twitter','$linkedin', '$instagram', '$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Developer Added Successfull']));
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
	$developer_id = $_GET['developer_id'];
	if ($developer_id) {
		$query = "DELETE FROM developer WHERE id = '$developer_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Developer Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$developer_id = $_GET['developer_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($developer_id) {
		$query = "UPDATE developer SET status = '$status' WHERE id = '$developer_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'developer Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
