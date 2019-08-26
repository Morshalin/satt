<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL . '/message-with-admin');
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
  $columnName = 'first_name';
}

/*==============================================================================
## Search
=================================================================================*/
$searchQuery = " ";
if ($searchValue != '') {
	$searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or
        email like '%" . $searchValue . "%' ) ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from satt_admins");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from satt_admins WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "select * from satt_admins WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
      
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"name" => $row['first_name'].' '.$row['last_name'],
			"email" => $row['email'],
			"action" => '
       <button id="content_managment" data-url="' . AGENT_URL . '/message-with-admin/ajax_chat.php?admin_id=' . $row['id'] . '" class="btn btn-sm btn-success"><i class="rocketchat"></i>Start Chat</button>
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
