<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details', 'Software Language');
if (isset($_GET['software_language_id'])) {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$query = "SELECT * FROM software_language WHERE id = '$software_language_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Language Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$error = array();
		$software_language_name = $fm->validation($_POST['software_language_name']);

		$courseCheck = $fm->dublicateCheck('software_language', 'software_language_name', $software_language_name);

		if (isset($_POST['status'])) {
			$status = 1;
		} else {
			$status = 0;
		}

		if (!$software_language_name) {
			$error['software_language_name'] = 'Software Language Name Field required';
		} elseif ($courseCheck) {
			$course_row = $courseCheck->fetch_assoc();
			if ($course_row['id'] != $software_language_id) {
				$error['software_language_name'] = 'Software Language Already Exists';
			}

		} elseif (strlen($software_language_name) > 255) {
			$error['software_language_name'] = 'Software Language Name Can Not Be More Than 255 Charecters';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE software_language SET software_language_name = '$software_language_name', status = '$status' WHERE id='$software_language_id'";
			$result = $db->update($query);
			if ($result != false) {
				die(json_encode(['message' => 'Software Language Updated Successfull']));
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

	$software_status = $fm->validation($_POST['software_status']);
	$a = explode(',',  $software_status);
	$software_status_name = $a[0];
	$software_status_id = $a[1];

	$language_name = $fm->validation($_POST['language_name']);
	$aa = explode(',',  $language_name);
	$software_language_name = $aa[0];
	$software_language_id = $aa[1];

	$developer_name = $fm->validation($_POST['developer_name']);
	$aaa = explode(',',  $developer_name);
	$developer_name1 = $aaa[0];
	$developer_id = $aaa[1];

	$software_name = $fm->validation($_POST['software_name']);
	$create_date = $fm->validation($_POST['create_date']);
	$end_date = $fm->validation($_POST['end_date']);
	$short_feature = $fm->validation($_POST['short_feature']);
	$user_manual = $fm->validation($_POST['user_manual']);
	$condition_details = $fm->validation($_POST['condition_details']);

	// software price details
	$demo_url = $fm->validation($_POST['demo_url']);
	$installation_charge = $fm->validation($_POST['installation_charge']);
	$monthly_charge = $fm->validation($_POST['monthly_charge']);
	$yearly_charge = $fm->validation($_POST['yearly_charge']);
	$direct_sell = $fm->validation($_POST['direct_sell']);
	$total_price = $fm->validation($_POST['total_price']);
	$agent_commission_one_time = $fm->validation($_POST['agent_commission_one_time']);
	$agent_commission_monthly = $fm->validation($_POST['agent_commission_monthly']);
	$discount_offer = $fm->validation($_POST['discount_offer']);
	$yearly_renew_charge = $fm->validation($_POST['yearly_renew_charge']);


	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$software_name) {
		$error['software_name'] = 'Software Name Field required';
	}
		if (!$software_status) {
		$error['software_status'] = 'Software Status Field required';
	}
		if (!$language_name) {
		$error['language_name'] = 'Software Language Field required';
	}
		if (!$developer_name) {
		$error['developer_name'] = 'Developer Name Field required';
	}
		if (!$create_date) {
		$error['create_date'] = 'Create Date Field required';
	}
		if (!$short_feature) {
		$error['short_feature'] = 'Short Feature Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO software_details (software_name,software_status_name,software_status_id,create_date,end_date,short_feature,user_manual,condition_details, status) VALUES ('$software_name','$software_status_name','$software_status_id','$create_date','$end_date','$short_feature','$user_manual','$condition_details', '$status')";
		$result = $db->insert($query);

		
		if ($result != false) {
			die(json_encode(['message' => 'Software Language Added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
	}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$software_language_id = $_GET['software_language_id'];
	if ($software_language_id) {
		$query = "DELETE FROM software_language WHERE id = '$software_language_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Language Deleted Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$software_language_id = $_GET['software_language_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($software_language_id) {
		$query = "UPDATE software_language SET status = '$status' WHERE id = '$software_language_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Language Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
