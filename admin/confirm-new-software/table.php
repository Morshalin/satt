<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/confirm-new-software');
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
  $searchQuery = " and (id like '%" . $searchValue . "%' or customer_name like '%" . $searchValue . "%' or customer_phn like '%" . $searchValue . "%' or order_date like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from new_product_order");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from new_product_order WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$agent_id = $user['id'];
$query = "select * from new_product_order WHERE  confirmation_status = '1' AND delivery_status = '0' AND cancel_status = '0'" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {

    if ($row['agent_id']) {
      $agent_name = $row['agent_name'];
      $agent_phn = $row['agent_phn'];
    }else{
      $agent_name = 'N/A';
      $agent_phn = 'N/A';

    }
   
    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $row['id'],
      "expected_name_software" => '<strong>' . $row['expected_name_software'] . '</strong>',
      "customer_name" => '<strong>' .$row['customer_name'] . '</strong>',
      "customer_phn" => '<strong>' . $row['customer_phn'] . '</strong>',
      "agent_name" => '<strong>' . $agent_name . '</strong>',
      "agent_phn" => '<strong>' .$agent_phn . '</strong>',
      "order_date" => '<strong>' .$row['order_date'] . '</strong>',
      "status" => '<strong class="bg-success p-1">Confirmed</strong>',
      
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/confirm-new-software/show.php?new_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>


             <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL .'/confirm-new-software/confirm_order.php?new_order_id='.$row['id'].'" style = "color:green"><i class="icon-checkmark4"></i> Confirm Order</span>


             <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL .'/confirm-new-software/cancel_order.php?new_order_id='.$row['id'].'" style = "color:red"><i class="icon-cancel-square"></i> Cancel Order</span>
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
