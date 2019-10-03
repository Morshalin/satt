<?php
require_once '../config/config.php';

if (isset($_GET['soft_avaliable_id'])) {
	$remove_id = $_GET['soft_avaliable_id'];
	$query = "UPDATE satt_order_products SET msg_status = 1 where id = '$remove_id'";
	$result = $db->update($query);
	
}

if (isset($_GET['soft_id'])) {
	$remove_id = $_GET['soft_id'];
	$query = "UPDATE new_product_order SET msg_status = 1 where id = '$remove_id'";
	$result = $db->update($query);
}

?>