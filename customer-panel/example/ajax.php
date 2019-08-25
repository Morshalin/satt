<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/course', 'Course');
if (isset($_GET['course_id'])) {
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$query = "SELECT * FROM satt_courses WHERE id = '$course_id'";
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
	$emp_id = $_GET['emp_id'];
	if ($emp_id) {
		$error = array();

		$emp_name = $fm->validation($_POST['emp_name']);
		$emp_code   = $fm->validation($_POST['emp_id']);
		$city     = $fm->validation($_POST['city']);
		$country  = $fm->validation($_POST['country']);
		$course_description = $fm->validation($_POST['course_description']);

		$courseCheck = $fm->dublicateCheck('satt_employer', 'emp_name', $emp_name);
		$codeCheck   = $fm->dublicateCheck('satt_employer', 'emp_id', $emp_code);
		$codeCheck2   = $fm->dublicateCheck('satt_employer', 'city', $city);
		$codeCheck3   = $fm->dublicateCheck('satt_employer', 'country', $country);

		if (isset($_POST['emp_sratuse'])) {
			$emp_sratuse = 1;
		} else {
			$emp_sratuse = 0;
		}

		if (!$emp_name) {
			$error['emp_name'] = 'Employer Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $emp_id) {
				$error['emp_name'] = 'Employer Already Exists';
			}

		} elseif (strlen($emp_name) > 255) {
			$error['emp_name'] = 'Course Name Can Not Be More Than 255 Charecters';
		}

		if (!$emp_code) {
			$error['emp_id'] = 'Code Field required';
		} elseif ($codeCheck) {
			$code_row = $codeCheck->fetch_assoc();
			if ($code_row['id'] != $emp_id) {
				$error['emp_id'] = 'Code Already Exits';
			}
		} elseif (strlen($emp_code) > 255) {
			$error['emp_id'] = 'Code Can Not Be More Than 255 Charecters';
		}

		if (strlen($course_description) > 500) {
			$error['course_description'] = 'Code Can Not Be More Than 500 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE satt_employer SET emp_name = '$emp_name', emp_id = '$emp_code', city='$city', country = '$country',course_description = '$course_description', emp_sratuse = '$emp_sratuse' WHERE id='$emp_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Updated Successfull']));
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
	$emp_name = $fm->validation($_POST['emp_name']);
	$emp_id   = $fm->validation($_POST['emp_id']);
	$city     = $fm->validation($_POST['city']);
	$country   = $fm->validation($_POST['country']);
	$course_description = $fm->validation($_POST['course_description']);

	$courseCheck = $fm->dublicateCheck('satt_employer', 'emp_name', $emp_name);
	$codeCheck   = $fm->dublicateCheck('satt_employer', 'emp_id', $emp_id);
	$codeCheck2   = $fm->dublicateCheck('satt_employer', 'city', $city);
	$codeCheck3   = $fm->dublicateCheck('satt_employer', 'country', $country);

	if (isset($_POST['emp_sratuse'])) {
		$emp_sratuse = 1;
	} else {
		$emp_sratuse = 0;
	}

	if (!$emp_name) {
		$error['emp_name'] = 'Employer Name Field required';
	} elseif ($courseCheck) {
		$error['emp_name'] = 'Employer Already Exits';
	} elseif (strlen($emp_name) > 255) {
		$error['course_name'] = 'Course Name Can Not Be More Than 255 Charecters';
	}

	if (!$emp_id) {
		$error['emp_id'] = 'Course Code Field required';
	} elseif ($codeCheck) {
		$error['emp_id'] = 'Course Code Already Exits';
	} elseif (strlen($emp_id) > 255) {
		$error['emp_id'] = 'Course Code Can Not Be More Than 255 Charecters';
	}

	if (strlen($course_description) > 500) {
		$error['course_description'] = 'Employer Code Can Not Be More Than 500 Charecters';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO satt_employer (emp_name, emp_id, city, country, course_description, emp_sratuse) VALUES ('$emp_name', '$emp_id', '$city', '$country', '$course_description','$emp_sratuse')";
		$result = $db->insert($query);
		if ($result != false) {
			die(json_encode(['message' => 'Employer Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}


/*================================================================
		Delete Data into Database
===================================================================*/
// $error['course_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$course_id = $_GET['course_id'];
	if ($course_id) {
		$query = "DELETE FROM satt_courses WHERE id = '$course_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

/*================================================================
		Update Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$course_id = $_GET['course_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($course_id) {
		$query = "UPDATE satt_courses SET course_status = '$status' WHERE id = '$course_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Course Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
