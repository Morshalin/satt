<?php
require_once '../config/config.php';
ajax();

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login'])) {
	$error = array();
	$msg = '';
	$ip_address = getClientIp();
	$details = getClientDetails();

	$username_or_email = $fm->validation($_POST['username_or_email']);
	$password = $fm->validation($_POST['password']);
	$password_text = $fm->validation($_POST['password']);
	$goto = $fm->validation($_POST['goto']);
	$from = $fm->validation($_POST['from']);
	if ($from == 'login') {
		$msg = 'Login Successfull. Welcome Back.';
	} elseif ($from == 'lock') {
		$msg = 'Unlock Successfull. Thank You For Comming Back.';
	}

	$userCheck = $fm->userOrEmailCheck('satt_users', $username_or_email);
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
		http_response_code(405);
		die(json_encode(['errors' => $error]));
	} else {
		$password = md5($password);
		$result = $fm->user('satt_users', $username_or_email, $password);
		if ($result != false) {
			$user = $result->fetch_assoc();
			$userId = $user['id'];
			$getLoginUser = getLoginUser($user['from_table'], $userId);
			if ($getLoginUser) {
				$login_user = $getLoginUser->fetch_assoc();
				$query = "INSERT INTO satt_user_logs (user_id, status, ip_address, details, created_at) VALUES ('$userId', true, '$ip_address', '$details', now());";
				$db->insert($query);
				$userRole = $user['role'];
				$admin_id = $user['admin_id'];

				$role = $user['system_user_role'];
				$user_type = $user['user_type'];
				$systems_user_id = $user['systems_user_id'];

				Session::set('login', true);
				Session::set($userRole, true);
				Session::set('userRole', $userRole);
				Session::set('admin_id', $admin_id);
				Session::set('login_message', $msg);
				Session::set('userData', $login_user);
				Session::set($userRole . 'Id', $userId);

				Session::set('role', $role);
				Session::set('user_type', $user_type);
				Session::set('systems_user_id', $systems_user_id);

				if (urldecode($goto) == 'default') {
					$goto = BASE_URL . '/' . $userRole;
				}
				die(json_encode(['message' => $msg, 'goto' => urldecode($goto)]));
			} else{
			$error['username_or_email'] = 'Something Wrong';
			http_response_code(405);
			die(json_encode(['errors' => $error]));
			}

		} else {
			$query = "INSERT INTO satt_user_logs (status, user_name, password, ip_address, details, created_at) VALUES (false, '$username_or_email', '$password_text', '$ip_address', '$details', now());";
			$db->insert($query);
			$error['username_or_email'] = 'Credential Not match';
			http_response_code(405);
			die(json_encode(['errors' => $error]));
		}
	}
}
