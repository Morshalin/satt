<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customerdetails', 'customerdetails');
if (isset($_GET['customerdetails_id'])) {
	$customerdetails_id = $_GET['customerdetails_id'];
	if ($customerdetails_id) {
		$query = "SELECT * FROM satt_customer_informations WHERE id = '$customerdetails_id'";
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
		$software_category   =$_POST['software_category'];
		$last_contacted_date = $_POST['last_contacted_date'];
		

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


		if (!$facebook_name) {
			$error['facebook_name'] = 'Facebook Name Field required';
		}elseif (strlen($facebook_name) > 255) {
			$error['facebook_name'] = 'Facebook Name Can Not Be More Than 255 Charecters';
		}

		if (!$number) {
			$error['number'] = 'Number  Field required';
		}

		if (!$email) {
			$error['email'] = 'Email  Field required';
		}elseif (strlen($email) > 50) {
			$error['email'] = 'Email  Can Not Be More Than 20 Charecters';
		}

		if (!$introduction_date) {
			$error['introduction_date'] = 'Introduction Date Field required';
		}elseif (strlen($introduction_date) > 255) {
			$error['introduction_date'] = 'Introduction Date Can Not Be More Than 255 Charecters';
		}

		if (!$customer_reference) {
			$error['customer_reference'] = 'Customer reference  Field required';
		}elseif (strlen($customer_reference) > 255) {
			$error['customer_reference'] = 'Customer reference  Can Not Be More Than 255 Charecters';
		}

		if (!$progressive_state) {
			$error['progressive_state'] = 'Progressive state  Field required';
		}elseif (strlen($progressive_state) > 255) {
			$error['progressive_state'] = 'Progressive state  Can Not Be More Than 255 Charecters';
		}

		if (!$interested_services) {
			$error['interested_services'] = 'interested services  Field required';
		}

		if (!$institute_type) {
			$error['institute_type'] = 'institute category Field required';
		}elseif (strlen($institute_type) > 255) {
			$error['institute_type'] = 'institute Category Can Not Be More Than 255 Charecters';
		}

		if (!$institute_name) {
			$error['institute_name'] = 'institute name  Field required';
		}elseif (strlen($institute_name) > 255) {
			$error['institute_name'] = 'institute name Can Not Be More Than 255 Charecters';
		}

		if (!$institute_address) {
			$error['institute_address'] = 'institute address  Field required';
		}elseif (strlen($institute_address) > 255) {
			$error['institute_address'] = 'institute address Can Not Be More Than 255 Charecters';
		}

		if (!$institute_district) {
			$error['institute_district'] = 'institute district   Field required';
		}elseif (strlen($institute_district) > 255) {
			$error['institute_district'] = 'institute district Can Not Be More Than 255 Charecters';
		}

		if (!$last_contacted_date) {
			$error['last_contacted_date'] = 'Last Contacted Date  Field required';
		}elseif (strlen($last_contacted_date) > 255) {
			$error['last_contacted_date'] = 'Last Contacted Date Can Not Be More Than 255 Charecters';
		}


		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
				/*foreach ($$interested_services as  $value) {
					die(json_encode(['errors' => print_r($value)]));
				}*/
				$query = "UPDATE  satt_customer_informations 
					SET 
					name='$name', 
					facebook_name='$facebook_name', 
					number='$number', 
					email='$email', 
					introduction_date='$introduction_date', 
					customer_reference='$customer_reference', 
					progressive_state='$progressive_state', 
					institute_type='$institute_type', 
					institute_name='$institute_name', 
					institute_address='$institute_address', 
					institute_district='$institute_district', 
					last_contacted_date='$last_contacted_date', 
					status='$status' WHERE id= '$customerdetails_id'";

			 $result = $db->update($query);
			if ($result) {
				$querydelete ="DELETE FROM satt_interested_services WHERE cutomer_details_id='$customerdetails_id'";
				$resultdel = $db->delete($querydelete);
				if ($resultdel) {
					for ($i = 0; $i < count($interested_services); $i++) {
						$sql1 = "INSERT INTO satt_interested_services(cutomer_details_id,interested_services_id) VALUES('$customerdetails_id','$interested_services[$i]')";
						$insertrow1 = $db->insert($sql1);
					}
				}

				// multi Developer insert
				$querydels ="DELETE FROM sat_software_category WHERE cutomer_details_id='$customerdetails_id'";
				$resultdeltes = $db->delete($querydels);
				if ($resultdeltes) {
				for ($i = 0; $i < count($software_category); $i++) {
						$sql2 = "INSERT INTO sat_software_category(software_id,cutomer_details_id) VALUES('$software_category[$i]','$customerdetails_id')";
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
		Insert Note information into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action']) and $_POST['action']='add_note') {
	$admin_id = Session::get('admin_id');
	$error = array();
	$customer_id = $fm->validation($_POST['customerdetails_id']);
	if (isset($_POST['leave_reason'])) {
		$leave_reason = $_POST['leave_reason'];
	}
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
		$error['note'] = 'Note Can Not Be More Than 500 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_official_notes (admin_id, customer_id, note, status) VALUES ('$admin_id', '$customer_id','$note','$status')";
		$result = $db->insert($query);
		if (isset($leave_reason)) {
			// multi interested Service
			for ($i = 0; $i < count($leave_reason); $i++) {
					$sql2 = "INSERT INTO satt_leave_reason(custimer_id,leave_reason) VALUES('$customer_id','$leave_reason[$i]')";
					$insertrow1 = $db->insert($sql2);
				}
			}
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
	$software_category   =$_POST['software_category'];
	$last_contacted_date = $_POST['last_contacted_date'];
	

	$number_check = $fm->dublicateCheck('satt_customer_informations', 'number', $number);
	$email_check = $fm->dublicateCheck('satt_customer_informations', 'email', $email);

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


	if (!$facebook_name) {
		$error['facebook_name'] = 'Facebook Name Field required';
	}elseif (strlen($facebook_name) > 255) {
		$error['facebook_name'] = 'Facebook Name Can Not Be More Than 255 Charecters';
	}

	if (!$number) {
		$error['number'] = 'Number  Field required';
	}elseif ($number_check) {
		$error['number_check'] = 'Number Already Exits';
	}

	if (!$email) {
		$error['email'] = 'Email  Field required';
	}elseif ($email_check) {
		$error['email_check'] = 'Email Already Exits';
	}elseif (strlen($email) > 50) {
		$error['email'] = 'Email  Can Not Be More Than 20 Charecters';
	}

	if (!$introduction_date) {
		$error['introduction_date'] = 'Introduction Date Field required';
	}elseif (strlen($introduction_date) > 255) {
		$error['introduction_date'] = 'Introduction Date Can Not Be More Than 255 Charecters';
	}

	if (!$customer_reference) {
		$error['customer_reference'] = 'Customer reference  Field required';
	}elseif (strlen($customer_reference) > 255) {
		$error['customer_reference'] = 'Customer reference  Can Not Be More Than 255 Charecters';
	}

	if (!$progressive_state) {
		$error['progressive_state'] = 'Progressive state  Field required';
	}elseif (strlen($progressive_state) > 255) {
		$error['progressive_state'] = 'Progressive state  Can Not Be More Than 255 Charecters';
	}

	if (!$interested_services) {
		$error['interested_services'] = 'interested services  Field required';
	}

	if (!$institute_type) {
		$error['institute_type'] = 'institute category Field required';
	}elseif (strlen($institute_type) > 255) {
		$error['institute_type'] = 'institute Category Can Not Be More Than 255 Charecters';
	}

	if (!$institute_name) {
		$error['institute_name'] = 'institute name  Field required';
	}elseif (strlen($institute_name) > 255) {
		$error['institute_name'] = 'institute name Can Not Be More Than 255 Charecters';
	}

	if (!$institute_address) {
		$error['institute_address'] = 'institute address  Field required';
	}elseif (strlen($institute_address) > 255) {
		$error['institute_address'] = 'institute address Can Not Be More Than 255 Charecters';
	}

	if (!$institute_district) {
		$error['institute_district'] = 'institute district   Field required';
	}elseif (strlen($institute_district) > 255) {
		$error['institute_district'] = 'institute district Can Not Be More Than 255 Charecters';
	}

	if (!$last_contacted_date) {
		$error['last_contacted_date'] = 'Last Contacted Date  Field required';
	}elseif (strlen($last_contacted_date) > 255) {
		$error['last_contacted_date'] = 'Last Contacted Date Can Not Be More Than 255 Charecters';
	}


	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
			/*foreach ($$interested_services as  $value) {
				die(json_encode(['errors' => print_r($value)]));
			}*/
			$query = "INSERT INTO satt_customer_informations (name, facebook_name, number, email, introduction_date, customer_reference, progressive_state, institute_type, institute_name, institute_address, institute_district, last_contacted_date, status)

		 VALUES ('$name','$facebook_name','$number','$email','$introduction_date','$customer_reference','$progressive_state','$institute_type','$institute_name','$institute_address','$institute_district','$last_contacted_date','$status')";

		 $last_id = $db->custom_insert($query);
		if ($last_id) {
			// multi interested Service
			for ($i = 0; $i < count($interested_services); $i++) {
					$sql2 = "INSERT INTO satt_interested_services(cutomer_details_id,interested_services_id) VALUES('$last_id','$interested_services[$i]')";
					$insertrow1 = $db->insert($sql2);
				}

			// multi Developer insert
			for ($i = 0; $i < count($software_category); $i++) {
					$sql2 = "INSERT INTO sat_software_category(software_id,cutomer_details_id) VALUES('$software_category[$i]','$last_id')";
					$insertrow1 = $db->insert($sql2);
				}
		if ($insertrow1 != false) {
			die(json_encode(['message' => 'Customer Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['course_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$customerdetails_id = $_GET['customerdetails_id'];
	if ($customerdetails_id) {
		// $query = "DELETE  satt_customer_informations, sat_software_category, satt_interested_services from satt_customer_informations inner join sat_software_category ON satt_customer_informations.id = sat_software_category.cutomer_details_id inner join satt_interested_services on satt_customer_informations.id =satt_interested_services.cutomer_details_id WHERE satt_customer_informations.id = '$customerdetails_id'";
		$query = "DELETE FROM  satt_customer_informations WHERE id = '$customerdetails_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Customer Information Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}




/*================================================================
		Delate  note into Database
===================================================================*/
if (isset($_GET['delid'])) {
	$delid = $_GET['delid'];
	if ($delid) {
		$delquery = "DELETE FROM  satt_official_notes WHERE id ='$delid'";
		$result = $db->delete($delquery);
		if($result){
           die(json_encode(['message' => 'Note Deleted Successfully']));
		}else {
			http_response_code(500);
			die(json_encode(['message' => 'Note Not Found']));
		}
	}
}


if (isset($_GET['notedelid'])) {
	$notedelid = $_GET['notedelid'];
	if ($notedelid) {
		$delquery = "DELETE FROM  satt_leave_reason WHERE custimer_id ='$notedelid'";
		$result = $db->delete($delquery);
		if($result){
           die(json_encode(['message' => 'Reasion Deleted Successfully']));
		}else {
			http_response_code(500);
			die(json_encode(['message' => 'Reasion Not Found']));
		}
	}
}

/*================================================================
		Update Status  note into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$status_id = $_GET['status_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($status_id) {
		$query = "UPDATE satt_customer_informations SET status = '$status' WHERE id = '$status_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
