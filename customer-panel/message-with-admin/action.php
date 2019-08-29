<?php
require_once '../../config/config.php';
ajax();
              <th>Status</th>
              <th>Status</th>
Session::checkSession('admin', ADMIN_URL . '/message-with-admin', 'message-with-admin');
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action'])) {
	$ids = $_POST['ids'];
	if ($_POST['action'] == 'delete') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "DELETE FROM  satt_customer_informations WHERE id = '$id'";
				$result = $db->delete($query);
			}
              <th>Status</th>
              <th>Status</th>
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'message-with-admin' : 'message-with-admin') . ' Deleted Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'active') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE satt_customer_informations SET status = 1 WHERE id = '$id'";
				$result = $db->update($query);
			}
              <th>Status</th>
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'customerdetail' : 'message-with-admin') . ' Status Change To Online Successfull']));

		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'inactive') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE satt_customer_informations SET status = 0 WHERE id = '$id'";
				$result = $db->update($query);
			}
              <th>Status</th>
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'customerdetail' : 'message-with-admin') . ' Status Change To Offline Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'toggle') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "SELECT status FROM satt_customer_informations  WHERE id = '$id'";
				$result = $db->select($query);
				$status = 0;
				if ($result) {
					$row = $result->fetch_assoc();
					$status = $row['status'] == 1 ? 0 : 1;
				}
				$query = "UPDATE satt_customer_informations SET status = $status WHERE id = '$id'";
				$result = $db->update($query);
			}
              <th>Status</th>
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'customerdetail' : 'message-with-admin') . ' Status Toggled Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
