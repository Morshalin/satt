<?php
  require_once '../../config/config.php';
  ajax();
if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];
} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/agent/ajax_add_account.php?agent_id=<?php echo $agent_id; ?>" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create Agent Account <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    
    <div class="row">
         <input type="hidden" value="<?php echo $agent_id ?>" name="agent_id">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
           <div class="form-group">
                    <label for="username" class="col-form-label">Userame: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="username" placeholder="Type Agent Userame" required id="username" autofocus >
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
           <div class="form-group">
                    <label for="password" class="col-form-label">Password: <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" placeholder="Type Agent Password " required id="password" autofocus >
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
           <div class="form-group">
                    <label for="confirm_password" class="col-form-label">Confirm Password: <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="confirm_password" placeholder="Type Agent Confirm Password " required id="confirm_password" autofocus >
                    <div id="success"></div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
  
    <div class="form-group row">
        <div class="col-lg-6 offset-lg-3">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
