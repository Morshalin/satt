<?php
require_once '../../config/config.php';



if (isset($_POST['to_user_id'])) {
	$to_user_id = $_POST['to_user_id'];
	$admin_id = $_POST['admin_id'];
	$chat_message = $fm->validation($_POST['chat_message']);

	$from_whom = 'admin';
	$to_whom = 'agent';

	$query = "SELECT * FROM agent_list WHERE id='$to_user_id'";
	$get_agent_info = $db->select($query);
	if ($get_agent_info) {
		$get_agent_info = $get_agent_info->fetch_assoc();
		$agent_name = $get_agent_info['name'];
	}

if ($chat_message !='') {
	$query = "INSERT INTO agent_admin_chat 
			  (from_user_id,from_whom,to_user_id,to_whom,chat_message,seen_status_agent,seen_status_admin,date)
			  VALUES 
			  ('$admin_id',	'$from_whom',	'$to_user_id',	'$to_whom',	'$chat_message','0','1',now())";
}else{
	die();
}

	$insert_chat = $db->insert($query);
	if ($insert_chat) {
		$query = "SELECT * FROM agent_admin_chat WHERE (from_user_id = '$admin_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$admin_id')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			$output = '<ul class="list-unstyled">';
			while ($row = $get_chat_history->fetch_assoc()) {
				$user_name = '';
				if ($row['from_user_id'] == $admin_id &&  $row['from_whom']=='admin') {
					$user_name = '<b class="text-success">You</b>';
				}else{
					$user_name = '<b class="text-danger" align="right">'.$agent_name.'</b>';
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
	$admin_id_get_info = $_POST['admin_id_get_info'];


	$query = "SELECT * FROM agent_list WHERE id='$to_user_id_get_info'";
	$get_agent_info = $db->select($query);
	if ($get_agent_info) {
		$get_agent_info = $get_agent_info->fetch_assoc();
		$agent_name = $get_agent_info['name'];
	}


$query = "SELECT * FROM agent_admin_chat WHERE (from_user_id = '$admin_id_get_info' AND to_user_id = '$to_user_id_get_info') OR (from_user_id = '$to_user_id_get_info' AND to_user_id = '$admin_id_get_info')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			
		$output = '<ul class="list-unstyled">';
				while ($row = $get_chat_history->fetch_assoc()) {
					$user_name = '';
					if ($row['from_user_id'] == $admin_id_get_info &&  $row['from_whom']=='admin') {
						$user_name = '<b class="text-success">You</b>';
					}else{
						$user_name = '<b class="text-danger">'.$agent_name.'</b>';
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

/*
=============================================================
				CHANGING SEEN STATUS 
=============================================================
*/
if (isset($_POST['to_user_id_seen_status'])) {
	$to_user_id = $_POST['to_user_id_seen_status'];
	$admin_id = $_POST['admin_id_seen_status'];

	$query = "UPDATE agent_admin_chat SET seen_status_admin = '1' WHERE (from_user_id = '$admin_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$admin_id')";

	$update_seen = $db->update($query);
	if ($update_seen) {
		echo json_encode('Md. Abul Khair Sohag');
	}
}

?>