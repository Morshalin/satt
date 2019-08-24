<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM agent_selling_product_list WHERE agent_id='$agent_id'";
    $result = $db->select($query);
    

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Selling Software <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Software <span class="text-danger">*</span></label>
                <select class="select form-control"  name="software_id" id="software_id">
                    <option value="">Select Software</option>
                       <?php
                       $query_software_status = "SELECT * FROM software_details";
                       $software_info = $db->select($query_software_status);
                       if ($software_info) {
                        while ($row = $software_info->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $row['id'].','.$row['software_name']; ?>" ><?php echo $row['software_name']; ?></option>

                        <?php } }?>
                </select>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="software_status" class="col-form-label">Customer <span class="text-danger">*</span></label>
                <select class="select form-control"  name="customer_id" id="customer_id">
                    <option value="">Select Customer</option>
                       <?php
                       $query = "SELECT * FROM agent_client WHERE agent_id = '$agent_id'";
                       $customer_info = $db->select($query);
                       if ($customer_info) {
                        while ($row = $customer_info->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $row['id'].','.$row['client_name']; ?>" ><?php echo $row['client_name']; ?></option>

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
        <h5 class="card-title text-center"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Selling Software List'; ?>
        
        </h5>
       
    </div>
    <div class="card-body">
       
        <div id="table_display">
            <table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Software Name</th>
                        <th>Client Name</th>
                        <th>Sell Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                        if ($result) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $date = $row['sell_date'];
                                $date = date('d-M-Y', strtotime($date));
                                $id_product = $row['id'];
                                ?>
                                <tr id="tr_<?php echo $id_product ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['software_name']; ?></td>
                                    <td><?php echo $row['client_name']; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><button class="btn btn-danger delete_agetnt_product" data-url="<?php echo ADMIN_URL ?>/agent/ajax_delete.php?agent_product_id=<?php echo $id_product ?>" id="<?php echo $id_product ?>">Delete</button></td>
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
