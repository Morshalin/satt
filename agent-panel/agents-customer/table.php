<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL.'/agents-customer');
$agentId = $user['id'];
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

/*==============================================================================
## Search
=================================================================================*/
$searchQuery = " ";
if ($searchValue != '') {
	$searchQuery = " and (id like '%" . $searchValue . "%' or name like '%" . $searchValue . "%' or number like '%" . $searchValue . "%' or institute_address like '%" . $searchValue . "%' ) ";
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
INNER JOIN agent_client ON satt_customer_informations.id=agent_client.client_id WHERE agent_client.agent_id = '$agentId' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"id" => $row['id'],
      "name" => '<strong>' . $row['name'] . '</strong>',
      "number" => '<strong>' . $row['number'] . '</strong>',
			"institute_address" => '<strong>' . $row['institute_address'] . '</strong>',
			"action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
          	<a href="#" class="list-icons-item" data-toggle="dropdown">
          		<i class="icon-menu9"></i>
          	</a>
          	<div class="dropdown-menu dropdown-menu-right">
          		<span class="dropdown-item" id="content_managment" data-url="' . AGENT_URL . '/agents-customer/show.php?agents_customer_id=' . $row['agent_id'] . '"><i class="icon-eye"></i> View</span>
              <span class="dropdown-item" id="content_managment" data-url="' . AGENT_URL . '/agents-customer/show.php?agents_customer_id=' . $row['client_id'] . '"><i class="icon-eye"></i> View Purchase Report</span>
          	</div>
          </div>
        </div>
        ',
			"status" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="status_loading_' . $row['id'] . '"  style="display: none">
        <label class="form-check-label" id="status_' . $row['id'] . '" title="' . ($row['status'] == 1 ? 'Active' : 'InActive') . '" data-popup="tooltip-custom" data-placement="bottom">
        <input type="checkbox" class="form-check-status-switchery" id="change_status" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-url="' . AGENT_URL . '/agents-customer/ajax.php?agents_customer_id=' . $row['id'] . '&action=status&status=' . $row['status'] . '"' . ($row['status'] == 1 ? 'checked' : '') . ' data-fouc >
        </label>
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
