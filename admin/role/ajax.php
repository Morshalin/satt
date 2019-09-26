<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/role', 'Role');
// if (isset($_GET['id'])) {
// 	$id = $_GET['id'];
// 	if ($id) {
// 		$query = "SELECT * FROM agent_gift WHERE id = '$id'";
// 		$result = $db->select($query);
// 		if (!$result) {
// 			http_response_code(500);
// 			die(json_encode(['message' => 'Gift Not Found']));
// 		}
// 	}
// }
/*================================================================
	Insert data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$permission = $_POST['permission'];
		$role_name = $_POST['role_name'];
		$error = array();
		$query = "SELECT * FROM role";
		$get_role = $db->select($query);

		$confirmation = true; 
		if ($get_role) {
			while ($row = $get_role->fetch_assoc()) {
				if ($row['role_name']==$role_name) {
					$confirmation =  false;
					$error['product_name'] =  "Sorry role name already exist. Please Try Another Non Existing Name.";
					break;
				}
			}
		}
		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {

			$query_role = "INSERT INTO role (role_name) VALUES ('$role_name')";
			$role_serial_no = $db->custom_insert($query_role);

			for ($i=0; $i < count($permission) ; $i++) { 
				$query_permission  = "INSERT INTO role_has_permission (role_serial_no,permission_serial_no) 
				VALUES 
				('$role_serial_no','$permission[$i]')";
				$insert_permission = $db->insert($query_permission);
			}

			if ($insert_permission) {
				die(json_encode(['message' => "Congratulations! Information Is Successfully Inserted."]));
			} else {
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
			
		}

}

/*================================================================
		Delate  Data into Database
================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
			$del_id = $_GET['del_id'];
			if ($del_id) {
				$query = "DELETE FROM role WHERE serial_no = '$del_id'";
				$result = $db->delete($query);
				$query1 = "DELETE FROM role_has_permission WHERE role_serial_no = '$del_id'";
				$result1 = $db->delete($query1);
				if ($result) {
					die(json_encode(['message' => 'Role Deleted Successfull']));
				}
			}
			http_response_code(500);
			die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
		}

