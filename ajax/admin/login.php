<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login'])) {
	$error = array();

	$username_or_email = $fm->validation($_POST['username_or_email']);
	$password = $fm->validation($_POST['password']);
	$goto = $fm->validation($_POST['goto']);

	$userCheck = $fm->userOrEmailCheck('satt_admins', $username_or_email);
	if (!$username_or_email) {
		$error['username_or_email'] = 'Username or Email is Required';
	} elseif ($userCheck == false) {
		$error['username_or_email'] = 'User Not Found';
	}
	if (!$password) {
		$error['password'] = 'Password is Required';
	} else if (strlen($password) < 6) {
		$error['password'] = 'Password Must be in 6 characters';
	}
	if ($error) {
		echo json_encode(['success' => false, 'status' => 'danger', 'errors' => $error]);
		die();
	} else {
		$password = md5($password);
		$result = $fm->user('satt_admins', $username_or_email, $password);
		if ($result != false) {
			$admin = $result->fetch_assoc();
			$adminId = $admin['id'];
			$query = "UPDATE satt_admins SET last_login = now(), last_login_ip='127.0.0.1' WHERE id='$adminId' ";
			$db->update($query);
			$userName = $admin['user_name'];
			$adminFirstName = $admin['first_name'];
			$adminLastName = $admin['last_name'];

			Session::set('admin', true);
			Session::set('login_message', 'Login Successfull');
			Session::set('adminUserName', $userName);
			Session::set('adminFirstName', $adminFirstName);
			Session::set('adminId', $adminId);
			$msg = 'Login Success Full';
			echo json_encode(['status' => 'success', 'success' => true, 'userName' => $userName, 'adminName' => $adminFirstName, 'message' => $msg, 'goto' => urldecode($goto)]);
			die();
		} else {
			$error['username_or_email'] = 'Credential Not match';
			echo json_encode(['success' => false, 'status' => 'danger', 'errors' => $error]);
			die();
		}
	}
}
