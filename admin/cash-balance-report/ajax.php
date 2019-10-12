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

			$cash_in_hand = 0;
			$total_income = 0;
			$total_software_payment = 0;
			$total_yearly_renew_payment = 0;
			$total_installation_payment = 0;
			$total_graphics_payment = 0;
			$total_convince_bill_income = 0;

			// calculating software payment
			$existing_sof_pay  = 0;
			$query ="SELECT * FROM existing_product_pay";
			$get_existing_exp = $db->select($query);
			if ($get_existing_exp) {
				while ($pay = $get_existing_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['pay_date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$existing_sof_pay += (int)$pay['pay_amount'];
					}
				}
			}

			$new_sof_pay = 0;
			$query ="SELECT * FROM new_product_pay";
			$get_new_exp = $db->select($query);
			if ($get_new_exp) {
				while ($pay = $get_new_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$new_sof_pay += (int)$pay['pay_amount'];
					}
				}
			}
			$total_software_payment = $existing_sof_pay + $new_sof_pay;
	
			// Calculating total yearly renew charge 
	
			$existing_sof_yearly_renew_pay = 0;
			$query ="SELECT * FROM existing_product_yearly_charge_pay";
			$get_existing_renew_exp = $db->select($query);
			if ($get_existing_renew_exp) {
				while ($pay = $get_existing_renew_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$existing_sof_yearly_renew_pay += (int)$pay['pay_amount'];
					}
				}
			}
			$new_sof_yearly_renew_pay = 0;
			$query ="SELECT * FROM new_product_yearly_charge_pay";
			$get_new_renew_exp = $db->select($query);
			if ($get_new_renew_exp) {
				while ($pay = $get_new_renew_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$new_sof_yearly_renew_pay += (int)$pay['pay_amount'];
					}
				}
			}
			$total_yearly_renew_payment = $existing_sof_yearly_renew_pay + $new_sof_yearly_renew_pay;


		// installation charge payment

	
			$existing_sof_installation_pay = 0;
			$query ="SELECT * FROM existing_product_installation_pay";
			$get_existing_installation_exp = $db->select($query);
			if ($get_existing_installation_exp) {
				while ($pay = $get_existing_installation_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['pay_date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$existing_sof_installation_pay += (int)$pay['pay_amount'];
					}
				}
			}
			$new_sof_installation_pay = 0;
			$query ="SELECT * FROM new_product_installation_pay";
			$get_new_installation_exp = $db->select($query);
			if ($get_new_installation_exp) {
				while ($pay = $get_new_installation_exp->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$new_sof_installation_pay += (int)$pay['pay_amount'];
					}
				}
			}
			$total_installation_payment = $existing_sof_installation_pay + $new_sof_installation_pay;

		// Graphics payment

			$query ="SELECT * FROM graphics_pay";
			$get_graphics_pay = $db->select($query);
			if ($get_graphics_pay) {
				while ($pay = $get_graphics_pay->fetch_assoc()) {
					$pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay_date);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$total_graphics_payment += (int)$pay['pay'];
					}
				}
			}
			
		//  Income from convince bill 

			$query ="SELECT * FROM office_expense WHERE invoice_type = 'Income'";
			$get_convince_bill_income = $db->select($query);
			if ($get_convince_bill_income) {
				while ($pay = $get_convince_bill_income->fetch_assoc()) {
					// $pay_date = date("Y-m-d", strtotime($pay['date']));
					$pay_date = strtotime($pay['date']);
					if ($pay_date >= $from_date && $pay_date <= $to_date) {
						$total_convince_bill_income += (int)$pay['total'];
					}
				}
			}
			

		
		$total_income  = $total_software_payment + $total_yearly_renew_payment + $total_installation_payment + $total_graphics_payment + $total_convince_bill_income ;


		// now calculating expense
		$total_expense = 0;
		$total_convince_bill_expense = 0 ;
		$total_graphics_expense = 0 ;

		// convince bill expense
		$query ="SELECT * FROM office_expense WHERE invoice_type = 'Expense'";
		$get_convince_bill_expense = $db->select($query);
		if ($get_convince_bill_expense) {
			while ($pay = $get_convince_bill_expense->fetch_assoc()) {
				$pay_date = strtotime($pay['date']);
				if ($pay_date >= $from_date && $pay_date <= $to_date) {
					$total_convince_bill_expense += (int)$pay['total'];
				}
			}
		}
		
		// graphics expense
		$query ="SELECT * FROM graphics_info";
		$get_graphics_expense = $db->select($query);
		if ($get_graphics_expense) {
			while ($pay = $get_graphics_expense->fetch_assoc()) {
				$pay_date = date("Y-m-d", strtotime($pay['added_at']));
				$pay_date = strtotime($pay_date);
				if ($pay_date >= $from_date && $pay_date <= $to_date) {
					$total_graphics_expense = $total_graphics_expense + (int)$pay['printing_cost'] + (int)$pay['currier_cost'] + (int)$pay['others_cost']; 
				}
			}
		}

		$total_expense = $total_convince_bill_expense + $total_graphics_expense ; 

		$cash_in_hand = $total_income - $total_expense; 


die(json_encode($cash_in_hand));


} 

