<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/message', 'Message');
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
	$searchQuery = " and (id like '%" . $searchValue . "%' or type like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from satt_message");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from satt_message WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "select * from satt_message WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"id" => $row['id'],
			"message_type" =>  $fm->textShorten($row['message_type'] , 50) ,
      "customer_question" => '<strong>' . $fm->textShorten($row['customer_question'] , 50) . '</strong>',
      "our_reply" => '<strong>' . $fm->textShorten($row['our_reply'] , 50)  . '</strong>',
      "software_information" => $fm->textShorten($row['software_information'] , 50) ,
      "contact_details" => $fm->textShorten($row['contact_details'] , 50) ,
      "introduction_message" =>  $fm->textShorten($row['introduction_message'] , 50) ,
			"action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
          	<a href="#" class="list-icons-item" data-toggle="dropdown">
          		<i class="icon-menu9"></i>
          	</a>
          	<div class="dropdown-menu dropdown-menu-right">
          		<span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/message/show.php?message_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
          		<span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/message/edit.php?message_id=' . $row['id'] . '"><i class="icon-pencil7"></i> Edit</span>
          		<span class="dropdown-item" id="delete_item" data-id="' . $row['id'] . '" data-url="' . ADMIN_URL . '/message/ajax.php?message_id=' . $row['id'] . '&action=delete"><i class="icon-trash"></i>Delete </button></span>
          	</div>
          </div>
        </div>
        ',
			// "status" => '
      //   <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="status_loading_' . $row['id'] . '"  style="display: none">
      //   <label class="form-check-label" id="status_' . $row['id'] . '" title="' . ($row['status'] == 1 ? 'Active' : 'InActive') . '" data-popup="tooltip-custom" data-placement="bottom">
      //   <input type="checkbox" class="form-check-status-switchery" id="change_status" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-url="' . ADMIN_URL . '/message/ajax.php?message_id=' . $row['id'] . '&action=status&status=' . $row['status'] . '"' . ($row['status'] == 1 ? 'checked' : '') . ' data-fouc >
      //   </label>
      //   	',
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
