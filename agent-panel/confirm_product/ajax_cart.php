<?php
require_once '../../config/config.php';
if (isset($_POST['customer_id'])) {
	$customer_id = $_POST['customer_id'];
	$software_id = $_POST['software_id'];
	$pay_type = $_POST['pay_type'];

	$agent_query = "SELECT * FROM agent_client WHERE client_id ='$customer_id'";
	$agent_result = $db->select($agent_query);
	if ($agent_result) {
		$agent_data = $agent_result->fetch_assoc();
		$agent_id = $agent_data['agent_id'];
	}else{
		$agent_id='';
	}

	$querys = "SELECT * FROM software_price_log WHERE software_id ='$software_id'";
	$get_soft_info = $db->select($querys);
	if ($get_soft_info) {
		$soft_info = $get_soft_info->fetch_assoc();
	}

	$query = "SELECT * FROM satt_customer_informations WHERE id ='$customer_id'";
	$get_customer_info = $db->select($query);
	if ($get_customer_info) {
		$customer_info = $get_customer_info->fetch_assoc();
	}

	if($pay_type == 'monthly_pay'){
		$pay_amount = $soft_info['monthly_charge'];
		if ($agent_id !='') {
			$agent_comission = $soft_info['agent_commission_monthly'];
		}else{
			$agent_comission = '';
		}
	}else if($pay_type == 'yearly_pay'){
		$pay_amount = $soft_info['yearly_charge'];
		if ($agent_id !='') {
			$agent_comission = $soft_info['agent_commission_yearly'];
		}else{
			$agent_comission = '';
		}
	}else if($pay_type == 'direct_sell'){
       $pay_amount = $soft_info['direct_sell'];
		if ($agent_id !='') {
			$agent_comission = $soft_info['agent_commission_one_time'];
		}else{
			$agent_comission = '';
		}
	}

	$Check_cart = $fm->dublicateCheck('satt_order_products', 'product_id', $software_id);
	if($Check_cart){
		$message = 'Product Already Purchased';
		$type = "error";
		die(json_encode(['message'=>$message,'type'=>$type]));
	}else{

	$customer_name = $customer_info['name'];
	$customer_number = $customer_info['number'];
	$product_name = $soft_info['software_name'];
	$installation_charge = $soft_info['installation_charge'];
	$yearly_renew_charge = $soft_info['yearly_renew_charge'];


	$query = "INSERT INTO satt_order_products 
			  (customer_id,customer_name,customer_number,agent_id,product_id,product_name,pay_type,installation_charge,pay_amount,agent_comission,yearly_renew_charge,order_date)
			  VALUES 
			  ('$customer_id','$customer_name','$customer_number','$agent_id','$software_id','$product_name','$pay_type','$installation_charge','$pay_amount','$agent_comission','$yearly_renew_charge',now())";

	$insert = $db->insert($query);

	if ($insert) {
		$message = 'Product Purchased Successfully';
		$type = "success";
		die(json_encode(['message'=>$message,'type'=>$type]));
	}else{
		$message = 'Product Not Purchased Successfully';
		$type = "error";
		die(json_encode(['message'=>$message,'type'=>$type]));
	}

}
}
?>