<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-price', 'Software Price');
if (isset($_GET['$software_price_id'])) {
	$$software_price_id = $_GET['$software_price_id'];
	if ($$software_price_id) {
		$query = "SELECT * FROM software_price WHERE id = '$software_price_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Software Price Not Found']));
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$software_price_id = $_GET['software_price_id'];
	if ($software_price_id) {
		$error = array();

		// getting old values
		$old_software_name = $fm->validation($_POST['old_software_name']);
		$old_software_id = $fm->validation($_POST['old_software_id']);
		$old_installation_charge = $fm->validation($_POST['old_installation_charge']);
		$old_demo_url = $fm->validation($_POST['old_demo_url']);
		$old_monthly_charge = $fm->validation($_POST['old_monthly_charge']);
		$old_yearly_charge = $fm->validation($_POST['old_yearly_charge']);
		$old_direct_sell = $fm->validation($_POST['old_direct_sell']);
		$old_total_price = $fm->validation($_POST['old_total_price']);
		$old_agent_commission_one_time = $fm->validation($_POST['old_agent_commission_one_time']);
		$old_agent_commission_monthly = $fm->validation($_POST['old_agent_commission_monthly']);
		$old_discount_offer = $fm->validation($_POST['old_discount_offer']);
		$old_yearly_renew_charge = $fm->validation($_POST['old_yearly_renew_charge']);
		// getting old values

		$software_name = $fm->validation($_POST['software_name']);
		$installation_charge = $fm->validation($_POST['installation_charge']);
		$demo_url = $fm->validation($_POST['demo_url']);
		$monthly_charge = $fm->validation($_POST['monthly_charge']);
		$yearly_charge = $fm->validation($_POST['yearly_charge']);
		$direct_sell = $fm->validation($_POST['direct_sell']);
		$total_price = $fm->validation($_POST['total_price']);
		$agent_commission_one_time = $fm->validation($_POST['agent_commission_one_time']);
		$agent_commission_monthly = $fm->validation($_POST['agent_commission_monthly']);
		$agent_commission_yearly = $fm->validation($_POST['agent_commission_yearly']);
		$discount_offer = $fm->validation($_POST['discount_offer']);
		$yearly_renew_charge = $fm->validation($_POST['yearly_renew_charge']);

		if ($software_name=='') {
			$error['software_name'] = 'Software Name Field required';
		} elseif ($installation_charge=='') {
			$error['installation_charge'] = 'Installation charge Field required';
		} elseif ($demo_url=='') {
			$error['demo_url'] = 'Demo url Field required';
		} elseif ($monthly_charge=='') {
			$error['monthly_charge'] = 'Monthly charge Field required';
		} elseif ($yearly_charge=='') {
			$error['yearly_charge'] = 'Yearly charge Field required';
		} elseif ($direct_sell=='') {
			$error['direct_sell'] = 'Direct sell Field required';
		} elseif ($total_price=='') {
			$error['total_price'] = 'Total price Field required';
		} elseif ($agent_commission_one_time=='') {
			$error['agent_commission_one_time'] = 'Agent commission (one time) Field required';
		} elseif ($agent_commission_monthly=='') {
			$error['agent_commission_monthly'] = 'Agent commission (monthly) Field required';
		} elseif ($agent_commission_yearly=='') {
			$error['agent_commission_yearly'] = 'Agent commission (yearly) Field required';
		} elseif ($discount_offer=='') {
			$error['discount_offer'] = 'Discount offer Field required';
		} elseif ($yearly_renew_charge=='') {
			$error['yearly_renew_charge'] = 'Yearly renew charge Field required';
		}

		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
		else {
			//inserting record
			$query = "INSERT INTO
			software_price_log(software_name, demo_url, installation_charge, monthly_charge, yearly_charge, direct_sell, total_price, agent_commission_one_time, agent_commission_monthly, discount_offer, yearly_renew_charge) VALUES ('$old_software_name','$old_demo_url','$old_installation_charge','$old_monthly_charge','$old_yearly_charge','$old_direct_sell','$old_total_price','$old_agent_commission_one_time','$old_agent_commission_monthly','$old_discount_offer','$old_yearly_renew_charge');";
			$result = $db->insert($query);

			$query = "UPDATE software_price SET
			demo_url='$demo_url',
			installation_charge='$installation_charge',
			monthly_charge='$monthly_charge',
			yearly_charge='$yearly_charge',
			direct_sell='$direct_sell',
			total_price='$total_price',
			agent_commission_one_time='$agent_commission_one_time',
			agent_commission_monthly='$agent_commission_monthly',
			agent_commission_yearly='$agent_commission_yearly',
			discount_offer='$discount_offer',
			yearly_renew_charge='$yearly_renew_charge' WHERE id='$software_price_id';";

			$result = $db->update($query);

			if ($result != false) {
				die(json_encode(['message' => 'Software Price Updated Successfull']));
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

	// $software_status = $_POST['software_status'];
	// $a = explode(',',  $software_status);
	// $software_status_name = $a[0];
	// $software_status_id = $a[1];

	// $language_name = $_POST['language_name'];
	// $developer_name = $_POST['developer_name'];
	// $software_name = $fm->validation($_POST['software_name']);
	// $create_date = $fm->validation($_POST['create_date']);
	// $end_date = $fm->validation($_POST['end_date']);
	// $short_feature = $fm->validation($_POST['short_feature']);
	// $user_manual = $fm->validation($_POST['user_manual']);
	// $condition_details = $fm->validation($_POST['condition_details']);

	// software price details
	$software_name = $fm->validation($_POST['software_name']);
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
	$agent_commission_yearly = $fm->validation($_POST['agent_commission_yearly']);

	if (!$software_name) {
		$error['software_name'] = 'Software Name Field required';
	}
		if (!$demo_url) {
		$error['demo_url'] = 'demo url Field required';
	}
		if (!$installation_charge) {
		$error['installation_charge'] = 'installation charge Field required';
	}
		if (!$monthly_charge) {
		$error['monthly_charge'] = 'monthly charge Field required';
	}
		if (!$yearly_charge) {
		$error['yearly_charge'] = 'yearly charge Field required';
	}
		if (!$direct_sell) {
		$error['direct_sell'] = 'direct sell Field required';
	}
		if (!$total_price) {
		$error['total_price'] = 'total price Field required';
	}
		if (!$agent_commission_one_time) {
		$error['agent_commission_one_time'] = 'agent commission one time Field required';
	}
		if (!$agent_commission_monthly) {
		$error['agent_commission_monthly'] = 'agent commission monthly Field required';
	}
		if (!$agent_commission_yearly) {
		$error['agent_commission_yearly'] = 'agent commission yearly Field required';
	}
		if (!$discount_offer) {
		$error['discount_offer'] = 'discount offer Field required';
	}
		if (!$yearly_renew_charge) {
		$error['yearly_renew_charge'] = 'yearly renew charge Field required';
	}

	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		$query = "INSERT INTO software_price(
			software_name,
			-- software_id,
			demo_url,
			installation_charge,
			monthly_charge,
			yearly_charge,
			direct_sell,
			total_price,
			agent_commission_one_time,
			agent_commission_monthly,
			agent_commission_yearly,
			discount_offer,
			yearly_renew_charge) VALUES (
				'$software_name',
				'$demo_url',
				'$installation_charge',
				'$monthly_charge',
				'$yearly_charge',
				'$direct_sell',
				'$total_price',
				'$agent_commission_one_time',
				'$agent_commission_monthly',
				'$agent_commission_yearly',
				'$discount_offer',
				'$yearly_renew_charge');";

				$result = $db->insert($query);

		if ($result != false) {
			die(json_encode(['message' => 'Software price added Successfull']));
		} else {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		}
			}
}

/*================================================================
		Delate  Data into Database
===================================================================*/
// $error['software_price_name'] = 'Course Name Required';
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

			$query2 = "DELETE FROM software_price_multi WHERE software_id = '$software_details_id'";
			$result2 = $db->delete($query2);

			if ($result2) {
				die(json_encode(['message' => 'Software Language Deleted Successfull']));
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
			die(json_encode(['message' => 'Software Language Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
