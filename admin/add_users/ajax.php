<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/add_users', 'Add Users');
if (isset($_GET['users_id'])) {
	$users_id = $_GET['users_id'];
	if ($users_id) {
		$query = "SELECT * FROM users WHERE id = '$users_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'users Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$users_id = $_GET['users_id'];
	if ($users_id) {

	$query = "SELECT * FROM users WHERE id = '$users_id'";
	$result = $db->select($query);
	if ($result) {
	$img = $result->fetch_assoc()['image'];
	}

	$error = array();

	$id_number = $fm->validation($_POST['id_number']);
	$name = $fm->validation($_POST['name']);
	$email = $fm->validation($_POST['email']);
	$mobile_no = $fm->validation($_POST['mobile_no']);
	$address = $fm->validation($_POST['address']);
	$designation = $fm->validation($_POST['designation']);
	$facebook = $fm->validation($_POST['facebook']);
	$user_name	 = $fm->validation($_POST['user_name']);
	$password = $fm->validation($_POST['password']);
	$confirm_password = $fm->validation($_POST['confirm_password']);

	$query = "SELECT * FROM users where id <> '$users_id'";
	$result2 = $db->select($query);

	if ($result2) {
		while ($data = $result2->fetch_assoc()) {
			if ($email==$data['email']) {
				$error['email'] = 'Email Already exits.';
			}
			if ($id_number == $data['id_number']) {
				$error['id_number'] = 'ID Number Already exits.';
			}if ($mobile_no == $data['mobile_no']) {
				$error['mobile_no'] = 'Mobile Number Already exits.';
			}
			if ($user_name == $data['user_name']) {
				$error['user_name'] = 'User Name Already exits.';
			}
		}
	}

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

	if ($password != $confirm_password) {
		$error['name'] = 'Password and Confirm PasswordNot Match';
	}

	if (!$name) {
		$error['name'] = 'users Name Field required';
	}elseif (strlen($name) > 255) {
		$error['name'] = 'users Name Can Not Be More Than 255 Charecters';
	}

	if (!$email) {
		$error['email'] = 'Email Field required';
	}elseif (strlen($email) > 255) {
		$error['email'] = 'Email Can Not Be More Than 255 Charecters';
	}

	if (!$mobile_no) {
		$error['mobile_no'] = 'Mobile No Field required';
	}

	if (!$user_name) {
		$error['user_name'] = 'User Name Field required';
	} elseif (strlen($user_name) > 255) {
		$error['user_name'] = 'User Name Can Not Be More Than 255 Charecters';
	}
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE users SET 
			id_number = '$id_number',
			name = '$name',
			email = '$email',
			mobile_no = '$mobile_no',
			address = '$address',
			designation = '$designation',
			facebook = '$facebook',
			user_name = '$user_name',
			password = '$password',
			status = '$status'
			WHERE id ='$users_id'";
			$result = $db->update($query);
			$update = "";

			if ($result) {
				if ($file_name) {
					if ($img) {
						unlink($img);
					}
					if (move_uploaded_file($file_temp, $uploaded_image)) {
						$query = "UPDATE users SET image = '$uploaded_image' where id = '$users_id'";
						$update = $db->update($query);
					}
				}else{
					die(json_encode(['message' => 'users Updated Successfull']));
				}
				
				if ($update) {
					die(json_encode(['message' => 'users Updated Successfull']));
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

	$id_number = $fm->validation($_POST['id_number']);
	$name = $fm->validation($_POST['name']);
	$email = $fm->validation($_POST['email']);
	$mobile_no = $fm->validation($_POST['mobile_no']);
	$address = $fm->validation($_POST['address']);
	$designation = $fm->validation($_POST['designation']);
	$facebook = $fm->validation($_POST['facebook']);
	$user_name	 = $fm->validation($_POST['user_name']);
	$password = $fm->validation($_POST['password']);
	$confirm_password = $fm->validation($_POST['confirm_password']);

	$image = $_FILES['image'];
	    $file_name = $image['name'];
	    $file_size = $image['size'];
	    $file_temp = $image['tmp_name'];
	    $div = explode(".", $file_name);
	    $file_extension = strtolower(end($div));
	    $unique_image = md5(time()); 
	    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
	    $uploaded_image = 'image/'.$unique_image;

		$email_Check = $fm->dublicateCheck('users', 'email', $email);
		$mobile_no_Check = $fm->dublicateCheck('users', 'mobile_no', $mobile_no);
		$user_name_Check = $fm->dublicateCheck('users', 'user_name', $user_name);
		$satt_user_name_Check = $fm->dublicateCheck('satt_users', 'user_name', $user_name);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if ($password != $confirm_password) {
			$error['name'] = 'Password and Confirm PasswordNot Match';
		}

		if (!$name) {
			$error['name'] = 'Name Field required';
		}elseif (strlen($name) > 255) {
			$error['name'] = 'Name Can Not Be More Than 255 Charecters';
		}

		if (!$email) {
			$error['email'] = 'Email Field required';
		} elseif ($email_Check) {
			$error['email'] = 'Email Already Exits';
		} elseif (strlen($email) > 255) {
			$error['email'] = 'Email Can Not Be More Than 255 Charecters';
		}

		if (!$mobile_no) {
			$error['mobile_no'] = 'Mobile No Field required';
		} elseif ($mobile_no_Check) {
			$error['mobile_no'] = 'Mobile No Already Exits';
		} elseif (strlen($mobile_no) > 255) {
			$error['mobile_no'] = 'Mobile No Can Not Be More Than 255 Charecters';
		}

		if (!$user_name) {
			$error['user_name'] = 'User Name Field required';
		} elseif ($user_name_Check) {
			$error['user_name'] = 'User Name Already Exits';
		} elseif (strlen($user_name) > 255) {
			$error['user_name'] = 'User Name Can Not Be More Than 255 Charecters';
		}
		if($satt_user_name_Check){
			$error['user_name'] = 'User Name Already Exits';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			move_uploaded_file($file_temp, $uploaded_image);
		$query = "INSERT INTO users (id_number, name, email, mobile_no, image, address, designation, facebook, user_name, password, status,created_at) VALUES ('$id_number','$name','$email','$mobile_no', '$uploaded_image', '$address','$designation','$facebook','$user_name','$password','$status',now())";
		$last_id = $db->custom_insert($query);
		if ($last_id != false) {
			$password = md5($password);
			$query = "INSERT INTO satt_users(user_name, email,password, created_at, systems_user_id, from_table, status,role) VALUES ('$user_name','$email','$password',now(),'$last_id','users', 'active','admin')";
			$last_id_no = $db->custom_insert($query);
			if($last_id_no){
				$query = "UPDATE users SET 
				user_id = '$last_id_no' 
				where id ='$last_id'";
				$db->update($query);
			}

			die(json_encode(['message' => 'User Added Successfull']));
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
	$users_id = $_GET['users_id'];
	if ($users_id) {
		$query = "DELETE FROM users WHERE id = '$users_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'users Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$users_id = $_GET['users_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($users_id) {
		$query = "UPDATE users SET status = '$status' WHERE id = '$users_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'users Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
