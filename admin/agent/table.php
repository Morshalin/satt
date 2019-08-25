<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent');
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
  $searchQuery = " and (id like '%" . $searchValue . "%' or name like '%" . $searchValue . "%' or email like '%" . $searchValue . "%' or mobile_no like '%" . $searchValue . "%' or interested_dist like '%" . $searchValue . "%' or interested_up like '%" . $searchValue . "%' or status like '%" . $searchValue . "%' or level like '%" . $searchValue . "%' or occupation like '%" . $searchValue . "%') ";
}
/*==============================================================================
## Total number of records without filtering
=================================================================================*/

$sel = $db->select("select count(*) as allcount from agent_list");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

/*==============================================================================
## Total number of record with filtering
=================================================================================*/
$sel = $db->select("select count(*) as allcount from agent_list WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


/*==============================================================================
## Fetch records
=================================================================================*/
$query = "select * from agent_list WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $display_generate_appointment ='';
    $display_send_mail ='';
    $display_download_appointment ='';
    if ($row['confirmation_letter']) {
          $display_generate_appointment = 'none';
          $display_send_mail ='block';
          $display_download_appointment ='block';
      }else{
         $display_download_appointment ='none';
          $display_send_mail ='none';
          $display_generate_appointment = 'block';


      }
    $data[] = array(
      "DT_RowIndex" => $i + 1,
      "id" => $row['id'],
      "name" => '<strong>' . $row['name'] . '</strong>',
      "photo" => '<img src="'.'../../agent/'.$row['photo'].'" style="width: 90px; height:60px;" alt="Image not found">',

      "email" => '<strong>' . $row['email'].'<br>'.$row['mobile_no'].'<br>'.$row['alternate_mobile'].  '</strong>',
      "interested_dist" => '<strong>' . $row["interested_up"].'<br>'.$row["interested_dist"].'</strong>',
      "points" => '<strong>'.$row["points"].'</strong>',

      
      "action" => '
        <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
        <div class="list-icons" id="action_menu_' . $row['id'] . '">
          <div class="dropdown">
            <a href="#" class="list-icons-item" data-toggle="dropdown">
              <i class="icon-menu9"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/show.php?agent_id=' . $row['id'] . '"><i class="icon-eye"></i> View All Info</span>

              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/edit_info.php?agent_id=' . $row['id'] . '"><i class="icon-pen"></i>Edit Agent\'s Personal Info</span>

              <span class="dropdown-item" style="display:'.$display_generate_appointment.'" id="generate_appoint_letter" data-url="' . ADMIN_URL . '/agent/ajax_create_pdf.php?agent_id=' . $row['id'] . '"><i class="icon-redo"></i> Generate Confirmation Letter</span>

              <a class="dropdown-item" download style="display:'.$display_download_appointment.'"  href="' . ADMIN_URL . '/'.'agent/' . $row['confirmation_letter'] . '"><i class="icon-download"></i> Download Confirmation Letter</a>

              
              <span  class="dropdown-item " id="send_mail" style="display:'.$display_send_mail.'"  data-url="' . ADMIN_URL . '/agent/ajax_send_mail.php?agent_id=' . $row['id'] . '"><i class="icon-envelope"></i> Send Confirmation Mail</span>

              
              <span  class="dropdown-item " id="content_managment" style="display:'.$display_send_mail.'"  data-url="' . ADMIN_URL . '/agent/add_gift_on_point.php?agent_id=' . $row['id'] . '"><i class="icon-gift"></i>Add Gift On Points</span>

              
              <span  class="dropdown-item " id="content_managment" style="display:'.$display_send_mail.'"  data-url="' . ADMIN_URL . '/agent/add_monthly_target.php?agent_id=' . $row['id'] . '"><i class="icon-target"></i>Add Monthly Target</span>

              <span class="dropdown-item edit_status" id="content_managment" data-id="'.$row['id'].'" data-url="' . ADMIN_URL . '/agent/edit.php?agent_id=' . $row['id'] . '"><i class="icon-pencil7"></i> Edit Status</span>

             
              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/selling_product_list.php?agent_id=' . $row['id'] . '"><i class="icon-add"></i> Add Selling Products</span>

              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/add_client.php?agent_id=' . $row['id'] . '"><i class="icon-people"></i> Assign Clients Of Agent</span>

              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/add_note.php?agent_id=' . $row['id'] . '"><i class="icon-book"></i> Add Note</span>

              <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/agent/add_contact.php?agent_id=' . $row['id'] . '"><i class="icon-phone"></i> Add Last Contact Info</span>

               <span class="dropdown-item" id="delete_item" data-id="' . $row['id'] . '" data-url="' . ADMIN_URL . '/agent/ajax.php?agent_id=' . $row['id'] . '&action=delete"><i class="icon-trash"></i>Delete Agent</button></span>
            </div>
          </div>
        </div>
        ',
      "status" => '<span class="badge badge-success ml-1">'.$row['status'].'</span>'.($row['status'] == 'Promote'?'<span class="badge badge-success ml-1">'.$row['level'].'</span>':'').'<span class="badge badge-success ml-1">mail('.$row['send_mail'].')</span>',
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
