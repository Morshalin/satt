<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/interestedservices', 'interestedservices');
if (isset($_GET['services_id'])) {
	$services_id = $_GET['services_id'];
	if ($services_id) {
		$query = "SELECT * FROM satt_customer_interestedservice WHERE id = '$services_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Progress State Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$services_id = $_GET['services_id'];
	if ($services_id) {
		$error = array();
		$services = $fm->validation($_POST['services']);

		$services_check = $fm->dublicateCheck('satt_customer_interestedservice', 'services', $services);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$services) {
			$error['services'] = 'Interested Service Field required';
		} elseif ($services_check) {
			$services_row = $services_check->fetch_assoc();
			if ($services_row['id'] != $services_id) {
				$error['services'] = 'Interested Service Already Exists';
			}

		} elseif (strlen($services) > 255) {
			$error['services'] = 'Interested Service Can Not Be More Than 255 Charecters';
		}

		
		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_interestedservice SET services = '$services', status = '$status' WHERE id='$services_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Interested Service Updated Successfull']));
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
	$services = $fm->validation($_POST['services']);
	

	$check_services = $fm->dublicateCheck('satt_customer_interestedservice', 'services', $services);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$services) {
		$error['services'] = 'Interested Services Field required';
	} elseif ($check_services) {
		$error['check_services'] = 'Interested Services  Already Exits';
	} elseif (strlen($services) > 255) {
		$error['services'] = 'Interested Services Can Not Be More Than 255 Charecters';
	}



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_customer_interestedservice (services, status) VALUES ('$services','$status')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Interested Services Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delete  Data into Database
===================================================================*/
// $error['services'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$services_id = $_GET['services_id'];
	if ($services_id) {
		$query = "DELETE FROM satt_customer_interestedservice WHERE id = '$services_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Deleted Successfull']));
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
		$query = "UPDATE satt_customer_interestedservice SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
