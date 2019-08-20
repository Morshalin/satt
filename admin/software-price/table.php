<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-price');
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
  $searchQuery = " and (id like '%" . $searchValue . "%' or software_name like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from software_price");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from software_price WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "select * from software_price WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $software_id = $row['id'];

    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "software_name" => '<strong>' . $row['software_name'] . '</strong>',
      "installation_charge" => '<strong>' . $row['installation_charge'] . '</strong>',
      "monthly_charge" => '<strong>' . $row['monthly_charge'] . '</strong>',
      "yearly_charge" => '<strong>' . $row['yearly_charge'] . '</strong>',
      "direct_sell" => '<strong>' . $row['direct_sell'] . '</strong>',
      "total_price" => '<strong>' . $row['total_price'] . '</strong>',
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/software-price/show.php?software_price_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/software-price/edit.php?software_price_id=' . $row['id'] . '"><i class="icon-pencil7"></i> Edit</span>
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
