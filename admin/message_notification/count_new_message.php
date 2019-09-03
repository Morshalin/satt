<?php
require_once '../../config/config.php';

$admin_id  = $user['id'];
if (isset($_POST['to_user_id_get_info'])) {
	echo json_encode($admin_id);
}