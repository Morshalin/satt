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
  <tr>
   <th>Admin Name</th>
   <th>Customer name</th>
   <th>Customer Note</th>
   <th>Next Contacted Date</th>
   <th>Create Date</th>
   <th>Action</th>
</tr>
<?php 

$notequery = "SELECT  a.user_name, c.name, n.id, n.note, n.next_contact, n.create_date
from satt_next_contacted  n
join satt_admins  a on  n.admin_id  = a.id 
join satt_customer_informations  c on n.customer_id  = c.id
and n.id = '$customerdetails_id'";
  $noteresult = $db->select($notequery);
  if ($noteresult) {
    while ($notedata = $noteresult->fetch_assoc()) { 
      ?>
        <tr id="tr_<?php echo $notedata['id']; ?>">
        <td><?php echo $notedata['user_name'];?></td>
        <td><?php echo $notedata['name'];?></td>
        <td><?php echo $notedata['note'];?></td>
        <td><?php echo $notedata['next_contact'];?></td>
        <td><?php echo $notedata['create_date'];?></td>
        <td><button class="btn btn-danger btn-sm delete_note" data-url="<?php echo ADMIN_URL ?>/ajax.php?update_id=<?php echo $notedata['id']; ?>" id="<?php echo $notedata['id']; ?>">Remove</button></td>
    </tr>
   <?php } } ?>

</table>




<?php } ?>
<!-- /login form -->
