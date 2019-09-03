<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/delivered-order');
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
	$searchQuery = " and (id like '%" . $searchValue . "%' or customer_name like '%" . $searchValue . "%' or customer_number like '%" . $searchValue . "%' or product_name like '%" . $searchValue . "%' or pay_type like '%" . $searchValue . "%' or order_date like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from satt_order_products");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from satt_order_products WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$customer_id = $user['id'];
$query = "SELECT * FROM satt_order_products WHERE status = '1' AND delivery_status = '1' and customer_id = '$customer_id' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {

$agent_id = $row['agent_id'];
$agent_name = '';
if ($agent_id) {
	$query1 = "SELECT * FROM agent_list WHERE id = '$agent_id' ";
	$result1 = $db->select($query1);
	if ($result1) {
        $row1 = $result1->fetch_assoc();
		$agent_name = $row1['name'];
    }
}

		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"id" => $row['id'],
      "customer_name" => '<strong>' . $row['customer_name'] . '</strong>',
      "customer_number" => '<strong>' . $row['customer_number'] . '</strong>',
      "agent_name" => '<strong>' . $agent_name . '</strong>',
      "product_name" => '<strong>' . $row['product_name'] . '</strong>',
      "pay_type" => '<strong>' . $row['pay_type'] . '</strong>',
			"order_date" => '<strong>' . $row['order_date'] . '</strong>',
			"delivery_date" => '<strong>' . $row['delivery_date'] . '</strong>',
			"action" => '

			        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
        		<span class="dropdown-item" id="content_managment" data-url="' . CUSTOMER_URL . '/delivered-order/show.php?confirm_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
            </div>
          </div>
        </div>
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
