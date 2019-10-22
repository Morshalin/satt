<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customers-report', 'Customers Report');


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

			$report_type = $_POST['users'];
			$admin_id = $_POST['admin'];
			$system_user_id = $_POST['system_user'];
			$agent_id = $_POST['agent'];
			$customer_type = $_POST['customer_type'];

			if ($report_type == 'admin_id') {
				if ($customer_type == 'intro_customer') {
					$query = "SELECT * FROM satt_extra_office_notes where user_id = '$admin_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : Admin (Introduced Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
				$query = "SELECT * FROM satt_customer_informations where system_user_id = '$admin_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : Admin (Existing Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
			 } // Admin if end

			 else if($report_type == 'systems_user_id') {
			 	if ($customer_type == 'intro_customer') {
					$query = "SELECT * FROM satt_extra_office_notes where user_id = '$system_user_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : System User (Introduced Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
				$query = "SELECT * FROM satt_customer_informations where system_user_id = '$system_user_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : System User (Existing Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
			} //System User end

			 else if($report_type == 'agent_id') {
			 	if ($customer_type == 'intro_customer') {
					$query = "SELECT * FROM satt_extra_office_notes where user_id = '$agent_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : Agent (Introduced Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
				$query = "SELECT * FROM satt_customer_informations where system_user_id = '$agent_id' ";
                	$result = $db->select($query);
				
				$data = ' <div id="print_table"><div class="text-center pb-2">
								<h2>Customer Report</h2>
								
								<h6>Report Type : Agent (Existing Customer)</h6>
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">'.$from_date_show.'<span class="text-danger px-2">To</span>'.$to_date_show.'</h6>
							</div>
						<table class="table table-bordered">
							<thead style="background:#4CAF50; color:white;" >
								<tr>
									<th scope="col">Serial No</th>
									<th scope="col">Customer Name</th>
									<th scope="col">Facebook</th>
									<th scope="col">Number</th>
									<th scope="col">Introduction Date</th>
								</tr>
							</thead>
							<tbody>';
				if ($result) {
					$i = 1;

					while ($row = $result->fetch_assoc()) {
						$order_date = date("Y-m-d", strtotime($row['introduction_date']));
						$order_date = strtotime($order_date);
						if ($order_date >= $from_date && $order_date <= $to_date) {
							$data .='  <tr style="color:black" align="left">
											<td>'.$i++.'</td>
											<td>'.$row['name'].'</td>
											<td><a target="blank" href='.$row['facebook_name'].'>Click Here</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['introduction_date'].'</td>
										</tr>';
							
						}
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
			} //Agent if end
			else{
				$data .='  <tr style="color:black" align="center">
						<td colspan="10"  align="center" style="color:red"> No Record Found</td>
					</tr>';
		}	
} 

