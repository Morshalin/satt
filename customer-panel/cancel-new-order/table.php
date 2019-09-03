<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', CUSTOMER_URL . '/cancel-new-order');
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
	$searchQuery = " and (id like '%" . $searchValue . "%' or customer_name like '%" . $searchValue . "%' or customer_number like '%" . $searchValue . "%' or product_name like '%" . $searchValue . "%' or pay_type like '%" . $searchValue . "%' or order_date like '%" . $searchValue . "%') ";
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
$customer_id = $user['id'];
$query = "select * from new_product_order WHERE  confirmation_status = '0' AND delivery_status = '0' AND cancel_status = '1' AND customer_id = '$customer_id'" . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
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
		      "customer_name" => '<strong>' . $row['customer_name'] . '</strong>',
		      "customer_phn" => '<strong>' . $row['customer_phn'] . '</strong>',
		      "agent_name" => '<strong>' . $agent_name . '</strong>',
		      "agent_phn" => '<strong>' . $agent_phn . '</strong>',
			  "order_date" => '<strong>' . $row['order_date'] . '</strong>',
			  "cancel_reason" => '<strong>' . $fm->textShorten($row['cancel_reason'],15) . '</strong>',
			  "cancel_date" => '<strong>' . $row['cancel_date'] . '</strong>',
			  "action" => '
              <span class="dropdown-item bg-success" id="content_managment" data-url="' . CUSTOMER_URL . '/cancel-new-order/show.php?new_order_id=' . $row['id'] . '"><i class="icon-eye"></i> View</span>
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
