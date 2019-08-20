<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details');
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
$query = "select * from software_details WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $software_id = $row['id'];
    $short_feature = $fm->textShorten($row['short_feature'],30);
    $condition_details = $fm->textShorten($row['condition_details'],30);
    if ($software_id) {
      $query_lang_multi = "select * from software_language_multi WHERE software_id = '$software_id' ";
      $result_lang_multi = $db->select($query_lang_multi);
      $a ='';
      while ($row_lang_multi = mysqli_fetch_assoc($result_lang_multi)) {
          $lang_id = $row_lang_multi['language_id'];
          $query_lang = "select * from software_language WHERE id = '$lang_id'";
          $result_lang = $db->select($query_lang)->fetch_assoc();
          $lang_name = $result_lang['software_language_name'];
          $a .= '<span class="badge badge-success mr-1">'.$lang_name.'</span>';
    }



    $query_develope_by = "select * from software_develope_by WHERE software_id = '$software_id' ";
      $result_develope_by = $db->select($query_develope_by);
      $b ='';
      while ($row_develope_by = mysqli_fetch_assoc($result_develope_by)) {
          $developer_id = $row_develope_by['developer_id'];
          $query_developer = "select * from developer WHERE id = '$developer_id'";
          $result_developer = $db->select($query_developer)->fetch_assoc();
          $developer_name = $result_developer['name'];
          $b .= '<span class="badge badge-success mr-1">'.$developer_name.'</span>';
    }
  }
    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $row['id'],
      "software_name" => '<strong>' . $row['software_name'] . '</strong>',
      "software_status_name" => '<strong>' . $row['software_status_name'] . '</strong>',
      "language_name" => $a,
      "developer_name" => $b,
      "create_date" => '<strong>' . $row['create_date'] . '</strong>',
      "short_feature" => '<strong>' . $short_feature . '</strong>',
      "condition_details" => '<strong>' . $condition_details . '</strong>',
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/software-details/show.php?software_details_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/software-details/edit.php?software_details_id=' . $row['id'] . '"><i class="icon-pencil7"></i> Edit</span>
              <span class="dropdown-item" id="delete_item" data-id="' . $row['id'] . '" data-url="' . ADMIN_URL . '/software-details/ajax.php?software_details_id=' . $row['id'] . '&action=delete"><i class="icon-trash"></i>Delete </button></span>
            </div>
          </div>
        </div>
        ',
      "status" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="status_loading_' . $row['id'] . '"  style="display: none">
        <label class="form-check-label" id="status_' . $row['id'] . '" title="' . ($row['status'] == 1 ? 'Active' : 'InActive') . '" data-popup="tooltip-custom" data-placement="bottom">
        <input type="checkbox" class="form-check-status-switchery" id="change_status" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-url="' . ADMIN_URL . '/software-details/ajax.php?software_details_id=' . $row['id'] . '&action=status&status=' . $row['status'] . '"' . ($row['status'] == 1 ? 'checked' : '') . ' data-fouc >
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
