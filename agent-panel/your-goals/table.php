<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('agent-panel', AGENT_URL . '/your-goals');
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
  $searchQuery = " and (month like '%" . $searchValue . "%' or target_amount like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from agent_target");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from agent_target WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$agent_id = $user['id'];
$query = "select * from agent_target WHERE agent_id='$agent_id' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {

    $month = explode('-', $row['month']);
    $month_no = $month[1];
    switch ($month_no) {
      case '01':
        $month_name = 'January'.'-'.$month[0];
        break;
      case '02':
        $month_name = 'February'.'-'.$month[0];
        break;
      case '03':
        $month_name = 'March'.'-'.$month[0];
        break;
      case '04':
        $month_name = 'April'.'-'.$month[0];
        break;
      case '05':
        $month_name = 'May'.'-'.$month[0];
        break;
      case '06':
        $month_name = 'Jun'.'-'.$month[0];
        break;
      case '07':
        $month_name = 'July'.'-'.$month[0];
        break;
      case '08':
        $month_name = 'August'.'-'.$month[0];
        break;
      case '09':
        $month_name = 'September'.'-'.$month[0];
        break;
      case '10':
        $month_name = 'October'.'-'.$month[0];
        break;
      case '11':
        $month_name = 'November'.'-'.$month[0];
        break;
      case '12':
        $month_name = 'December'.'-'.$month[0];
        break;
    }
   
    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $row['id'],
      "month" => '<strong>' .  $month_name . '</strong>',
      "target_amount" => '<strong>' .$row['target_amount'] . '</strong>',
      "sohag" => '<strong>' .''. '</strong>',
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
