<?php
require_once '../../config/config.php';
ajax();
if (isset($_GET['venue_id'])) {
	$venue_id = $_GET['venue_id'];
	if ($venue_id) {
		$query = "SELECT * FROM satt_venues WHERE id = '$venue_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Place Not Found']));
		}
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$venue_id = $_GET['venue_id'];
	if ($venue_id) {
		$error = array();
		$venue_name = $fm->validation($_POST['venue_name']);
		$venue_code = $fm->validation($_POST['venue_code']);
		$venue_description = $fm->validation($_POST['venue_description']);

		$venueCheck = $fm->dublicateCheck('satt_venues', 'venue_name', $venue_name);
		$codeCheck = $fm->dublicateCheck('satt_venues', 'venue_code', $venue_code);

		if (isset($_POST['venue_status'])) {
			$venue_status = 1;
		} else {
			$venue_status = 0;
		}

		if (!$venue_name) {
			$error['venue_name'] = 'Place Name Field required';
		} elseif ($venueCheck) {
			$venue_row = $venueCheck->fetch_assoc();
			if ($venue_row['id'] != $venue_id) {
				$error['venue_name'] = 'Place Already Exists';
			}

		} elseif (strlen($venue_name) > 255) {
			$error['venue_name'] = 'Place Name Can Not Be More Than 255 Charecters';
		}

		if (!$venue_code) {
			$error['venue_code'] = 'Place Code Field required';
		} elseif ($codeCheck) {
			$code_row = $codeCheck->fetch_assoc();
			if ($code_row['id'] != $venue_id) {
				$error['venue_code'] = 'Place Code Already Exits';
			}
		} elseif (strlen($venue_code) > 255) {
			$error['venue_code'] = 'Place Code Can Not Be More Than 255 Charecters';
		}

		if (strlen($venue_description) > 500) {
			$error['venue_description'] = 'Place Code Can Not Be More Than 500 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_venues SET venue_name = '$venue_name', venue_code = '$venue_code', venue_description = '$venue_description', venue_status = '$venue_status' WHERE id='$venue_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Place Updated Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();
	$venue_name = $fm->validation($_POST['venue_name']);
	$venue_code = $fm->validation($_POST['venue_code']);
	$venue_description = $fm->validation($_POST['venue_description']);

	$venueCheck = $fm->dublicateCheck('satt_venues', 'venue_name', $venue_name);
	$codeCheck = $fm->dublicateCheck('satt_venues', 'venue_code', $venue_code);

	if (isset($_POST['venue_status'])) {
		$venue_status = 1;
	} else {
		$venue_status = 0;
	}

	if (!$venue_name) {
		$error['venue_name'] = 'Place Name Field required';
	} elseif ($venueCheck) {
		$error['venue_name'] = 'Place Already Exits';
	} elseif (strlen($venue_name) > 255) {
		$error['venue_name'] = 'Place Name Can Not Be More Than 255 Charecters';
	}

	if (!$venue_code) {
		$error['venue_code'] = 'Place Code Field required';
	} elseif ($codeCheck) {
		$error['venue_code'] = 'Place Code Already Exits';
	} elseif (strlen($venue_code) > 255) {
		$error['venue_code'] = 'Place Code Can Not Be More Than 255 Charecters';
	}

	if (strlen($venue_description) > 500) {
		$error['venue_description'] = 'Place Code Can Not Be More Than 500 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_venues (venue_name, venue_code, venue_description, venue_status) VALUES ('$venue_name', '$venue_code', '$venue_description','$venue_status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Place Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

// $error['venue_name'] = 'Place Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$venue_id = $_GET['venue_id'];
	if ($venue_id) {
		$query = "DELETE FROM satt_venues WHERE id = '$venue_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Place Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$venue_id = $_GET['venue_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($venue_id) {
		$query = "UPDATE satt_venues SET venue_status = '$status' WHERE id = '$venue_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Place Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
