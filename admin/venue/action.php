<?php
require_once '../../config/config.php';
ajax();

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action'])) {
	$ids = $_POST['ids'];
	if ($_POST['action'] == 'delete') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "DELETE FROM satt_venues WHERE id = '$id'";
				$result = $db->delete($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Venue' : 'Venues') . ' Deleted Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'active') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE satt_venues SET venue_status = 1 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Venue' : 'Venues') . ' Status Change To Online Successfull']));

		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'inactive') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "UPDATE satt_venues SET venue_status = 0 WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Venue' : 'Venues') . ' Status Change To Offline Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	} elseif ($_POST['action'] == 'toggle') {
		if ($ids) {
			foreach ($ids as $id) {
				$query = "SELECT venue_status FROM satt_venues  WHERE id = '$id'";
				$result = $db->select($query);
				$status = 0;
				if ($result) {
					$row = $result->fetch_assoc();
					$status = $row['venue_status'] == 1 ? 0 : 1;
				}
				$query = "UPDATE satt_venues SET venue_status = $status WHERE id = '$id'";
				$result = $db->update($query);
			}
			die(json_encode(['message' => '(' . count($ids) . ') ' . (count($ids) == 1 ? 'Venue' : 'Venues') . ' Status Toggled Successfull']));
		}
		http_response_code(500);
		die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
