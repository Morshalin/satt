<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('admin', ADMIN_URL.'/role', 'Role');
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
  $searchQuery = " and (role_name like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from role");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from role WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "select * from role WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['serial_no'];
    $query1 = "select * from role_has_permission WHERE role_serial_no = '$id' ";
    $result1 = $db->select($query1);
    if ($result1) {
      $permissions = "";
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $permission_serial_no = $row1['permission_serial_no'];
    $query2 = "SELECT * FROM permission WHERE serial_no = '$permission_serial_no' ";
    $result2 = $db->select($query2);
    if ($result2) {
      $permission_name = mysqli_fetch_assoc($result2)['permission_name'];
    $permissions .='<span class="badge badge-sm text-light badge-success mr-1 mb-1 rounded">' . $permission_name . '</span>';
    }
  }
  }


    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $id,
      "role_name" => '<strong>' . $row['role_name'] . '</strong>',
      "permission_name" => $permissions,
                          
      
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['serial_no'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['serial_no'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
             
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/role/edit.php?id=' . $row['serial_no'] . '"><i class="icon-pencil7"></i> Edit</span>
              <span class="dropdown-item" id="delete_item" data-id="' . $row['serial_no'] . '" data-url="' . ADMIN_URL . '/role/ajax.php?del_id=' . $row['serial_no'] . '&action=delete"><i class="icon-trash"></i>Delete </button></span>
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
