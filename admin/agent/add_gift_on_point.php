<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM agent_provide_gift WHERE agent_id='$agent_id' ORDER BY id DESC";
    $result = $db->select($query);

    $query = "SELECT * FROM agent_list WHERE id='$agent_id'";
    $get_agent_info  = $db->select($query)->fetch_assoc();
    $agent_point = $get_agent_info['points'];
    

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_gift_on_point.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Gift <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
   <div class="row">
         <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="gift_id" class="col-form-label">Select Desired Gift  <span class="text-danger">*</span></label>
               
                <select name="gift_id" id="gift_id" class="form-control">
                    <option value="">Please Select One Gift</option>
                    <?php 
                        $query = "SELECT * FROM agent_gift WHERE status = 1  AND points <= '$agent_point'";
                        $get_gift = $db->select($query);
                        if ($get_gift) {
                            while ($row = $get_gift->fetch_assoc()) {
                                // if ($row['points'] <=  '$agent_point') {
                                    
                                
                                ?>
                                <option value="<?php echo($row['id']) ?>"><?php echo 'Gift Name: '.$row['gift_name'].' --> Points: '.$row['points']; ?></option>
                                <?php
                                // }
                            }
                        }
                     ?>
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
        <h5 class="card-title text-center"><?php echo isset($data['page_title']) ? $data['page_title'] : 'List Of Gifts That Are Provided'; ?>
        
        </h5>
       
    </div>
    <div class="card-body">
       
        <div id="table_display">
            <table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gift Name</th>
                        <th>Cost Points</th>
                        <th>Date & Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                        if ($result) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $id = $row['id'];
                                ?>
                                <tr id="tr_<?php echo $id ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['gift_name']; ?></td>
                                    <td><?php echo $row['cost_point']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><button class="btn btn-danger delete_provided_gift" data-url="<?php echo ADMIN_URL ?>/agent/ajax_delete.php?agent_provided_gift_id=<?php echo $id ?>&agent_id=<?php echo $agent_id; ?>" id="<?php echo $id ?>" data-agent_id="<?php echo($agent_id) ?>">Delete</button></td>
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
