<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/graphics-report', 'graphics-report');
// if (isset($_GET['promote_product_id'])) {
// 	$promote_product_id = $_GET['promote_product_id'];
// 	if ($promote_product_id) {
// 		$query = "SELECT * FROM promote_product WHERE id = '$promote_product_id'";
// 		$result = $db->select($query);
// 		if (!$result) {
// 			http_response_code(500);
// 			die(json_encode(['message' => 'Promote Products Not Found']));
// 		}
// 	}
// }

/*================================================================
		Insert Data into Database
		===================================================================*/
		if (isset($_POST['submit'])) {

			$from_date = $_POST['from_date'];
			$to_date = $_POST['to_date'];
			$report_type = $_POST['report_type'];
			$status = $_POST['status'];

			if ($report_type == 'all') {
				$query = "";
			}

				
} 

