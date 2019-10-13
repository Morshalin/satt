<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/Office_note', 'Office_note');
if (isset($_GET['Office_note_id'])) {
	$Office_note_id = $_GET['Office_note_id'];
	if ($Office_note_id) {
		$query = "SELECT * FROM satt_extra_office_notes WHERE id = '$Office_note_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Customer Information Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
		$error = array();
		$name = $fm->validation($_POST['name']);
		$facebook_name       = $fm->validation($_POST['facebook_name']);
		$number              = $fm->validation($_POST['number']);
		$email               = $fm->validation($_POST['email']);
		$introduction_date   = $_POST['introduction_date'];
		$customer_reference  = $fm->validation($_POST['customer_reference']);
		$progressive_state   = $fm->validation($_POST['progressive_state']);
		$interested_services = $_POST['interested_services'];
		$institute_type      = $fm->validation($_POST['institute_type']);
		$institute_name      = $fm->validation($_POST['institute_name']);
		$institute_address   = $fm->validation($_POST['institute_address']);
		$institute_district  = $fm->validation($_POST['institute_district']);
		$software_category   = $_POST['software_category'];
		$last_contacted_date = $_POST['last_contacted_date'];
		

		

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$name) {
			$error['name'] = 'Customer Name Field required';
		}

		if (!$number) {
			$error['number'] = 'Number  Field required';
		}



		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				$query = "UPDATE  satt_extra_office_notes 
					SET 
					name='$name', 
					facebook_name='$facebook_name', 
					number='$number', 
					email='$email', 
					introduction_date   ='$introduction_date', 
					customer_reference  ='$customer_reference', 
					progressive_state   ='$progressive_state', 
					institute_type      ='$institute_type', 
					institute_name      ='$institute_name', 
					institute_address   ='$institute_address', 
					institute_district  ='$institute_district', 
					last_contacted_date ='$last_contacted_date', 
					status='$status'
					WHERE id= '$Office_note_id'";

			 $result = $db->update($query);
			if ($result) {
				$querydelete ="DELETE FROM  satt_extra_interested_service WHERE cutomer_details_id='$Office_note_id'";
				$resultdel = $db->delete($querydelete);
				if ($resultdel) {
					for ($i = 0; $i < count($interested_services); $i++) {
						$sql1 = "INSERT INTO  satt_extra_interested_service(cutomer_details_id,interested_services_id) VALUES('$Office_note_id','$interested_services[$i]')";
						$insertrow1 = $db->insert($sql1);
					}
				}

				// multi Developer insert
				$querydels ="DELETE FROM satt_extra__software_category WHERE cutomer_details_id='$Office_note_id'";
				$resultdeltes = $db->delete($querydels);
				if ($resultdeltes) {
				for ($i = 0; $i < count($software_category); $i++) {
						$sql2 = "INSERT INTO satt_extra__software_category(software_id,cutomer_details_id) VALUES('$software_category[$i]','$Office_note_id')";
						$insertrow2 = $db->insert($sql2);
					}
				}
			if ($insertrow2 != false) {
				die(json_encode(['message' => 'Customer Information Update Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}
}


/*================================================================
		Next Contacted date information into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['contact']) and $_POST['contact']='next_contact') {
	$admin_id = Session::get('admin_id');
	$error = array();
	$customer_id = $fm->validation($_POST['Office_note_id']);
	$note = $fm->validation($_POST['note']);
	$next_contact = $_POST['next_contact'];


	if (!$note) {
		$error['note'] = 'Note  Field required';
	}elseif (strlen($note) > 500) {
		$error['note'] = 'Note Can Not Be More Than 500 Charecters';
	}
	if (!$next_contact) {
		$error['next_contact'] = 'Date  Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_exter_next_contacted (admin_id, customer_id,next_contact, note) VALUES ('$admin_id', '$customer_id','$next_contact','$note')";
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
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = array();

	$name = $fm->validation($_POST['name']);
	$facebook_name       = $fm->validation($_POST['facebook_name']);
	$number              = $fm->validation($_POST['number']);
	$email               = $fm->validation($_POST['email']);
	$introduction_date   = $_POST['introduction_date'];
	$customer_reference  = $fm->validation($_POST['customer_reference']);
	$progressive_state   = $fm->validation($_POST['progressive_state']);
	$interested_services = $_POST['interested_services'];
	$institute_type      = $fm->validation($_POST['institute_type']);
	$institute_name      = $fm->validation($_POST['institute_name']);
	$institute_address   = $fm->validation($_POST['institute_address']);
	$institute_district  = $fm->validation($_POST['institute_district']);
	$software_category   = $_POST['software_category'];
	$last_contacted_date = $_POST['last_contacted_date'];




	$number_check = $fm->dublicateCheck('satt_customer_informations', 'number', $number);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$name) {
		$error['name'] = 'Customer Name Field required';
	}elseif (strlen($facebook_name) > 255) {
		$error['facebook_name'] = 'Customer Name Can Not Be More Than 255 Charecters';
	}


	if (!$number) {
			$error['number'] = 'Number  Field required';
		}elseif ($number_check) {
		$error['number_check'] = 'Number Already Exits';
	}


	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
			$query = "INSERT INTO satt_extra_office_notes (name, facebook_name, number, email, introduction_date, customer_reference, progressive_state, institute_type, institute_name, institute_address, institute_district, last_contacted_date, status)

		 VALUES ('$name','$facebook_name','$number','$email','$introduction_date','$customer_reference','$progressive_state','$institute_type','$institute_name','$institute_address','$institute_district','$last_contacted_date','$status')";
		 $last_id = $db->custom_insert($query);
		if (isset($interested_services)) {
			// multi interested Service
			for ($i = 0; $i < count($interested_services); $i++) {
					$sql2 = "INSERT INTO satt_extra_interested_service(cutomer_details_id,interested_services_id) VALUES('$last_id','$interested_services[$i]')";
					$insertrow1 = $db->insert($sql2);
				}
			}
			if (isset($software_category)) {
				for ($i = 0; $i < count($software_category); $i++) {
					$sql2 = "INSERT INTO satt_extra__software_category(software_id,cutomer_details_id) VALUES('$software_category[$i]','$last_id')";
					$insertrow1 = $db->insert($sql2);
				}
			}
		if ($last_id != false) {
			die(json_encode(['message' => 'Note Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
================================================================*/
 // $error['course_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$Office_note_id = $_GET['Office_note_id'];
	if ($Office_note_id) {
		$query = "DELETE FROM  satt_extra_office_notes WHERE id = '$Office_note_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Note  Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}


/*================================================================
		Update Status  note into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$status_id = $_GET['status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($status_id) {
		$query = "UPDATE satt_extra_office_notes SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
if (isset($_GET['contactnotedelid'])) {
	$delid = $_GET['contactnotedelid'];
	if ($delid) {
		$delquery = "DELETE FROM  satt_exter_next_contacted WHERE id ='$delid'";
		$result = $db->delete($delquery);
		if($result){
			die(json_encode(['message' => 'Note Deleted Successfully']));
		}else {
			http_response_code(500);
			die(json_encode(['message' => 'Note Not Found']));
		}
	}
}
