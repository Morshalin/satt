<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/Office_note', 'Office_note');
if (isset($_GET['note_id'])) {
	$note_id = $_GET['note_id'];
	if ($note_id) {
		$query = "SELECT * FROM satt_official_notes WHERE id = '$note_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Note Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$note_id = $_GET['note_id'];
	if ($note_id) {
		$error = array();
		$note = $fm->validation($_POST['note']);

		if (isset($_POST['leave_reason'])) {
		$leave_reason = $_POST['leave_reason'];
		}else{
			$leave_reason="";
		}

		$noteCheck = $fm->dublicateCheck('satt_official_notes', 'note', $note);
		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$note) {
			$error['note'] = 'Note Field required';
		}


		if (strlen($note) > 500) {
			$error['note'] = 'Note Can Not Be More Than 500 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_official_notes SET note = '$note', leave_reason='$leave_reason', update_date = now(), status = '$status' WHERE id='$note_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Note Updated Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$admin_id = Session::get('admin_id');
	$error = array();
	$customer_id = $fm->validation($_POST['customer_id']);
	$note = $fm->validation($_POST['note']);


	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$note) {
		$error['note'] = 'Note  Field required';
	}

	
	if (strlen($note) > 500) {
		$error['note'] = 'Course Code Can Not Be More Than 500 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_official_notes (admin_id, customer_id, note, status) VALUES ('$admin_id', '$customer_id', '$note','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Note Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['note'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$note_id = $_GET['note_id'];
	if ($note_id) {
		$query = "DELETE FROM satt_official_notes WHERE id = '$note_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$status_id = $_GET['status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($status_id) {
		$query = "UPDATE satt_official_notes SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
