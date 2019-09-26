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
	Update data into database
===================================================================*/
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id = $_GET['id'];
		if ($id) {
			$error = array();

			$permission = $_POST['permission'];
			$role_name = $_POST['role_name'];
			$edit_id = $id;

			$query = "SELECT * FROM role WHERE serial_no <> '$edit_id'";
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

			$query = "UPDATE role 
			SET 
			role_name = '$role_name'
			WHERE 
			serial_no = '$edit_id'";
			$update_role = $db->update($query);
			if ($update_role) {
				$query = "DELETE FROM role_has_permission WHERE role_serial_no = '$edit_id'";
				$delete_role_permission = $db->delete($query);
				if ($delete_role_permission) {
					////////////////


					for ($i=0; $i < count($permission) ; $i++) { 
						$query_permission  = "INSERT INTO role_has_permission (role_serial_no,permission_serial_no) 
						VALUES 
						('$edit_id','$permission[$i]')";
						$insert_permission = $db->insert($query_permission);
					}

					if ($insert_permission) {
						die(json_encode(['message' => "Congratulations! Information Is Successfully Updated."]));
					} else {
							http_response_code(500);
							die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
						}
					
					
				}
			}

			}
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
	}
