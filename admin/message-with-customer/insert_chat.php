<?php
require_once '../../config/config.php';



if (isset($_POST['to_user_id'])) {
	$to_user_id = $_POST['to_user_id'];
	$agent_id = $_POST['agent_id'];
	$chat_message = $_POST['chat_message'];

	$from_whom = 'agent';
	$to_whom = 'client';

	$query = "SELECT * FROM satt_customer_informations WHERE id='$to_user_id'";
	$get_client_info = $db->select($query);
	if ($get_client_info) {
		$get_client_info = $get_client_info->fetch_assoc();
		$client_name = $get_client_info['name'];
	}

if ($chat_message !='') {
	$query = "INSERT INTO agent_customer_chat 
			  (from_user_id,from_whom,to_user_id,to_whom,chat_message,seen_status_agent,seen_status_client,date)
			  VALUES 
			  ('$agent_id',	'$from_whom',	'$to_user_id',	'$to_whom',	'$chat_message','1','0',now())";
}else{
	die();
}

	$insert_chat = $db->insert($query);
	if ($insert_chat) {
		$query = "SELECT * FROM agent_customer_chat WHERE (from_user_id = '$agent_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$agent_id')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			$output = '<ul class="list-unstyled">';
			while ($row = $get_chat_history->fetch_assoc()) {
				$user_name = '';
				if ($row['from_user_id'] == $agent_id) {
					$user_name = '<b class="text-success">you</b>';
				}else{
					$user_name = '<b class="text-success">'.$client_name.'</b>';
				}
				$output .= '

					<li style="border-bottom:1px dotted #ccc">

						<p>'.$user_name.' - '.$row['chat_message'].'</p>
							<div align="right">
								- <small><em>'.$row['date'].'</em></small>
							</div>
					</li>

				';
			}
			$output .= '</ul>';
		}
	}

	echo json_encode($output);


}


/*

================================================
	GETTING CHAT INFORMATION
================================================

*/

if (isset($_POST['to_user_id_get_info'])) {
	$to_user_id_get_info = $_POST['to_user_id_get_info'];
	$agent_id_get_info = $_POST['agent_id_get_info'];


	$query = "SELECT * FROM satt_customer_informations WHERE id='$to_user_id_get_info'";
	$get_client_info = $db->select($query);
	if ($get_client_info) {
		$get_client_info = $get_client_info->fetch_assoc();
		$client_name = $get_client_info['name'];
	}


$query = "SELECT * FROM agent_customer_chat WHERE (from_user_id = '$agent_id_get_info' AND to_user_id = '$to_user_id_get_info') OR (from_user_id = '$to_user_id_get_info' AND to_user_id = '$agent_id_get_info')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			
		$output = '<ul class="list-unstyled">';
				while ($row = $get_chat_history->fetch_assoc()) {
					$user_name = '';
					if ($row['from_user_id'] == $agent_id_get_info) {
						$user_name = '<b class="text-success">you</b>';
					}else{
						$user_name = '<b class="text-success">'.$client_name.'</b>';
					}
					$output .= '

						<li style="border-bottom:1px dotted #ccc">

							<p>'.$user_name.' - '.$row['chat_message'].'</p>
								<div align="right">
									- <small><em>'.$row['date'].'</em></small>
								</div>
						</li>

					';
				}
				$output .= '</ul>';
		}
		echo json_encode($output);
}

?>