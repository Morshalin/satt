<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details', 'Software Details');
if (isset($_GET['software_details_id'])) {
	$software_details_id = $_GET['software_details_id'];
	if ($software_details_id) {
		$query = "SELECT * FROM software_details WHERE id = '$software_details_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Details Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_details_id = $_GET['software_details_id'];
	if ($software_details_id) {
		$error = array();
		$software_status = $_POST['software_status'];
		$a = explode(',',  $software_status);
		$software_status_name = $a[0];
		$software_status_id = $a[1];

		$language_name = $_POST['language_name'];
		$developer_name = $_POST['developer_name'];
		$software_name = $fm->validation($_POST['software_name']);
		$create_date = $fm->validation($_POST['create_date']);
		$end_date = $fm->validation($_POST['end_date']);
		$update_date = date('d-M-Y');
		$short_feature = $fm->validation($_POST['short_feature']);
		$user_manual = $fm->validation($_POST['user_manual']);
		$condition_details = $fm->validation($_POST['condition_details']);

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
			$query = "UPDATE software_details SET 

			software_name = '$software_name',
			software_status_name = '$software_status_name',
			software_status_id = '$software_status_id',
			create_date = '$create_date',
			end_date = '$end_date',
			update_date = '$update_date',
			short_feature = '$short_feature',
			user_manual = '$user_manual',
			condition_details = '$condition_details',
			 status = '$status' WHERE id='$software_details_id'";
			$result = $db->update($query);

			if ($result) {
				// multi Language insert
				$querylang = "DELETE FROM software_language_multi WHERE software_id = '$software_details_id'";
				$resultlang = $db->delete($querylang);
				if ($resultlang) {
						for ($i = 0; $i < count($language_name); $i++) {
						$sql2 = "INSERT INTO software_language_multi(software_id,language_id) VALUES('$software_details_id','$language_name[$i]')";
						$insertrow1 = $db->insert($sql2);
							}
					}
				// multi Developer insert
				$querydeve = "DELETE FROM software_develope_by WHERE software_id = '$software_details_id'";
				$resultdeve = $db->delete($querydeve);
				if ($resultdeve) {
						for ($i = 0; $i < count($developer_name); $i++) {
								$sql2 = "INSERT INTO software_develope_by(software_id,developer_id) VALUES('$software_details_id','$developer_name[$i]')";
								$insertrow1 = $db->insert($sql2);
							}
					}
					die(json_encode(['message' => 'Software Details Updated Successfull']));
			}else {
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

	$software_status = $_POST['software_status'];
	$a = explode(',',  $software_status);
	$software_status_name = $a[0];
	$software_status_id = $a[1];

	$language_name = $_POST['language_name'];
	$developer_name = $_POST['developer_name'];
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
		$last_id = $db->custom_insert($query);
		if ($last_id) {
			// multi Language insert
			for ($i = 0; $i < count($language_name); $i++) {
					$sql2 = "INSERT INTO software_language_multi(software_id,language_id) VALUES('$last_id','$language_name[$i]')";
					$insertrow1 = $db->insert($sql2);
				}
			// multi Developer insert
			for ($i = 0; $i < count($developer_name); $i++) {
					$sql2 = "INSERT INTO software_develope_by(software_id,developer_id) VALUES('$last_id','$developer_name[$i]')";
					$insertrow1 = $db->insert($sql2);
				}

			$query = "INSERT INTO software_price (software_name,software_id,demo_url,installation_charge,monthly_charge,yearly_charge,direct_sell,total_price, agent_commission_one_time,agent_commission_monthly,discount_offer,yearly_renew_charge) VALUES ('$software_name','$last_id','$demo_url','$installation_charge','$monthly_charge','$yearly_charge','$direct_sell','$total_price', '$agent_commission_one_time','$agent_commission_monthly','$discount_offer','$yearly_renew_charge')";
			$result = $db->insert($query);

			if ($result != false) {
				die(json_encode(['message' => 'Software Added Successfull']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		} //last id end
	} //else end
} 

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$software_details_id = $_GET['software_details_id'];
	if ($software_details_id) {
		$query = "DELETE FROM software_details WHERE id = '$software_details_id'";
		$result = $db->delete($query);
		if ($result) {
			$query = "DELETE FROM software_price WHERE software_id = '$software_details_id'";
			$result = $db->delete($query);

			$query1 = "DELETE FROM software_develope_by WHERE software_id = '$software_details_id'";
			$result1 = $db->delete($query1);

			$query2 = "DELETE FROM software_language_multi WHERE software_id = '$software_details_id'";
			$result2 = $db->delete($query2);

			if ($result2) {
				die(json_encode(['message' => 'Software Deleted Successfull']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$software_details_id = $_GET['software_details_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($software_details_id) {
		$query = "UPDATE software_details SET status = '$status' WHERE id = '$software_details_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Software Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
