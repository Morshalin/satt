<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/convince_bill_report', 'convince_bill_report');


	    /*================================================================
			View Records
		===================================================================*/
		if (isset($_POST['submit'])) {

			$from_date = $_POST['from_date'];
			$from_date_show = $from_date ;
			$from_date = strtotime($from_date);
			
			$to_date = $_POST['to_date'];
			$to_date_show = $to_date;
			$to_date = strtotime($to_date);

			$report_type = $_POST['invoice_type'];
			//die($report_type);

			if ($report_type == 'Expense') {
				$query = "SELECT * FROM office_expense where invoice_type = '$report_type'";
				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Expense Report</h2>
								
								<h6>Report Type :Expense</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Invoice Id</th>
									<th scope="col">Client Name</th>
									<th scope="col">Designation</th>
									<th scope="col">Date</th>
									<th scope="col">Expense</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$total_price = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['invoice_id'].'</td>
											<td>'.$row['name'].'</td>
											<td>'.$row['designation'].'</td>
											<td>'.$row['date'].'</td>
											<td>'.$row['total'].'</td>
										</tr>';
							$total_price += (int)$row['total'];
							$count++;
						}
					} 
					if ($count > 0) {
						$data .='<tr>
						<td colspan="5"  align="right" style="color:red">Total Amount</td>
							<td  align="left" style="color:red">'.$total_price.'</td>
							
						</tr>';
					}else{
						$data .='  <tr style="color:black" align="center">
										<td colspan="10"  align="center" style="color:red"> No Record Found</td>
									</tr>';
					}
				}else{
					$data .='  <tr style="color:black" align="center">
										<td colspan="10"  align="center" style="color:red"> No Record Found</td>
									</tr>';
				}
				$print_table = 'print_table';
				$data .= ' </tbody>
							</table>
							
							</div>
							<div class="mt-3">
							<a class=" text-light btn-success btn" onclick="printContent(\''.$print_table.'\')"><i class="icon-printer"></i> Print</span> </a>
							</div>
							';
							
				die(json_encode($data));
			}else if($report_type == 'Income') {
				$query = "SELECT * FROM office_expense where invoice_type = '$report_type'";
				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Income Report</h2>
								
								<h6>Report Type :Income</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Invoice Id</th>
									<th scope="col">Client Name</th>
									<th scope="col">Designation</th>
									<th scope="col">Date</th>
									<th scope="col">Income</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$total_price = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['invoice_id'].'</td>
											<td>'.$row['name'].'</td>
											<td>'.$row['designation'].'</td>
											<td>'.$row['date'].'</td>
											<td>'.$row['total'].'</td>
										</tr>';
							$total_price += (int)$row['total'];
							$count++;
						}
					} 
					if ($count > 0) {
						$data .='<tr>
						<td colspan="5"  align="right" style="color:red">Total Amount</td>
							<td  align="left" style="color:red">'.$total_price.'</td>
							
						</tr>';
					}else{
						$data .='  <tr style="color:black" align="center">
										<td colspan="10"  align="center" style="color:red"> No Record Found</td>
									</tr>';
					}
				}else{
					$data .='  <tr style="color:black" align="center">
										<td colspan="10"  align="center" style="color:red"> No Record Found</td>
									</tr>';
				}
				$print_table = 'print_table';
				$data .= ' </tbody>
							</table>
							
							</div>
							<div class="mt-3">
							<a class=" text-light btn-success btn" onclick="printContent(\''.$print_table.'\')"><i class="icon-printer"></i> Print</span> </a>
							</div>
							';
							
				die(json_encode($data));
			}else{
				$data .='  <tr style="color:black" align="center">
						<td colspan="10"  align="center" style="color:red"> No Record Found</td>
					</tr>';
		}	
} 

