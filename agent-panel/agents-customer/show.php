<?php
require_once '../../config/config.php';
ajax();
  Session::checkSession('agent-panel', AGENT_URL.'/agents-customer', 'Agents Customer');
if (isset($_GET['agents_customer_id'])) {
    $agents_customer_id = $_GET['agents_customer_id'];
    $query = "SELECT * FROM satt_customer_informations WHERE id='$agents_customer_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Customer Information Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<table class="table table-bordered">
    <tr>
        <td class="font-weight-bold">Cutomer Name</td>
        <td><?php echo $row['name']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Facebookn Name </td>
        <td><?php echo $row['facebook_name']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Number</td>
        <td><?php echo $row['number']?></td>
    </tr>
     <tr>
        <td class="font-weight-bold">Email Address</td>
        <td><?php echo $row['email']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Introduction Date</td>
        <td><?php echo $fm->formatDate($row['introduction_date']); ?></td>
    </tr>
     <tr>
        <td class="font-weight-bold">Customer Reference</td>
        <td><?php echo $row['customer_reference']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Progressive State</td>
        <td><?php echo $row['progressive_state']?></td>
    </tr>
     <tr>
         <td class="font-weight-bold">Interested Service</td>
         <td>
         <?php 
             $sql = "SELECT satt_customer_interestedservice.services from  satt_interested_services inner join  satt_customer_interestedservice on satt_interested_services.interested_services_id = satt_customer_interestedservice.id where satt_interested_services.cutomer_details_id = '$agents_customer_id'";
     
             $result = $db->select($sql);
             if ($result) {
                 while ($data = $result->fetch_assoc()) { ?>
                    <span class="badge badge-success mr-1"><?php echo $data['services']; ?></span>
                 <?php } } ?>
            
         </td>
     </tr> 

    <tr>
        <td class="font-weight-bold">Institute Type</td>
        <td><?php echo $row['institute_type']?></td>
    </tr>

    <tr>
        <td class="font-weight-bold">Institute Name</td>
        <td><?php echo $row['institute_name']?></td>
    </tr>

     <tr>
        <td class="font-weight-bold">Institute Address</td>
        <td><?php echo $row['institute_address']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Institute District</td>
        <td><?php echo $row['institute_district']?></td>
    </tr>
    <tr>
        <td class="font-weight-bold">Software Category</td>
       <td>
         <?php 
             $sql = "SELECT software_details.software_name from  sat_software_category inner join  software_details on sat_software_category.software_id = software_details.id where sat_software_category.cutomer_details_id = '$agents_customer_id'";
     
             $result = $db->select($sql);
             if ($result) {
                 while ($data = $result->fetch_assoc()) { ?>
                    <span class="badge badge-success mr-1"><?php echo $data['software_name']; ?></span>
                 <?php } } ?>
            
         </td>
    </tr>
    <tr>
        <td class="font-weight-bold">Last Contact Date</td>
        <td><?php echo $fm->formatDate($row['last_contacted_date']); ?></td>
    </tr>
</table>
<br >

<div class="form-group row">
    <div class="col-lg-8 offset-lg-4">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        
    </div>
</div>
<!-- /login form -->
