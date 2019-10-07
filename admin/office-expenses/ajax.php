<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/office-expenses', 'office-expenses');
if (isset($_GET['office_expense_id'])) {
	$office_expense_id = $_GET['office_expense_id'];
	if ($office_expense_id) {
		$query = "SELECT * FROM office_expense WHERE id = '$office_expense_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Invoice Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$office_expense_id = $_GET['office_expense_id'];
	if ($office_expense_id) {

	$error = array();
	$invoice_no = $fm->validation($_POST['invoice_no']);
	$invoice_type = $fm->validation($_POST['invoice_type']);
	$name = $fm->validation($_POST['name']);
	$designation = $fm->validation($_POST['designation']);
	$phone = $fm->validation($_POST['phone']);
	$date = $fm->validation($_POST['date']);
	$total = $fm->validation($_POST['total']);


	$description = $_POST['description'];
	$perpose = $_POST['perpose'];
	$amount = $_POST['amount'];

	if (!$name) {
		$error['name'] = 'Name Field required';
	}

	if (!$invoice_type) {
		$error['invoice_type'] = 'Invoice Type Field required';
	}

	if (!$designation) {
		$error['designation'] = 'Designation Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
			$query = "UPDATE office_expense SET 
			name = '$name',
			invoice_type = '$invoice_type',
			designation = '$designation',
			phone = '$phone',
			`date` = '$date',
			total = '$total' WHERE id='$office_expense_id'";
			$result = $db->update($query);

			if ($result) {
				$query1 = "DELETE FROM office_expense_info WHERE office_expense_id = '$office_expense_id'";
				$result1 = $db->delete($query1);
				if ($result1) {
					for ($i = 0; $i < count($description); $i++) {
					$sql2 = "INSERT INTO office_expense_info(office_expense_id, description, perpose, amount) VALUES('$office_expense_id','$description[$i]', '$perpose[$i]', '$amount[$i]')";
					$insertrow1 = $db->insert($sql2);
				}
			}
				die(json_encode(['message' => 'Invoice Updated Successfull']));
			}else{
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
	$invoice_no = $fm->validation($_POST['invoice_no']);
	$invoice_type = $fm->validation($_POST['invoice_type']);
	$name = $fm->validation($_POST['name']);
	$designation = $fm->validation($_POST['designation']);
	$phone = $fm->validation($_POST['phone']);
	$date = $fm->validation($_POST['date']);
	$total = $fm->validation($_POST['total']);


	$description = $_POST['description'];
	$perpose = $_POST['perpose'];
	$amount = $_POST['amount'];

	if (!$name) {
		$error['name'] = 'Name Field required';
	}

	if (!$invoice_type) {
		$error['invoice_type'] = 'Invoice Type Field required';
	}

	if (!$designation) {
		$error['designation'] = 'Designation Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {

		$query = "INSERT INTO office_expense (name, designation, phone, `date`, invoice_id, total, invoice_type ) VALUES ('$name','$designation','$phone', '$date', '$invoice_no','$total','$invoice_type')";
		$last_id = $db->custom_insert($query);
		if ($last_id) {

			for ($i = 0; $i < count($description); $i++) {
					$sql2 = "INSERT INTO office_expense_info(office_expense_id, description, perpose, amount) VALUES('$last_id','$description[$i]', '$perpose[$i]', '$amount[$i]')";
					$insertrow1 = $db->insert($sql2);
				}

			if ($insertrow1 != false) {
				die(json_encode(['message' => 'Invoice Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		} //last id end
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$office_expense_id = $_GET['office_expense_id'];
	if ($office_expense_id) {
		$query = "DELETE FROM office_expense WHERE id = '$office_expense_id'";
		$result = $db->delete($query);
		if ($result) {
			$query1 = "DELETE FROM office_expense_info WHERE office_expense_id = '$office_expense_id'";
			$result1 = $db->delete($query1);
			if ($result1) {
				die(json_encode(['message' => 'Developer Deleted Successfull']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}

