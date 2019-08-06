<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customerdetails', 'customerdetails');
if (isset($_GET['course_id'])) {
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$query = "SELECT * FROM satt_customer_informations WHERE id = '$course_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Course Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$error = array();
		$course_name = $fm->validation($_POST['course_name']);
		$course_code = $fm->validation($_POST['course_code']);
		$course_description = $fm->validation($_POST['course_description']);

		$courseCheck = $fm->dublicateCheck('satt_customer_informations', 'course_name', $course_name);
		$codeCheck = $fm->dublicateCheck('satt_customer_informations', 'course_code', $course_code);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$course_name) {
			$error['course_name'] = 'Course Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $course_id) {
				$error['course_name'] = 'Course Already Exists';
			}

		} elseif (strlen($course_name) > 255) {
			$error['course_name'] = 'Course Name Can Not Be More Than 255 Charecters';
		}

		if (!$course_code) {
			$error['course_code'] = 'Course Code Field required';
		} elseif ($codeCheck) {
			$code_row = $codeCheck->fetch_assoc();
			if ($code_row['id'] != $course_id) {
				$error['course_code'] = 'Course Code Already Exits';
			}
		} elseif (strlen($course_code) > 255) {
			$error['course_code'] = 'Course Code Can Not Be More Than 255 Charecters';
		}

		if (strlen($course_description) > 500) {
			$error['course_description'] = 'Course Code Can Not Be More Than 500 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_customer_informations SET course_name = '$course_name', course_code = '$course_code', course_description = '$course_description', status = '$status' WHERE id='$course_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Course Updated Successfull']));
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

	$name = $fm->validation($_POST['name']);
	$facebook_name       = $fm->validation($_POST['facebook_name']);
	$number              = $fm->validation($_POST['number']);
	$email               = $fm->validation($_POST['email']);
	$introduction_date   = $fm->formatDate($_POST['introduction_date']);
	$customer_reference  = $fm->validation($_POST['customer_reference']);
	$progressive_state   = $fm->validation($_POST['progressive_state']);
	$interested_services = $_POST['interested_services'];
	$institute_type      = $fm->validation($_POST['institute_type']);
	$institute_name      = $fm->validation($_POST['institute_name']);
	$institute_address   = $fm->validation($_POST['institute_address']);
	$institute_district  = $fm->validation($_POST['institute_district']);
	$software_category   =$_POST['software_category'];
	$last_contacted_date = $fm->validation($_POST['last_contacted_date']);
	

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
	}elseif (strlen($number) > 11) {
		$error['number'] = 'Number  Can Not Be More Than 11 Charecters';
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

	/*if (!$interested_services) {
		$error['interested_services'] = 'interested services  Field required';
	}elseif (strlen($interested_services) > 255) {
		$error['interested_services'] = 'interested services Can Not Be More Than 255 Charecters';
	}*/

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
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Customer Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['course_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$query = "DELETE FROM satt_customer_informations WHERE id = '$course_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$course_id = $_GET['course_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($course_id) {
		$query = "UPDATE satt_customer_informations SET status = '$status' WHERE id = '$course_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
