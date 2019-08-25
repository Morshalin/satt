<?php
require_once '../../config/config.php';



ajax();
// Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_product_id'])) {
	$agent_product_id = $_GET['agent_product_id'];
	if ($agent_product_id) {
		$query = "DELETE FROM agent_selling_product_list WHERE id = '$agent_product_id'";
		$result = $db->delete($query);

		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}else{
			die(json_encode(['message' => 'Product Deleted Successfully']));
		}
		
	}
}


if (isset($_GET['agent_client_id'])) {
	$agent_client_id = $_GET['agent_client_id'];
	if ($agent_client_id) {
		$query = "DELETE FROM agent_client WHERE id = '$agent_client_id'";
		$result = $db->delete($query);
      
            die(json_encode(['message' => 'Client Deleted Successfully']));
      
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}


		
	}
}

if (isset($_GET['agent_note_id'])) {
	$agent_note_id = $_GET['agent_note_id'];
	if ($agent_note_id) {
		$query = "DELETE FROM agent_note WHERE id = '$agent_note_id'";
		$result = $db->delete($query);
      
            die(json_encode(['message' => 'Note Deleted Successfully']));
      
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Note Not Found']));
		}


		
	}
}

if (isset($_GET['agent_contact_id'])) {
	$agent_contact_id = $_GET['agent_contact_id'];
	if ($agent_contact_id) {
		$query = "DELETE FROM agent_contact WHERE id = '$agent_contact_id'";
		$result = $db->delete($query);
      
            die(json_encode(['message' => 'Contact Info Is Deleted Successfully']));
      
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Contact Info Not Found']));
		}


		
	}
}

if (isset($_GET['agent_provided_gift_id'])) {
	$agent_id = $_GET['agent_id'];
	$agent_provided_gift_id = $_GET['agent_provided_gift_id'];

	if ($agent_provided_gift_id && $agent_id) {
		$query = "SELECT * FROM agent_provide_gift WHERE id = '$agent_provided_gift_id'";
		$gift_cost_point = $db->select($query)->fetch_assoc();
		$gift_cost_point = $gift_cost_point['cost_point'];

		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$agent_point = $db->select($query)->fetch_assoc();
		$agent_point = $agent_point['points'];

		$updated_point = (int)$agent_point + (int)$gift_cost_point ;

		$query = "DELETE FROM agent_provide_gift WHERE id = '$agent_provided_gift_id'";
		$result = $db->delete($query);
      
            
      
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Gift Info Not Found']));
		}else{
			$query = "UPDATE agent_list set points = '$updated_point' WHERE id = '$agent_id'";
			$update_agent_point = $db->update($query);
			if ($update_agent_point) {
				die(json_encode(['message' => "Gift Deleted Successfully"]));
			}
			
		}


		
	}
}



if (isset($_GET['agent_target_id'])) {
	// $agent_id = $_GET['agnt_id'];
	$agent_target_id = $_GET['agent_target_id'];

	if ($agent_target_id) {

		$query = "DELETE FROM agent_target WHERE id = '$agent_target_id'";
		$result = $db->delete($query);

		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Target Info Not Found']));
		}else{
			die(json_encode(['message' => "Target Deleted Successfully"]));
		}
		
	}
}


?>