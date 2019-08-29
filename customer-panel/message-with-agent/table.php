<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL.'/message-with-agent');
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
}else if($columnName == 'name'){
  $columnName = 'client_name';
}
$customer_id  = $user['id']; 

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

$sel = $db->select("select count(*) as allcount from agent_client WHERE client_id = '$customer_id'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from agent_client WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/

$query = "select * from agent_client WHERE client_id ='$customer_id' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$to_user_id_get_info = $row['agent_id'];
		$get_chat = $db->select("select count(*) as all_count from agent_customer_chat WHERE to_whom ='client' and to_user_id = '$customer_id' and from_user_id = '$to_user_id_get_info' and seen_status_client = '0';")->fetch_assoc();

		if ($get_chat['all_count']>0) {
			$badge_color = "badge-danger";
		}else{
			$badge_color = "badge-success";
		}
		$query = "SELECT * FROM agent_list WHERE id = '$to_user_id_get_info'";
		$get_agent = $db->select($query);

		$agent_name = '';
		$agent_email = '';
		$agent_mobile_no = '';
		$agent_upazila = '';
		if ($get_agent) {
			while ($agent = $get_agent->fetch_assoc()) {
				$agent_id = $agent['id'];
				$agent_name = $agent['name'];
				$agent_email = $agent['email'];
				$agent_mobile_no = $agent['mobile_no'];
				$agent_upazila = $agent['interested_up'];
			}
		}
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"name" => $agent_name,
			"email" => $agent_email,
			"mobile_no" => $agent_mobile_no,
			"interested_up" => $agent_upazila,
			"unread" => '<badge class="badge '.$badge_color.'">'.$get_chat['all_count'].'</badge>',
			"action" => '
			<button id="" data-touserid="'.$agent_id.'" data-tousername="'.$agent_name.'" class="btn btn-sm btn-success start_chat" data-customer_id="'.$customer_id.'">Start Chat</button>
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
