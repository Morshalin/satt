<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/promote-product', 'Promote Products');
if (isset($_GET['promote_product_id'])) {
	$promote_product_id = $_GET['promote_product_id'];
	if ($promote_product_id) {
		$query = "SELECT * FROM promote_product WHERE id = '$promote_product_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Promote Products Not Found']));
		}
	}
}
/*================================================================
	Update data into database
	===================================================================*/

	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
		$promote_product_id = $_GET['promote_product_id'];
		if ($promote_product_id) {
			$error = array();

			$product_name = $_POST['product_name'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$end_date = $fm->validation($_POST['end_date']);
			$discount_amt = $fm->validation($_POST['discount_amt']);
			$amount_type = $fm->validation($_POST['amount_type']);

			if (isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}

			if (!$product_name) {
				$error['product_name'] = 'Product Name Field required';
			}
			if (!$start_date) {
				$error['start_date'] = 'Start Date Field required';
			}
			if (!$end_date) {
				$error['end_date'] = 'End Date Field required';
			}
			if (!$discount_amt) {
				$error['discount_amt'] = 'Discount Amount Field required';
			}
			if (!$amount_type) {
				$error['amount_type'] = 'Amount Type Field required';
			}

			if ($error) {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			} else {
				$query = "UPDATE promote_product SET 

				start_date = '$start_date',
				end_date = '$end_date',
				discount_amt = '$discount_amt',
				amount_type = '$amount_type',
				status = '$status' WHERE id='$promote_product_id'";
				$result = $db->update($query);

				if ($result) {
				// multi Language insert
					$querylang = "DELETE FROM promote_product_multi WHERE promote_product_id = '$promote_product_id'";
					$resultlang = $db->delete($querylang);
					if ($resultlang) {
						for ($i = 0; $i < count($product_name); $i++) {
							$sql2 = "INSERT INTO promote_product_multi(promote_product_id,software_id) VALUES('$promote_product_id','$product_name[$i]')";
							$insertrow1 = $db->insert($sql2);
						}
					}
					die(json_encode(['message' => 'Promote Products Updated Successfull']));
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

			$product_name = $_POST['product_name'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$end_date = $fm->validation($_POST['end_date']);
			$discount_amt = $fm->validation($_POST['discount_amt']);
			$amount_type = $fm->validation($_POST['amount_type']);


			if (isset($_POST['status'])) {
				$status = 1;
			} else {
				$status = 0;
			}

			if (!$product_name) {
				$error['product_name'] = 'Product Name Field required';
			}
			if (!$start_date) {
				$error['start_date'] = 'Start Date Field required';
			}
			if (!$end_date) {
				$error['end_date'] = 'End Date Field required';
			}
			if (!$discount_amt) {
				$error['discount_amt'] = 'Discount Amount Field required';
			}
			if (!$amount_type) {
				$error['amount_type'] = 'Amount Type Field required';
			}

			if ($error) {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			} else {
				$query = "INSERT INTO promote_product (start_date,end_date,discount_amt,amount_type, status) VALUES ('$start_date','$end_date','$discount_amt','$amount_type', '$status')";
				$last_id = $db->custom_insert($query);
				if ($last_id) {
			// multi Language insert
					for ($i = 0; $i < count($product_name); $i++) {
						$sql2 = "INSERT INTO promote_product_multi(promote_product_id,software_id) VALUES('$last_id','$product_name[$i]')";
						$insertrow1 = $db->insert($sql2);
					}

					die(json_encode(['message' => 'Software Added Successfull']));

				} else {
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
				}
	} //else end
} 

/*================================================================
		Delate  Data into Database
		===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
		if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
			$promote_product_id = $_GET['promote_product_id'];
			if ($promote_product_id) {
				$query = "DELETE FROM promote_product WHERE id = '$promote_product_id'";
				$result = $db->delete($query);
				$query1 = "DELETE FROM promote_product_multi WHERE promote_product_id = '$promote_product_id'";
				$result1 = $db->delete($query1);
				if ($result) {
					die(json_encode(['message' => 'Promote Products Deleted Successfull']));
				}
			}
			http_response_code(500);
			die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
		}



		if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
			$promote_product_id = $_GET['promote_product_id'];
			$status = $_GET['status'];
			$status = $status ? 0 : 1;

			if ($promote_product_id) {
				$query = "UPDATE promote_product SET status = '$status' WHERE id = '$promote_product_id'";
				$result = $db->delete($query);
				if ($result) {
					die(json_encode(['message' => 'Software Language Status Changed Successfull']));
				}
			}
			http_response_code(500);
			die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

		}
