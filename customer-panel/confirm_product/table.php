<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/confirm_product');
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
  $searchQuery = " and (id like '%" . $searchValue . "%' or software_name like '%" . $searchValue . "%' or software_status_name like '%" . $searchValue . "%' or create_date like '%" . $searchValue . "%' or end_date like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from software_details");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from software_details WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$customer_id = $user['id'];
$query = "select * from satt_order_products WHERE status = 1 and customer_id='$customer_id' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
  $data = array();
  $i = 0;
if ($result){
  while ($row = mysqli_fetch_assoc($result)) {
    $pay = explode("_", $row['pay_type']);
    $pay_type = implode(" ", $pay);
    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $row['id'],
      "product_name" => '<strong>' . $row['product_name'] . '</strong>',
      "pay_type" => '<strong>' . $pay_type . '</strong>',
      "installation_charge" => '<strong>' . $row['installation_charge'] . '</strong>',
      "pay_amount" => '<strong>' . $row['pay_amount'] . '</strong>',
      "yearly_renew_charge" => '<strong>' . $row['yearly_renew_charge'] . '</strong>',
      
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . CUSTOMER_URL . '/confirm_product/show.php?product_id=' . $row['product_id'] . '"><i class="icon-eye"></i> View</span>

              <span class="dropdown-item" id="content_managment" data-url="' . CUSTOMER_URL . '/confirm_product/user_manual.php?product_id=' . $row['product_id'] . '"><i class="icon-eye"></i> user Manual </span>


  

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
