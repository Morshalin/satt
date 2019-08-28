<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message-with-admin', 'message-with-admin');

if (isset($_GET['cust_id'])) {
    $cust_id = $_GET['cust_id'];
    $querys ="SELECT * FROM satt_extra_office_notes where id = '$cust_id'";
    $values = $db->select($querys);



 $querys = "SELECT * FROM satt_customer_interestedservice where status=1";
$results = $db->select($querys);

$query_ins= "SELECT * FROM satt_extra_interested_service WHERE cutomer_details_id = '$cust_id'";
$select1= $db->select($query_ins);
$interested_services_id = [];
if ($select1) {
  $j=0;
  while ($row2 = $select1->fetch_assoc()) {
   $interested_services_id[$j] = $row2['interested_services_id'];
   $j++;
}
}
		$selected = '';
		$options = '';
if ($results) {
    while ($rows = $results->fetch_assoc()) { 
    	if(array_search($rows['id'], $interested_services_id) !== false) {
    		$selected = 'selected';
    	} else{
    		$selected = '';
    	}
       $options .= '<option value="'.$rows['id'].'" '.$selected.' >'.$rows['services']. '</option> '; 

   } }










$querys = "SELECT * FROM software_details where status=1";
$result2 = $db->select($querys);

$query_soft= "SELECT * FROM satt_extra__software_category WHERE cutomer_details_id = '$cust_id'";
$select2= $db->select($query_soft);
$software_details_id = [];
if ($select2) {
  $i=0;
  while ($row2 = $select2->fetch_assoc()) {
   $software_details_id[$i] = $row2['software_id'];
   $i++;
}
}
		$selected1 = '';
		$option = '';
if ($result2) {
    while ($row = $result2->fetch_assoc()) { 
    	if(array_search($row['id'], $software_details_id) !== false) {
    		$selected1 = 'selected';
    	} else{
    		$selected1 = '';
    	}
       $option .= '<option value="'.$row['id'].'" '.$selected1.' >'.$row['software_name']. '</option> '; 

   } }

    if ($values) {
        $data = $values->fetch_assoc();
        echo json_encode(['office_notes'=>$data,'options'=>$options,'option'=>$option]);
        // echo json_encode($data);
    }
}

?>