<?php
require_once '../../config/config.php';



ajax();
// Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_product_id'])) {
	$agent_product_id = $_GET['agent_product_id'];
	if ($agent_product_id) {
		$query = "DELETE FROM agent_selling_product_list WHERE id = '$agent_product_id'";
		$result = $db->delete($query);
      
            die(json_encode(['message' => 'Product Deleted Successfully']));
      
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
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


?>