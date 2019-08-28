<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/message-with-agent');
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
$admin_id  = $user['id']; 

/*==============================================================================
## Search
=================================================================================*/
$searchQuery = " ";
if ($searchValue != '') {
	$searchQuery = " and (name like '%" . $searchValue . "%' or mobile_no like '%" . $searchValue . "%' or
	interested_up like '%" . $searchValue . "%'or email like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from agent_list");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from agent_list WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/

$query = "select * from agent_list WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$to_user_id_get_info = $row['id'];
		$get_chat = $db->select("select count(*) as all_count from agent_admin_chat WHERE to_whom ='admin' and to_user_id = '$admin_id' and from_user_id = '$to_user_id_get_info' and seen_status_admin = '0';")->fetch_assoc();

		if ($get_chat['all_count']>0) {
			$badge_color = "badge-danger";
		}else{
			$badge_color = "badge-success";
		}
		
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"name" => $row['name'],
			"email" => $row['email'],
			"mobile_no" => $row['mobile_no'],
			"interested_up" => $row['interested_up'],
			"unread" => '<badge class="badge '.$badge_color.'">'.$get_chat['all_count'].'</badge>',
			"action" => '
			<button id="" data-touserid="'.$row['id'].'" data-tousername="'.$row['name'].'" class="btn btn-sm btn-success start_chat" data-admin_id="'.$admin_id.'">Start Chat</button>
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
