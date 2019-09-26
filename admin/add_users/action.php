<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/add_users', 'users');
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action'])) {
	$ids = $_POST['ids'];
	if ($_POST['action'] == 'delete') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "DELETE FROM users WHERE id = '$id'";
				$result = $db->delete($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'users' : 'userss') . ' Deleted Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'active') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE users SET status = 1 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'users' : 'userss') . ' Status Change To Online Successfull']));

		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'inactive') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE users SET status = 0 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'users' : 'userss') . ' Status Change To Offline Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'toggle') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "SELECT status FROM users  WHERE id = '$id'";
				$result = $db->select($query);
				$status = 0;
				if ($result) {
					$row = $result->fetch_assoc();
					$status = $row['status'] == 1 ? 0 : 1;
				}
				$query = "UPDATE users SET status = $status WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'users' : 'userss') . ' Status Toggled Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
