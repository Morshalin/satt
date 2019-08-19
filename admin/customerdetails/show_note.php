<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/customerdetails', 'customerdetails');
if (isset($_GET['customerdetails_id'])) {
	$customerdetails_id = $_GET['customerdetails_id'];

$query = "SELECT a.user_name, c.name, n.note, n.creat_date, n.update_date
from satt_admins  a inner join satt_official_notes  n on
a.id = n.admin_id inner join satt_customer_informations  c on 
c.id = n.customer_id where n.admin_id = '$customerdetails_id'";

	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'Note Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
<table class="table">
    <tr>
        <td>Admin Name</td>
        <td><?php echo $row['user_name'];?></td>
    </tr>
    <tr>
        <td>Customer name</td>
        <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
        <td>Customer Note</td>
        <td><?php echo $row['note'];?></td>
    </tr>
    <tr>
        <td>Create Date</td>
        <td><?php echo $row['creat_date'];?></td>
    </tr>
    <tr>
        <td>update Date</td>
        <td><?php echo $row['update_date'];?></td>
    </tr>
</table>
<br>
<div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
<!-- /login form -->
