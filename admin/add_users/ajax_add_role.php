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
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();
    
    $role_id =  $_POST['role_id'];
    
	if (!$role_id) {
		$error['role_id'] = 'Please Select a Role';
	}
    
    if ($error) {
        http_response_code(500);
        die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
    } else {
        $query = "DELETE  FROM user_has_role WHERE user_serial_no = '$users_id'";
        $delete_role  = $db->delete($query);
        $query = "SELECT * FROM role WHERE serial_no = '$role_id'";
        $get_role = $db->select($query)->fetch_assoc();
        $role_name = $get_role['role_name'];

        
        $query = "INSERT INTO user_has_role (role_serial_no,user_serial_no,user_type) VALUES ('$role_id','$users_id','system_user')";
        $insert_user_has_role = $db->insert($query);
        if ($insert_user_has_role) {
            $query = "UPDATE satt_users
            SET 
            system_user_role = '$role_name',
            user_type='system_user'
            WHERE
            systems_user_id = '$users_id'";
            $update_login = $db->update($query);
        }
        if ($update_login) {
            die(json_encode(['message' => 'User Added Successfull']));
        } else {
            http_response_code(500);
            die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
        }
    }
}