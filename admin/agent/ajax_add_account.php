<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {

		$query = "select * from agent_list WHERE id = '$agent_id' ";
		$result = $db->select($query);
		if ($result) {
			$row = $result->fetch_assoc();
			$email = $row['email'];
		}

		$error = array();

		$username = $fm->validation($_POST['username']);
		$password = $fm->validation($_POST['password']);
		$password1 = md5($password);
		$courseCheck = $fm->dublicateCheck('satt_users', 'user_name', $username);

		if (!$username) {
			$error['username'] = 'Userame Field required';
		}elseif ($courseCheck) {
			$error['username'] = 'Userame Already Exits';
		}
		if (!$password) {
			$error['password'] = 'Password Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query1 = "INSERT INTO satt_users (user_name, email, password, created_at, agent_id, from_table, status, role) VALUES ('$username','$email','$password1', now(), '$agent_id','agent_list','active', 'agent-panel')";
				$last_id = $db->custom_insert($query1);
				if ($last_id) {
					$query2 = "UPDATE agent_list
					 SET user_id = '$last_id',
					  username = '$username',
					  password = '$password'
					  WHERE id='$agent_id'";
					$result2 = $db->update($query2);
				}


			if ($result2 != false) {
				die(json_encode(['message' => ' New Pay Confirm Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}