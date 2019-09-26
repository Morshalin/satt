<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/role', 'role');
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action'])) {
	$ids = $_POST['ids'];
	if ($_POST['action'] == 'delete') { 
		if ($ids) {
			foreach ($ids as $id) {
				$query = "DELETE FROM role WHERE serial_no = '$id'";
				$result = $db->delete($query);
				$query1 = "DELETE FROM role_has_permission WHERE role_serial_no = '$id'";
				$result1 = $db->delete($query1);
			
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Role' : 'Roles') . ' Deleted Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
