<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM agent_client WHERE agent_id='$agent_id'";
    $result = $db->select($query);
    

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_add_agent_client.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Client <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
    <div class="row">
         <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Customer <span class="text-danger">*</span></label>
                <select class="select form-control"  name="client_id" id="client_id">
                    <option value="">Select Customer</option>
                       <?php
                       $query = "SELECT * FROM satt_customer_informations ";
                       $customer_info = $db->select($query);
                       if ($customer_info) {
                        while ($row = $customer_info->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $row['id'].','.$row['name']; ?>" ><?php echo $row['name']; ?></option>

                        <?php } }?>
                </select>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
  
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>

<div class="content">
  <div class="card border-top-success rounded-top-0" id="table_card">
    <div class="card-header header-elements-inline bg-light border-grey-300" >
        <h5 class="card-title text-center"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Customer List'; ?>
        
        </h5>
       
    </div>
    <div class="card-body">
       
        <div id="table_display">
            <table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Added At Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                        if ($result) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $date = $row['add_date'];
                                $date = date('d-M-Y', strtotime($date));
                                $id = $row['id'];
                                ?>
                                <tr id="tr_<?php echo $id ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['client_name']; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><button class="btn btn-danger delete_agetnt_client" data-url="<?php echo ADMIN_URL ?>/agent/ajax_delete.php?agent_client_id=<?php echo $id ?>" id="<?php echo $id ?>">Delete</button></td>
                                </tr>
                                <?php
                            }
                        }


                     ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<!-- /login form -->
