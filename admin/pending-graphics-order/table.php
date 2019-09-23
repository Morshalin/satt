<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/pending-graphics-order');
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
	$searchQuery = " and (id like '%" . $searchValue . "%' or client_name like '%" . $searchValue . "%' or mobile_no like '%" . $searchValue . "%' or shipping_address like '%" . $searchValue . "%' or product_name like '%" . $searchValue . "%' or order_date like '%" . $searchValue . "%' or status like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from graphics_info");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from graphics_info WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "SELECT * FROM graphics_info WHERE status != 'Delivered' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {

		$data[] = array(
			"DT_RowIndex" => $i + 1,
			"id" => $row['id'],
      "client_name" => '<strong>' . $row['client_name'] . '</strong>',
      "mobile_no" => '<strong>' . $row['mobile_no'] . '</strong>',
      "shipping_address" => '<strong>' . $row['shipping_address'] . '</strong>',
      "product_name" => '<strong>' . $row['product_name'] . '</strong>',
      "order_date" => '<strong>' . $row['order_date'] . '</strong>',
      "price" => '<strong>' . $row['price'] . '</strong>',
	    "status" => '<span class="badge badge-warning ">' . $row['status'] . '</span>',
        "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/pending-graphics-order/show.php?pending_graphics_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
              <span class="dropdown-item text-success" id="content_managment" data-url="' . ADMIN_URL . '/pending-graphics-order/pay.php?pending_graphics_order_id=' . $row['id'] . '"><i class="icon-checkmark4"></i> Pay</span>
              <span class="dropdown-item text-warning" id="content_managment" data-url="' . ADMIN_URL . '/pending-graphics-order/change-status.php?pending_graphics_order_id=' . $row['id'] . '"><i class="icon-magic-wand"></i> Change Status</span>
              <span class="dropdown-item text-info" id="content_managment" data-url="' . ADMIN_URL . '/pending-graphics-order/print-cost.php?pending_graphics_order_id=' . $row['id'] . '"><i class="icon-coins"></i> Print Cost</span>
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
