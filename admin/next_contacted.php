<?php
require_once '../config/config.php';
ajax();
?>
<?php 
    if (isset($_GET['customerdetails_id'])) {
       $customerdetails_id = $_GET['customerdetails_id'];
       //die($customerdetails_id);
?>
<table class="table">
<?php 

$notequery = "SELECT  a.user_name, c.name, c.number, c.email, n.id, n.note, n.next_contact, n.create_date
from satt_next_contacted  n
join satt_admins  a on  n.admin_id  = a.id 
join satt_customer_informations  c on n.customer_id  = c.id
and n.id = '$customerdetails_id'";
  $noteresult = $db->select($notequery);
  if ($noteresult) {
    while ($notedata = $noteresult->fetch_assoc()) { 
      ?>
      <div id="tr_<?php echo $notedata['id']; ?>">
      <tr>
        <td>Admin Name</td>
        <td><?php echo $notedata['user_name'];?></td>
      </tr>
      <tr>
        <td>Customer name</td>
        <td><?php echo $notedata['name'];?></td>
      </tr>
      <tr>
        <td>Customer Number</td>
        <td><?php echo $notedata['number'];?></td>
      </tr>
      <tr>
        <td>Customer Email</td>
        <td><?php echo $notedata['email'];?></td>
      </tr>
      <tr>
        <td>Customer Note</td>
        <td><?php echo $notedata['note'];?></td>
      </tr>
      <tr>
        <td>Next Contacted Date</td>
        <td><?php echo $notedata['next_contact'];?></td>
      </tr>
      <tr>
        <td>Create Date</td>
        <td><?php echo $notedata['create_date'];?></td>
      </tr>
      <tr>
        <td></td>
        <td><button class="btn btn-danger btn-sm delete_note" data-url="<?php echo ADMIN_URL ?>/ajax.php?update_id=<?php echo $notedata['id']; ?>" id="<?php echo $notedata['id']; ?>">Remove</button></td>
      </tr>
    </div>
   <?php } } ?>

</table>




<?php } ?>
<!-- /login form -->
