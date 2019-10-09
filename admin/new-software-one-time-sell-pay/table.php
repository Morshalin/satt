<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/new-software-one-time-sell-pay');
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
$query = "select * from new_product_order WHERE delivery_status = '1'" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
$result = $db->select($query);
$data = array();
$i = 0;
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['selling_method'] == 'direct_sell') {
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
      
        
        $order_id = $row['id'];
        $sell_price = $row['sell_price'];
        $total_amount =  $sell_price;
    
            
        $query = "SELECT * FROM new_product_pay WHERE new_product_order_id = '$order_id'";
        $get_pay = $db->select($query);
        $total_pay = 0 ;
        // die($total_pay);
        $due = 0;
        if ($get_pay) {
          while ($pay = $get_pay->fetch_assoc()) {
            $total_pay += (int)$pay['pay_amount'];
          }
        }
    
    
    
            
            // $total_amount = (int)$months * (int)$sell_price;
            
            if ($total_pay < $total_amount) {
                $due = $total_amount - $total_pay ; 
              }
              // die($due);
     
    
        $yearly_renew_charge = 0;
        if ($row['years'] < $years) {
            $yearly_renew_charge = ($years - $row['years'])*$row['yearly_renew_charge'];
        }
        // die($yearly_renew_charge);



$total_due = $due + $yearly_renew_charge;








        if ($total_due > 0 ) {


                    
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
                  "expected_name_software" => '<strong>' . $row['expected_name_software'] . '</strong>',
                  "customer_name" => '<strong>' .$row['customer_name'] . '</strong>',
                  "customer_phn" => '<strong>' . $row['customer_phn'] . '</strong>',
                  "agent_name" => '<strong>' . $agent_name . '</strong>',
                  "agent_phn" => '<strong>' .$agent_phn . '</strong>',
                  "delivery_date" => '<strong>' .$deliv_date. '</strong>',
                  "status" => '<strong class="bg-success p-1">Delivered</strong>',
                  "due" => '<strong class="bg-danger p-1">'.$total_due.'</strong>',
                  
                  "action" => '
                    <img src="' . BASE_URL . '/assets/ajaxloader.gif" id="delete_loading_' . $row['id'] . '" style="display: none;">
                    <div class="list-icons" id="action_menu_' . $row['id'] . '">
                      <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <span class="dropdown-item" id="content_managment" data-url="' . ADMIN_URL . '/new-software-one-time-sell-pay/show.php?new_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
            
                        <span class="dropdown-item text-info" id="content_managment" data-url="' . ADMIN_URL . '/new-software-one-time-sell-pay/pay-order.php?pay_order_id=' . $row['id'] . '&due='.$due.'"><i class="icon-paypal2"></i> Pay</span>
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
