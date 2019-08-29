<?php
require_once '../../config/config.php';



if (isset($_POST['to_user_id'])) {
	$to_user_id = $_POST['to_user_id'];
	$customer_id = $_POST['customer_id'];
	$chat_message = $_POST['chat_message'];

	$from_whom = 'client';
	$to_whom = 'admin';

	$query = "SELECT * FROM satt_admins WHERE id='$to_user_id'";
	$get_admin_info = $db->select($query);
	if ($get_admin_info) {
		$get_admin_info = $get_admin_info->fetch_assoc();
		$admin_name = $get_admin_info['first_name'].' '.$get_admin_info['last_name'];
	}

if ($chat_message !='') {
	$query = "INSERT INTO admin_customer_chat 
			  (from_user_id,from_whom,to_user_id,to_whom,chat_message,seen_status_customer,seen_status_admin,date)
			  VALUES 
			  ('$customer_id',	'$from_whom',	'$to_user_id',	'$to_whom',	'$chat_message','1','0',now())";
}else{
	die();
}

	$insert_chat = $db->insert($query);
	if ($insert_chat) {
		$query = "SELECT * FROM admin_customer_chat WHERE (from_user_id = '$customer_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$customer_id')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			$output = '<ul class="list-unstyled">';
			while ($row = $get_chat_history->fetch_assoc()) {
				$user_name = '';
				if ($row['from_user_id'] == $customer_id  && $row['from_whom']=='client') {
					$user_name = '<b class="text-success">You</b>';
				}else{
					$user_name = '<b class="text-danger">'.$admin_name.'</b>';
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
	$customer_id_get_info = $_POST['customer_id_get_info'];


	$query = "SELECT * FROM satt_admins WHERE id='$to_user_id_get_info'";
	$get_admin_info = $db->select($query);
	if ($get_admin_info) {
		$get_admin_info = $get_admin_info->fetch_assoc();
		$admin_name = $get_admin_info['first_name'].' '.$get_admin_info['last_name'];
	}


$query = "SELECT * FROM admin_customer_chat WHERE (from_user_id = '$customer_id_get_info' AND to_user_id = '$to_user_id_get_info') OR (from_user_id = '$to_user_id_get_info' AND to_user_id = '$customer_id_get_info')  ORDER BY id DESC";
		$get_chat_history = $db->select($query);

		if ($get_chat_history) {
			
		$output = '<ul class="list-unstyled">';
				while ($row = $get_chat_history->fetch_assoc()) {
					$user_name = '';
					if ($row['from_user_id'] == $customer_id_get_info && $row['from_whom']=='client') {
						$user_name = '<b class="text-success">You</b>';
					}else{
						$user_name = '<b class="text-danger">'.$admin_name.'</b>';
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
	$customer_id = $_POST['customer_id_seen_status'];

	$query = "UPDATE admin_customer_chat SET seen_status_customer = '1' WHERE (from_user_id = '$customer_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$customer_id')";

	$update_seen = $db->update($query);
	if ($update_seen) {
		echo json_encode('Md. Abul Khair Sohag');
	}
}

?>