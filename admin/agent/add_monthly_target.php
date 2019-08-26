<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM agent_target WHERE agent_id='$agent_id' ORDER BY id DESC";
    $result = $db->select($query);

    // $query = "SELECT * FROM agent_list WHERE id='$agent_id'";
    // $get_agent_info  = $db->select($query)->fetch_assoc();
 
    

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_add_target.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Add Monthly Target <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
   <div class="row">
         <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="month" class="col-form-label">Month  <span class="text-danger">*</span></label>
               <input type="month" class="form-control" name="month" id="month" >
                

            </div>
        </div>
        <div class="col-lg-3"></div>

        <!-- <div class="col-lg-4"></div> -->
    </div>
    
   <div class="row">
    
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="target_amount" class="col-form-label">Target Amount <span class="text-danger">*</span></label>
               <input type="number" min="0" class="form-control" name="target_amount" id="target_amount" >
            </div>
        </div>
        <div class="col-lg-3"></div>

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
        <h5 class="card-title text-center"><?php echo isset($data['page_title']) ? $data['page_title'] : 'List Of Monthly Target'; ?>
        
        </h5>
       
    </div>
    <div class="card-body">
       
        <div id="table_display">
            <table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Month Name</th>
                        <th>Target Amount</th>
                        <th>Assign Date & Time</th>
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
                                $month =explode('-', $row['month']);
                                $month_number = $month[1]; 
                                switch ($month_number) {
                                    case '1':
                                        $month_name = 'January - '.$month[0];
                                        break;
                                    
                                    case '2':
                                        $month_name = 'February - '.$month[0];
                                        break;
                                    
                                    case '3':
                                        $month_name = 'March - '.$month[0];
                                        break;
                                    
                                    case '4':
                                        $month_name = 'April - '.$month[0];
                                        break;
                                    
                                    case '5':
                                        $month_name = 'May - '.$month[0];
                                        break;
                                    
                                    case '6':
                                        $month_name = 'Jun - '.$month[0];
                                        break;
                                    
                                    case '7':
                                        $month_name = 'July - '.$month[0];
                                        break;
                                    
                                    case '8':
                                        $month_name = 'August - '.$month[0];
                                        break;
                                    
                                    case '9':
                                        $month_name = 'September - '.$month[0];
                                        break;
                                    
                                    case '10':
                                        $month_name = 'October - '.$month[0];
                                        break;
                                    
                                    case '11':
                                        $month_name = 'November - '.$month[0];
                                        break;
                                    
                                    case '12':
                                        $month_name = 'December - '.$month[0];
                                        break;
                              
                                }
                                ?>
                                <tr id="tr_<?php echo $id ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $month_name; ?></td>
                                    <td><?php echo $row['target_amount']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><button class="btn btn-danger delete_agent_target" data-url="<?php echo ADMIN_URL ?>/agent/ajax_delete.php?agent_target_id=<?php echo $id ?>" id="<?php echo $id ?>" data-agent_id="<?php echo($agent_id) ?>">Delete</button></td>
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
