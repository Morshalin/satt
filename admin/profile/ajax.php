<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/profile', 'Admin Profile');
if (isset($_GET['$user_id'])) {
	$user_id = $_GET['$user_id'];
	if ($user_id) {
		$query = "SELECT * FROM satt_admins WHERE id = '$user_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Admin Not Found']));
		}
	}
}
/*================================================================
	Update data into database
	===================================================================*/

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user_id = $_GET['user_id'];
		if ($user_id) {

			$query = "SELECT * FROM satt_admins WHERE id = '$user_id'";
			$result = $db->select($query);
			if ($result) {
				$img = $result->fetch_assoc()['image'];
			}

			$error = array();
			$admin_user_id = $fm->validation($_POST['admin_user_id']);
			$user_query = "SELECT * FROM satt_users WHERE id = '$admin_user_id'";
			$user_result = $db->select($user_query);
			if ($user_result) {
				$password = $user_result->fetch_assoc()['password'];
			}

			$old_pass = $fm->validation(md5($_POST['old_pass']));
			$new_pass = $_POST['new_pass'];
			$new_pass2 = $fm->validation(md5($_POST['new_pass']));
			$first_name = $fm->validation($_POST['first_name']);
			$last_name = $fm->validation($_POST['last_name']);
			$user_name = $fm->validation($_POST['user_name']);
			$email = $fm->validation($_POST['email']);
			$mobile_no = $fm->validation($_POST['mobile_no']);
			$alternate_mobile_no = $fm->validation($_POST['alternate_mobile_no']);
			$bio = $fm->validation($_POST['bio']);

			$courseCheck = $fm->dublicateCheck('satt_users', 'user_name', $user_name);
			$courseCheck = $fm->dublicateCheck('satt_users', 'email', $email);
			$courseCheck = $fm->dublicateCheck('satt_admins', 'mobile_no', $mobile_no);

			$image = $_FILES['image'];
			$file_name = $image['name'];
			$file_size = $image['size'];
			$file_temp = $image['tmp_name'];
			$div = explode(".", $file_name);
			$file_extension = strtolower(end($div));
			$unique_image = md5(time()); 
			$unique_image= substr($unique_image, 0,10).'.'.$file_extension;
			$uploaded_image = 'image/'.$unique_image;


			$query = "SELECT * FROM satt_users WHERE id <> '$admin_user_id'";
			$get_user =$db->select($query);
			$matched = true;
			if ($get_user) {
				while ($user_row = $get_user->fetch_assoc()) {
					$user_name_old = $user_row['user_name'];

					if ($user_name_old == $user_name) {
						$matched = false;
						break;
					}

				}
			}

			if (!$matched) {
				$error['user_name'] = 'User Name Exists. Try another Name';
			}

			if (!$first_name) {
				$error['first_name'] = 'First Name Field required';
			}elseif (strlen($first_name) > 255) {
				$error['first_name'] = 'First Name Can Not Be More Than 255 Charecters';
			}
			if (!$last_name) {
				$error['last_name'] = 'Last Name Field required';
			}elseif (strlen($last_name) > 255) {
				$error['last_name'] = 'Last Name Can Not Be More Than 255 Charecters';
			}

			if (!$user_name) {
				$error['user_name'] = 'User Name Field required';
			}elseif (strlen($user_name) > 255) {
				$error['user_name'] = 'User Name Can Not Be More Than 255 Charecters';
			}

			if (!$email) {
				$error['email'] = 'Email Field required';
			}elseif (strlen($email) > 255) {
				$error['email'] = 'Email Can Not Be More Than 255 Charecters';
			}

			if (!$mobile_no) {
				$error['mobile_no'] = 'Mobile Number Field required';
			}elseif (strlen($mobile_no) > 255) {
				$error['mobile_no'] = 'Mobile Number Can Not Be More Than 255 Charecters';
			}


			if ($new_pass && $password !== $old_pass ) {
				$error['old_pass'] = "Old Password doesn't Match" ;
			}


			if ($error) {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			} else {
				$query = "UPDATE satt_admins SET 
				first_name = '$first_name',
				last_name = '$last_name',
				user_name = '$user_name',
				email = '$email',
				mobile_no = '$mobile_no',
				alternate_mobile_no = '$alternate_mobile_no',
				bio = '$bio' WHERE id='$user_id'";
				$result = $db->update($query);
				$update = "";

				if ($result) {

					if ($new_pass) {
						$user_query = "UPDATE satt_users SET user_name = '$user_name', password = '$new_pass2' where id = '$admin_user_id'";
						$user_update = $db->update($user_query);
					}else{

						$user_query = "UPDATE satt_users SET user_name = '$user_name'  where id = '$admin_user_id'";
						$user_update = $db->update($user_query);
					}

					if ($user_update) {

						if ($file_name) {
							if ($img) {
								unlink($img);
							}
							if (move_uploaded_file($file_temp, $uploaded_image)) {
								$query = "UPDATE satt_admins SET image = '$uploaded_image' where id = '$user_id'";
								$update = $db->update($query);

							}
							if ($update) {
								json_encode(['message' => 'Admin Profile Updated & image uploaded Successfully']);
							}

						}else{
							json_encode(['message' => 'Admin Profile Updated Successfull']);
						}
					die(json_encode(['message' => 'Admin Profile Updated Successfully']));
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