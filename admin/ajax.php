<?php
require_once '../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL, 'Notification');

if (isset($_GET['update_id'])) {
	$update_id = $_GET['update_id'];
	//die($update_id);
	if ($update_id) {
		$update_query = "UPDATE satt_next_contacted set status = 1 WHERE id ='$update_id'";
		$result = $db->update($update_query);
		if($result){
			die(json_encode(['message' => 'Notification Remove Successfully']));
		}else {
			http_response_code(500);
			die(json_encode(['message' => 'Notification Not Found']));
		}
	}
}

if (isset($_GET['update_id_introduces'])) {
	$update_id_introduces = $_GET['update_id_introduces'];
	//die($update_id_introduces);
	if ($update_id_introduces) {
		$update_query = "UPDATE satt_next_contacted set status = 1 WHERE id ='$update_id_introduces'";
		$result = $db->update($update_query);
		if($result){
			die(json_encode(['message' => 'Notification Remove Successfully']));
		}else {
			http_response_code(500);
			die(json_encode(['message' => 'Notification Not Found']));
		}
	}
}


?>
