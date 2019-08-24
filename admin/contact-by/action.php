<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/contact-by', 'Contact By');
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action'])) {
	$ids = $_POST['ids'];
	if ($_POST['action'] == 'delete') { 
		if ($ids) {
			foreach ($ids as $id) {
				$query = "DELETE FROM agent_contact_by WHERE id = '$id'";
				$result = $db->delete($query);
				if ($result) {

					$query3 = "DELETE FROM software_price WHERE id = '$id'";
					$result3 = $db->delete($query3);

				}
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Software Detail' : 'Software Details') . ' Deleted Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'active') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE agent_contact_by SET status = 1 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Software Detail' : 'Software Details') . ' Status Change To Online Successfull']));

		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'inactive') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE agent_contact_by SET status = 0 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Software Detail' : 'Software Details') . ' Status Change To Offline Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'toggle') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "SELECT status FROM agent_contact_by  WHERE id = '$id'";
				$result = $db->select($query);
				$status = 0;
				if ($result) {
					$row = $result->fetch_assoc();
					$status = $row['status'] == 1 ? 0 : 1;
				}
				$query = "UPDATE agent_contact_by SET status = $status WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Software Detail' : 'Software Details') . ' Status Toggled Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
