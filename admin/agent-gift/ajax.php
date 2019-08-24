<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent-gift', 'agent-gift');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if ($id) {
		$query = "SELECT * FROM agent_gift WHERE id = '$id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Gift Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$id = $_GET['id'];
	if ($id) {
		$error = array();
	$points = $fm->validation($_POST['points']);
	$gift_name = $fm->validation($_POST['gift_name']);
	

	// $idCheck = $fm->dublicateCheck('agent_contact_by', 'contact_person_id', $contact_person_id);
	// $query = "SELECT * FROM agent_contact_by WHERE contact_person_id = '$contact_person_id' AND id <> '$id'";
	// $gift_name = $db->select($query);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$points) {
		$error['points'] = 'points Field required';
	} elseif (!$gift_name) {
		$error['gift_name'] = 'Field Name Field required';
	}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE agent_gift SET points = '$points', gift_name='$gift_name', status = '$status' WHERE id='$id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Updated Successfully']));
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
	$error = array();
	$points = $fm->validation($_POST['points']);
	$gift_name = $fm->validation($_POST['gift_name']);
	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	
	if (!$points) {
		$error['points'] = 'points Field required';
	} elseif (!$gift_name) {
		$error['gift_name'] = 'Field Name Field required';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO agent_gift (points, gift_name,status) VALUES ('$points','$gift_name','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Gift Added Successfully']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delete  Data into Database
===================================================================*/
// $error['type'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$id = $_GET['id'];
	if ($id) {
		$query = "DELETE FROM agent_gift WHERE id = '$id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Deleted Successfully']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}


/*================================================================
		Change Status  Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$status_id = $_GET['status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($status_id) {
		$query = "UPDATE agent_gift SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfully']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
