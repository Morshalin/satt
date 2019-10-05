<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/graphics-report', 'graphics-report');


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

			$report_type = $_POST['report_type'];
			$status = $_POST['status'];
			$transaction_type = $_POST['transaction_type'];

			if ($report_type == 'all') {
				$query = "SELECT * FROM graphics_info";
				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Graphics Report</h2>
								
								<h6>Report Type :All</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Client Name</th>
									<th scope="col">Product Name</th>
									<th scope="col">Qty</th>
									<th scope="col">Price</th>
									<th scope="col">Cost</th>
									<th scope="col">Profit</th>
									<th scope="col">Paid</th>
									<th scope="col">Due</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$total_price = 0;
					$total_cost = 0;
					$total_profit = 0;
					$total_paid = 0;
					$total_due = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['order_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$cost = 0;
							$profit = 0;
							$paid = 0;
							$due = 0;
							$count++;
							$cost = (int)$row['printing_cost'] + (int)$row['currier_cost'] + (int)$row['others_cost'];
							$profit = (int)$row['price'] - $cost;
							$id = $row['id'];
							$query = "SELECT * FROM	graphics_pay WHERE order_id = '$id'";
							$get_pay = $db->select($query);
							if ($get_pay) {
								while ($pay = $get_pay->fetch_assoc()) {
									$paid += (int)$pay['pay']; 
								}
							}
							$due = (int)$row['price'] - $paid ;
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['client_name'].'</td>
											<td>'.$row['product_name'].'</td>
											<td>'.$row['qty'].'</td>
											<td>'.$row['price'].'</td>
											<td>'.$cost.'</td>
											<td>'.$profit.'</td>
											<td>'.$paid.'</td>
											<td>'.$due.'</td>
											<td>'.$row['status'].'</td>
										</tr>';
							$total_price += (int)$row['price'];
							$total_cost += $cost;
							$total_profit += $profit;
							$total_paid += $paid;
							$total_due += $due;
						}
					}
					if ($count > 0) {
						$data .='<tr>
								<td colspan="4"  align="right" style="color:red">Total Amount</td>
								<td  align="left" style="color:red">'.$total_price.'</td>
								<td  align="left" style="color:red">'.$total_cost.'</td>
								<td  align="left" style="color:red">'.$total_profit.'</td>
								<td  align="left" style="color:red">'.$total_paid.'</td>
								<td  colspan="2"  align="left" style="color:red">'.$total_due.'</td>
								
							</tr>
						
								';
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
			}else if ($report_type == 'cost_profit') {
				
				$query = "SELECT * FROM graphics_info";
				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Graphics Report</h2>
								
								<h6>Report Type : Cost And Profit</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Client Name</th>
									<th scope="col">Product Name</th>
									<th scope="col">Printing Cost</th>
									<th scope="col">Currier Cost</th>
									<th scope="col">Others Cost</th>
									<th scope="col">Total Cost</th>
									<th scope="col">Profit</th>
									<th scope="col">Due</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$total_price = 0;
					$total_print_cost = 0;
					$total_currier_cost = 0;
					$total_others_cost = 0;
					$total_cost = 0;
					$total_profit = 0;
					$total_paid = 0;
					$total_due = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['order_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$cost = 0;
							$profit = 0;
							$paid = 0;
							$due = 0;
							$count++;
							$printing_cost = $row['printing_cost'];
							$currier_cost = $row['currier_cost'];
							$others_cost = $row['others_cost'];
	
							$cost = (int)$row['printing_cost'] + (int)$row['currier_cost'] + (int)$row['others_cost'];
							$profit = (int)$row['price'] - $cost;
							$id = $row['id'];
							$query = "SELECT * FROM	graphics_pay WHERE order_id = '$id'";
							$get_pay = $db->select($query);
							if ($get_pay) {
								while ($pay = $get_pay->fetch_assoc()) {
									$paid += (int)$pay['pay']; 
								}
							}
							$due = (int)$row['price'] - $paid ;
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['client_name'].'</td>
											<td>'.$row['product_name'].'</td>
											<td>'.$printing_cost.'</td>
											<td>'.$currier_cost.'</td>
											<td>'.$others_cost.'</td>
											<td>'.$cost.'</td>
											<td>'.$profit.'</td>
											<td>'.$due.'</td>
											<td>'.$row['status'].'</td>
										</tr>';
							$total_print_cost += (int)$printing_cost;
							$total_currier_cost += (int)$currier_cost;
							$total_others_cost += (int)$others_cost;
							$total_cost += $cost;
							$total_profit += $profit;
							$total_due += $due;

						}
						
					}
					if ($count > 0) {
						$data .='<tr>
						<td colspan="3"  align="right" style="color:red">Total Amount</td>
							<td  align="left" style="color:red">'.$total_print_cost.'</td>
							<td  align="left" style="color:red">'.$total_currier_cost.'</td>
							<td  align="left" style="color:red">'.$total_others_cost.'</td>
							<td  align="left" style="color:red">'.$total_cost.'</td>
							<td  align="left" style="color:red">'.$total_profit.'</td>
							<td  colspan="2"  align="left" style="color:red">'.$total_due.'</td>
							
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
			}else if ($report_type == 'status') {

				$query = "SELECT * FROM graphics_info WHERE  status = '$status'";

				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Graphics Report</h2>
								
								<h6>Status : '.$status.'</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
							<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Client Name</th>
									<th scope="col">Product Name</th>
									<th scope="col">Qty</th>
									<th scope="col">Price</th>
									<th scope="col">Cost</th>
									<th scope="col">Profit</th>
									<th scope="col">Paid</th>
									<th scope="col">Due</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$total_price = 0;
					$total_cost = 0;
					$total_profit = 0;
					$total_paid = 0;
					$total_due = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['order_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$cost = 0;
							$profit = 0;
							$paid = 0;
							$due = 0;
							$count++;
							$cost = (int)$row['printing_cost'] + (int)$row['currier_cost'] + (int)$row['others_cost'];
							$profit = (int)$row['price'] - $cost;
							$id = $row['id'];
							$query = "SELECT * FROM	graphics_pay WHERE order_id = '$id'";
							$get_pay = $db->select($query);
							if ($get_pay) {
								while ($pay = $get_pay->fetch_assoc()) {
									$paid += (int)$pay['pay']; 
								}
							}
							$due = (int)$row['price'] - $paid ;
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['client_name'].'</td>
											<td>'.$row['product_name'].'</td>
											<td>'.$row['qty'].'</td>
											<td>'.$row['price'].'</td>
											<td>'.$cost.'</td>
											<td>'.$profit.'</td>
											<td>'.$paid.'</td>
											<td>'.$due.'</td>
										</tr>';
							$total_price += (int)$row['price'];
							$total_cost += $cost;
							$total_profit += $profit;
							$total_paid += $paid;
							$total_due += $due;
						}
						
					}
					if ($count > 0 ) {
						$data .='<tr>
								<td colspan="4"  align="right" style="color:red">Total Amount</td>
								<td  align="left" style="color:red">'.$total_price.'</td>
								<td  align="left" style="color:red">'.$total_cost.'</td>
								<td  align="left" style="color:red">'.$total_profit.'</td>
								<td  align="left" style="color:red">'.$total_paid.'</td>
								<td  colspan="2"  align="left" style="color:red">'.$total_due.'</td>
								
							</tr> ';
					}else{
						$data .='  <tr style="color:black" align="center">
										<td colspan="9"  align="center" style="color:red"> No Record Found</td>
									</tr>';
					}
					
				}else{
					$data .='  <tr style="color:black" align="center">
										<td colspan="9"  align="center" style="color:red"> No Record Found</td>
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
			}else if ($report_type == 'transaction') {

				$query = "SELECT * FROM graphics_pay WHERE  payment_method = '$transaction_type'";

				$get_info = $db->select($query);
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Graphics Report</h2>
								
								<h6>Transaction Type : '.$transaction_type.'</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
							<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Received By</th>
									<th scope="col">Received From</th>
									<th scope="col">Tx Id / Account no</th>
									<th scope="col">Amount (Taka)</th>
									<th scope="col">Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($get_info) {
					$i = 1;
					$amount = 0;
					$count = 0;

					while ($row = $get_info->fetch_assoc()) {
						
						$date = date("Y-m-d", strtotime($row['date']));
						$date = strtotime($date);
						if ($date >= $from_date && $date <= $to_date) {
							$count++;
							if ($row['pay'] == '') {
								$pay='0';
							}else{
								$pay = $row['pay'];
							}
							$amount += (int)$pay;
	
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['received_by'].'</td>
											<td>'.$row['received_mobile_no'].'</td>
											<td>'.$row['tx_id_account_no'].'</td>
											<td>'.$pay.'</td>
											<td>'.$row['date'].'</td>
										</tr>';
						}
						
					}

					if ($count > 0) {
						$data .='<tr>
								<td colspan="4"  align="right" style="color:red">Total Amount</td>
								<td colspan="2" align="left" style="color:red">'.$amount.' /=</td>
								
							</tr>';
					}else{
						$data .='  <tr style="color:black" align="center">
										<td colspan="6"  align="center" style="color:red"> No Record Found</td>
									</tr>';
					}
					
				}else{
					$data .='  <tr style="color:black" align="center">
										<td colspan="6"  align="center" style="color:red"> No Record Found</td>
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
			}
				
} 

