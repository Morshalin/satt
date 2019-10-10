<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/existing-software-report', 'existing-software-report');


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
			// $status = $_POST['status'];





			if ($report_type == 'payment') {
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Existing Software</h2>
								
								<h6>Report Type : Payment Report</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>';
							
				$query = "SELECT * FROM satt_order_products";
				$get_product = $db->select($query);

				$i = 0;
				if ($get_product) {
					
					$data .= '
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Client Name</th>
									<th scope="col">Product Name</th>
									<th scope="col">Payment Type</th>
									<th scope="col">Paid</th>
									<th scope="col">Yearly Renew Charge</th>
									<th scope="col">Installation Charge</th>
								</tr>
							</thead>
							<tbody>';
					
					$paid = 0;
					$total_paid = 0;
					$total_yearly_pay = 0;
					$total_installation_pay = 0;
					$count = 0;

					while ($row = $get_product->fetch_assoc()) {
						$id = $row['id'];
						$paid = 0;
						$query = "SELECT * FROM existing_product_pay WHERE product_order_id = '$id'";
						$get_pay_info = $db->select($query);
						if ($get_pay_info) {
							while ($pay = $get_pay_info->fetch_assoc()) {
								$pay_date = date("Y-m-d", strtotime($pay['pay_date']));
								$pay_date = strtotime($pay_date);
								if ($pay_date >= $from_date && $pay_date <= $to_date) {
									$paid += $pay['pay_amount'];
									$count++;
									
								}
							}
						}
						$yearly_pay_amt = 0 ;
						$query = "SELECT * FROM existing_product_yearly_charge_pay WHERE new_product_order_id = '$id'";
						$get_yearly_pay_info = $db->select($query);
						if ($get_yearly_pay_info) {
							while ($yearly_pay = $get_yearly_pay_info->fetch_assoc()) {
								$pay_date = date("Y-m-d", strtotime($yearly_pay['date']));
								$pay_date = strtotime($pay_date);
								if ($pay_date >= $from_date && $pay_date <= $to_date) {
									$yearly_pay_amt += $yearly_pay['pay_amount'];
									$count++;
									
								}
							}
						}
						$installation_pay_amt = 0 ;
						$query = "SELECT * FROM existing_product_installation_pay WHERE product_order_id = '$id'";
						$get_installation_pay_info = $db->select($query);
						if ($get_installation_pay_info) {
							while ($installation_pay = $get_installation_pay_info->fetch_assoc()) {
								$pay_date = date("Y-m-d", strtotime($installation_pay['pay_date']));
								$pay_date = strtotime($pay_date);
								if ($pay_date >= $from_date && $pay_date <= $to_date) {
									$installation_pay_amt += $installation_pay['pay_amount'];
									$count++;
									
								}
							}
						}

						if ($paid > 0 ||  $yearly_pay_amt > 0 || $installation_pay_amt > 0) {
							$i++;
							$data .='  <tr style="color:black" align="left">
											<td>'.$i.'</td>
											<td>'.$row['customer_name'].'</td>
											<td>'.$row['product_name'].'</td>
											<td>'.ucwords(implode(' ',explode('_',$row['pay_type']))).'</td>
											<td>'.$paid.'</td>
											<td>'.$yearly_pay_amt.'</td>
											<td>'.$installation_pay_amt.'</td>
										</tr>';
						}

						$total_paid =$total_paid + $paid;
						$total_yearly_pay =$total_yearly_pay + $yearly_pay_amt;
						$total_installation_pay =$total_installation_pay + $installation_pay_amt;
						$inTotal = $total_paid + $total_yearly_pay + $total_installation_pay;
						
					}

					if ($total_paid > 0 || $total_yearly_pay > 0 || $total_installation_pay > 0) {
						$data .='<tr>
								<td colspan="4"  align="right" style="color:red">Total Amount</td>
								<td  align="left" style="color:red">'.$total_paid.'</td>
								<td  align="left" style="color:red">'.$total_yearly_pay.'</td>
								<td  align="left" style="color:red">'.$total_installation_pay.'</td>
								
							</tr>
							<tr>
								<td colspan="7"  align="center" style="color:red">Sub Total : <span>'. $inTotal .' /=</span></td>
								
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
			}
} 

