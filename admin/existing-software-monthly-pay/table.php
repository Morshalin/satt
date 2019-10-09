<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/existing-software-monthly-pay');
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
if ($columnName == 'due') {
  $columnName = 'order_date';
}

/*==============================================================================
## Search
=================================================================================*/
$searchQuery = " ";
if ($searchValue != '') {
  $searchQuery = " and (id like '%" . $searchValue . "%' or customer_name like '%" . $searchValue . "%' or customer_number like '%" . $searchValue . "%' or order_date like '%" . $searchValue . "%') ";
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
$agent_id = $user['id'];
$query = "SELECT * FROM satt_order_products WHERE status = '1' AND delivery_status = '1' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['pay_type'] == 'monthly_pay') {
      // die($row['selling_method']);
        $delivery_date = date("Y-m-d", strtotime($row['delivery_date']));
        $today = date("Y-m-d");

        $delivery_date = strtotime($delivery_date);  
        $today = strtotime($today);  
        // Formulate the Difference between two dates 
        $diff = abs($today - $delivery_date);  
        $years = floor($diff / (365*60*60*24));  
        $months = floor(($diff - $years * 365*60*60*24)  / (30*60*60*24)); 
        
        $total_amount = 0;
        // die($total_amount);
      // die($years);
      $months = 12*$years + $months;
        // die($months);
        $order_id = $row['id'];
        $sell_price = $row['seling_total_price'];
        $total_amount = $months * $sell_price;

        
        $query = "SELECT * FROM existing_product_pay WHERE product_order_id = '$order_id'";
        $get_pay = $db->select($query);
        $total_pay = 0 ;
        // die($total_pay);
        $due = 0;
        if ($get_pay) {
          while ($pay = $get_pay->fetch_assoc()) {
            $total_pay += (int)$pay['pay_amount'];
          }
        }

        if ($months >= 1 ) {

          
          if ($total_pay < $total_amount) {
            $due = $total_amount - $total_pay ; 
              
              $yearly_renew_charge = 0;
              if ($row['years'] < $years) {
                  $yearly_renew_charge = ($years - $row['years'])*$row['yearly_renew_charge'];
                  $due +=$yearly_renew_charge;
              } 
                    
                if ($row['agent_id']) {
                  $agent_id = $row['agent_id'];
                  $query = "SELECT * FROM agent_list WHERE id  = '$agent_id'";
                  $get_agent = $db->select($query);
                  if ($get_agent) {
                    $agent = $get_agent->fetch_assoc();
                    $agent_name = $agent['name'];
                    $agent_phn = $agent['mobile_no'];
                  }else{
                    $agent_name = 'N/A';
                    $agent_phn = 'N/A';
                  }
                }else{
                  $agent_name = 'N/A';
                  $agent_phn = 'N/A';
                }
                $deliv_date = date("Y-m-d", strtotime($row['delivery_date']));
              // die($deliv_date);
                $data[] = array(
                  "DT_RowIndex" => $i + 1,
                  "id" => $row['id'],
                  "product_name" => '<strong>' . $row['product_name'] . '</strong>',
                  "customer_name" => '<strong>' .$row['customer_name'] . '</strong>',
                  "customer_number" => '<strong>' . $row['customer_number'] . '</strong>',
                  "agent_name" => '<strong>' . $agent_name . '</strong>',
                  "agent_phn" => '<strong>' .$agent_phn . '</strong>',
                  "delivery_date" => '<strong>' .$deliv_date. '</strong>',
                  "status" => '<strong class="bg-success p-1">Delivered</strong>',
                  "due" => '<strong class="bg-danger p-1">'.$due.'</strong>',
                  
                  "action" => '
                    <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
                    <div class="list-icons" id="action_menu_' . $row['id'] . '">
                      <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/existing-software-monthly-pay/show.php?new_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
            
                        <span class="dropdown-item text-info" id="content_managment" data-url="' . ADMIN_URL . '/existing-software-monthly-pay/pay-order.php?pay_order_id=' . $row['id'] . '&due='.$due.'"><i class="icon-paypal2"></i> Pay</span>
                        </div>
                      </div>
                    </div>
                    ',
                );
                $i++;

          }
        }else{ // duration is less than one month but there is due then the following section will work
          $total_amount =  $sell_price;
           
          if ($total_pay < $total_amount) {
            $due = $total_amount - $total_pay ;  
                    
                if ($row['agent_id']) {
                  $agent_name = $row['agent_name'];
                  $agent_phn = $row['agent_phn'];
                }else{
                  $agent_name = 'N/A';
                  $agent_phn = 'N/A';
            
                }
                $deliv_date = date("Y-m-d", strtotime($row['delivery_date']));
              // die($deliv_date);
              $data[] = array(
                "DT_RowIndex" => $i + 1,
                "id" => $row['id'],
                "product_name" => '<strong>' . $row['product_name'] . '</strong>',
                "customer_name" => '<strong>' .$row['customer_name'] . '</strong>',
                "customer_number" => '<strong>' . $row['customer_number'] . '</strong>',
                "agent_name" => '<strong>' . $agent_name . '</strong>',
                "agent_phn" => '<strong>' .$agent_phn . '</strong>',
                "delivery_date" => '<strong>' .$deliv_date. '</strong>',
                "status" => '<strong class="bg-success p-1">Delivered</strong>',
                "due" => '<strong class="bg-danger p-1">'.$due.'</strong>',
                
                "action" => '
                  <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
                  <div class="list-icons" id="action_menu_' . $row['id'] . '">
                    <div class="dropdown">
                      <a href="#" class="list-icons-item" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/existing-software-monthly-pay/show.php?new_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
          
                      <span class="dropdown-item text-info" id="content_managment" data-url="' . ADMIN_URL . '/existing-software-monthly-pay/pay-order.php?pay_order_id=' . $row['id'] . '&due='.$due.'"><i class="icon-paypal2"></i> Pay</span>
                      </div>
                    </div>
                  </div>
                  ',
                );
                $i++;

          }
        }
  
      }
    
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
