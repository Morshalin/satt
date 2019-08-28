<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL . '/message-with-customer');
## Read value
$draw = $_GET['draw'];
$row = $_GET['start'];
$rowperpage = $_GET['length']; // Rows display per page
$columnIndex = $_GET['order'][0]['column']; // Column index
$columnName = $_GET['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_GET['order'][0]['dir']; // asc or desc
$searchValue = $_GET['search']['value']; // Search value
if ($columnName == 'DT_RowIndex') {
	$columnName = 'id';
}
$agent_id  = $user['id']; 

/*==============================================================================
## Search
=================================================================================*/
$searchQuery = " ";
if ($searchValue != '') {
	$searchQuery = " and (name like '%" . $searchValue . "%' or email like '%" . $searchValue . "%' or
        number like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from satt_customer_informations");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from satt_customer_informations WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/

$query = "SELECT *
FROM satt_customer_informations
INNER JOIN agent_client ON satt_customer_informations.id=agent_client.client_id WHERE agent_client.agent_id = '$agent_id' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) { 

		$to_user_id_get_info = $row['client_id'];
		$get_chat = $db->select("select count(*) as all_count from agent_customer_chat WHERE to_whom ='agent' and to_user_id = '$agent_id' and from_user_id = '$to_user_id_get_info' and seen_status_agent = '0';")->fetch_assoc();

		if ($get_chat['all_count']>0) {
			$badge_color = "badge-danger";
		}else{
			$badge_color = "badge-success";
		}


      
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"name" => $row['name'],
			"email" => $row['email'],
			"number" => $row['number'],
			"unread" => '<badge class="badge '.$badge_color.'">'.$get_chat['all_count'].'</badge>',
			"action" => '
       <button id="" data-touserid="'.$row['client_id'].'" data-tousername="'.$row['name'].'" class="btn btn-sm btn-success start_chat" data-agent_id="'.$agent_id.'">Start Chat</button>
        ',
		);
$i++;
}
}
/*===========================================================
## Response
=============================================================*/
$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => $totalRecordwithFilter,
	"iTotalDisplayRecords" => $totalRecords,
	"aaData" => $data,
);

echo json_encode($response);
