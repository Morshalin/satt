<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL . '/profile', 'Agent Profile');
if (isset($_GET['$user_id'])) {
	$user_id = $_GET['$user_id'];
	if ($user_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$user_id'";
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

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user_id = $_GET['user_id'];
		if ($user_id) {

			$query = "SELECT * FROM agent_list WHERE id = '$user_id'";
			$result = $db->select($query);
			if ($result) {
				$agent_id = $result->fetch_assoc()['user_id'];
			}

			$error = array();
			$user_query = "SELECT * FROM satt_users WHERE id = '$agent_id'";
			$user_result = $db->select($user_query);
			if ($user_result) {
				$password = $user_result->fetch_assoc()['password'];
			}

			$old_pass = $fm->validation(md5($_POST['old_pass']));
			$new_pass = $_POST['new_pass'];
			$new_pass2 = $fm->validation(md5($_POST['new_pass']));
			$first_name = $fm->validation($_POST['first_name']);
			$mobile_no = $fm->validation($_POST['mobile_no']);


			if (!$first_name) {
				$error['first_name'] = 'First Name Field required';
			}elseif (strlen($first_name) > 255) {
				$error['first_name'] = 'First Name Can Not Be More Than 255 Charecters';
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
				$query = "UPDATE agent_list SET 
				name = '$first_name',
				mobile_no = '$mobile_no' WHERE id='$user_id'";
				$result = $db->update($query);

				if ($result) {
					
					if ($new_pass) {
						$user_query = "UPDATE satt_users SET password = '$new_pass2' where id = '$agent_id'";
						$user_update = $db->update($user_query);
					
					if ($user_update) {
						$query1 = "UPDATE agent_list SET password = '$new_pass' WHERE id='$user_id'";
						$result1 = $db->update($query1);
						die(json_encode(['message' => 'Agent Profile Updated Successfully']));
					}
				}
					die(json_encode(['message' => 'Agent Profile Updated Successfully']));
				}else{
						http_response_code(500);
						die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
					}
			}
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
	}