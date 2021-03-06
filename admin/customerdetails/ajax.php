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
	Update Username And password data into database
	===================================================================*/

	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['update']) AND $_GET['update'] == 'updatevalue') {
		$error = array();
		$username         = $fm->validation($_POST['username']);
		$password         = $fm->validation($_POST['password']);
		$confirm_password = $fm->validation($_POST['confirm_password']);

		$username_check = $fm->dublicateCheck('satt_customer_informations', 'username', $username);
		
		
		if (!$username) {
			$error['name'] = 'Username Name Field required';
		}elseif (strlen($username) > 255) {
			$error['username'] = 'Username Can Not Be More Than 255 Charecters';
		}elseif ($username_check) {
			$error['username_check'] = 'Username Already Exits';
		}


		if (!$password) {
			$error['password'] = 'password  Field required';
		}elseif (strlen($password) > 255) {
			$error['password'] = 'password  Can Not Be More Than 255 Charecters';
		}

		if (!$confirm_password) {
			$error['confirm_password'] = 'Confirm password  Field required';
		}else if ($password != $confirm_password){
			$error['password'] = 'Confirm password not match';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}else {
			$password = $password;
			/*$query = "INSERT INTO  satt_customer_informations(username,password) VALUES('$username','$password') WHERE id = '$customerdetails_id'";*/
			$query = "UPDATE satt_customer_informations SET 
			username ='$username', 
			password ='$password' 
			WHERE id = '$customerdetails_id'";
			$result = $db->update($query);
			if ($result) {
				$customerdetails_info = "SELECT * FROM satt_customer_informations WHERE id ='$customerdetails_id'";
				$result_info = $db->select($customerdetails_info);
				if($result_info){
					$all_data = $result_info->fetch_assoc();
					$email = $all_data['email'];
					$password = md5($password);
					$from_table ="satt_customer_informations";
					$status = "active";
					$role = "customer-panel";
					$username_checkS = $fm->dublicateCheck('satt_users', 'user_name', $username);
					if ($username_checkS) {
						$error['username_checkS'] = 'Username Already Exits';
					}
					$insert_query = "INSERT INTO satt_users(user_name,email,password,customer_id,from_table,status,role) VALUES('$username','$email','$password','$customerdetails_id','$from_table','$status','$role')";
					$last_id_user = $db->custom_insert($insert_query);

					if ($last_id_user) {
						$query = "UPDATE satt_customer_informations set user_id = '$last_id_user' WHERE id = '$customerdetails_id'";
						$update = $db->update($query);
						if ($update) {
							# code...
							die(json_encode(['message' => 'Username And Password Set Successfull']));
						}
					}
				}
				
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}
	}



/*================================================================
	Update Username And password two table  into database
	===================================================================*/

	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['updateuser']) AND $_GET['updateuser'] == 'updateuservalue') {
		$error = array();
		$username         = $fm->validation($_POST['username']);
		$password         = $fm->validation($_POST['password']);
		$confirm_password = $fm->validation($_POST['confirm_password']);
		$username  = $fm->validation($_POST['username']);

		$query2 = "SELECT * FROM satt_customer_informations WHERE id ='$customerdetails_id'";
		$result2 = $db->select($query2);
		if ($result2 ) {
			while ($data2 = $result2->fetch_assoc()) {
				$username2 = $data2['username'];
			}
			if($username == $username2){
				$username = $username2;
			}else{
				$error['username2'] = 'Username Already Exits';
			}
		}
		
		
		if (!$username) {
			$error['name'] = 'Username Name Field required';
		}elseif (strlen($username) > 255) {
			$error['username'] = 'Username Can Not Be More Than 255 Charecters';
		}


		if (!$password) {
			$error['password'] = 'password  Field required';
		}elseif (strlen($password) > 255) {
			$error['password'] = 'password  Can Not Be More Than 255 Charecters';
		}

		if (!$confirm_password) {
			$error['confirm_password'] = 'Confirm password  Field required';
		}else if ($password != $confirm_password){
			$error['password'] = 'Confirm password not match';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}else {
			$password = $password;
			/*$query = "INSERT INTO  satt_customer_informations(username,password) VALUES('$username','$password') WHERE id = '$customerdetails_id'";*/
			$query = "UPDATE satt_customer_informations SET 
			username ='$username', 
			password ='$password' 
			WHERE id = '$customerdetails_id'";
			$result = $db->update($query);
			if ($result) {
				$customerdetails_info = "SELECT * FROM satt_customer_informations WHERE id ='$customerdetails_id'";
				$result_info = $db->select($customerdetails_info);
				if($result_info){
					$all_data = $result_info->fetch_assoc();
					$email = $all_data['email'];
					$password = md5($password);
					$from_table ="satt_customer_informations";
					$status = "active";
					$role = "customer-panel";
					$username_checkS = $fm->dublicateCheck('satt_users', 'user_name', $username);
					if ($username_checkS) {
						$error['username_checkS'] = 'Username Already Exits';
					}
					/*$insert_query = "INSERT INTO satt_users(user_name,email,password,customer_id,from_table,status,role) VALUES('$username','$email','$password','$customerdetails_id','$from_table','$status','$role')";
					$last_id_user = $db->custom_insert($insert_query);*/
					$update_query = "UPDATE satt_users SET user_name='$username', password='$password' WHERE customer_id='$customerdetails_id'";
					$update = $db->update($update_query);
					if ($update) {
							# code...
						die(json_encode(['message' => 'Username And Password Set Successfull']));
					}
				}
				
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
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
		$domain_name   =$_POST['domain_name'];
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
		if (!$number) {
			$error['number'] = 'Number  Field required';
		}

		if (!$introduction_date) {
			$error['introduction_date'] = 'Introduction Date Field required';
		}elseif (strlen($introduction_date) > 255) {
			$error['introduction_date'] = 'Introduction Date Can Not Be More Than 255 Charecters';
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
				software_category = '$software_category',
				domain_name     = '$domain_name',
				last_contacted_date='$last_contacted_date', 
				status='$status' WHERE id= '$customerdetails_id'";

				$result = $db->update($query);
				if ($result) {
					$querydelete ="DELETE FROM satt_interested_services WHERE cutomer_details_id='$customerdetails_id'";
					$resultdel = $db->delete($querydelete);
					if (isset($interested_services)) {
						for ($i = 0; $i < count($interested_services); $i++) {
							$sql1 = "INSERT INTO satt_interested_services(cutomer_details_id,interested_services_id) VALUES('$customerdetails_id','$interested_services[$i]')";
							$insertrow1 = $db->insert($sql1);
						}
					}

					if ($result != false) {
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
		Next Contacted date information into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['contact']) and $_POST['contact']='next_contact') {
	$admin_id = Session::get('admin_id');
	$error = array();
	$customer_id = $fm->validation($_POST['customerdetails_id']);
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
		$query = "INSERT INTO satt_next_contacted (admin_id, customer_id,next_contact, note) VALUES ('$admin_id', '$customer_id','$next_contact','$note')";
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
	$software_category = $_POST['software_category'];
	$domain_name = $_POST['domain_name'];
	$last_contacted_date = $_POST['last_contacted_date'];
	$contaced_cus_id = $_POST['contaced_cus_id'];
	$system_user_name = $_POST['user_name'];
	$system_user_id = $_POST['user_id'];
	$form_table = $_POST['form_table'];


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


	if (strlen($facebook_name) > 255) {
		$error['facebook_name'] = 'Facebook Name Can Not Be More Than 255 Charecters';
	}

	if (!$number) {
		$error['number'] = 'Number  Field required';
	}elseif ($number_check) {
		$error['number_check'] = 'Number Already Exits';
	}
	if (strlen($email) > 50) {
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

	if (strlen($progressive_state) > 255) {
		$error['progressive_state'] = 'Progressive state  Can Not Be More Than 255 Charecters';
	}

	if (!$interested_services) {
		$error['interested_services'] = 'interested services  Field required';
	}

	if (strlen($institute_type) > 255) {
		$error['institute_type'] = 'institute Category Can Not Be More Than 255 Charecters';
	}

	if (strlen($institute_name) > 255) {
		$error['institute_name'] = 'institute name Can Not Be More Than 255 Charecters';
	}

	if (strlen($institute_address) > 255) {
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

	$query = "INSERT INTO satt_customer_informations (name, facebook_name, number, email, introduction_date, customer_reference, progressive_state, institute_type, institute_name, institute_address, institute_district,software_category,domain_name, last_contacted_date, status)

	VALUES ('$name','$facebook_name','$number','$email','$introduction_date','$customer_reference','$progressive_state','$institute_type','$institute_name','$institute_address','$institute_district','$software_category','$domain_name','$last_contacted_date','$status')";

	$last_id = $db->custom_insert($query);
	if ($last_id) {
	// multi interested Service
		for ($i = 0; $i < count($interested_services); $i++) {
			$sql2 = "INSERT INTO satt_interested_services(cutomer_details_id,interested_services_id) VALUES('$last_id','$interested_services[$i]')";
			$insertrow1 = $db->insert($sql2);
		}
		if ($insertrow1 != false) {
			/*================================================================
					Insert Contacted Data into database
			===================================================================*/
			if ($contaced_cus_id) {
				$id = $contaced_cus_id;

				$con_query = "SELECT * FROM satt_exter_next_contacted where customer_id = '$id'";
				$con_result = $db->select($con_query);
				if ($con_result) {
					while ($data = $con_result->fetch_assoc()) {
						$admin_id = $data['admin_id'];
						$customer_id =$last_id;
						$note = $data['note'];
						$next_contact = $data['next_contact'];
						 if($customer_id){
							$query = "INSERT INTO satt_next_contacted (admin_id, customer_id,next_contact, note) VALUES ('$admin_id', '$customer_id','$next_contact','$note')";
							$result = $db->insert($query);
						}
					}
				}

				$note_query = "SELECT * FROM satt_exter_notes where customer_id = '$id'";
				$note_result = $db->select($note_query);
				if ($note_result) {
					while ($note_data = $note_result->fetch_assoc()) {
						$customer_id =$last_id;
						$note = $note_data['note'];
						$query = "INSERT INTO satt_official_notes (customer_id, note) VALUES ('$customer_id','$note')";
					$del_result = $db->insert($query);
						if ($del_result) {
							$del_quer="DELETE FROM satt_extra_office_notes WHERE id='$id'";
							$db->delete($del_quer);
						}
					}
				}

			}

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


		if (isset($_GET['contactnotedelid'])) {
			$delid = $_GET['contactnotedelid'];
			if ($delid) {
				$delquery = "DELETE FROM  satt_next_contacted WHERE id ='$delid'";
				$result = $db->delete($delquery);
				if($result){
					die(json_encode(['message' => 'Note Deleted Successfully']));
				}else {
					http_response_code(500);
					die(json_encode(['message' => 'Note Not Found']));
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
