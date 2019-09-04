<?php
  require_once '../../config/config.php';
  Session::checkSession('agent-panel', AGENT_URL.'/profile', 'Agent Profile');
  $data['page_title'] = 'Agent Profile';
  $data['page_index'] = 'profile';
 include_once '../inc/header.php'; 
  $userid = $user['id'];
  $query = "SELECT * FROM agent_list WHERE id = '$userid'";
  $result = $db->select($query);
  if ($result) {
    $row = $result->fetch_assoc();
  }
?>
<!-- Page header -->
<div class="page-header page-header-light">

  <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
      <div class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item active"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Dashboard'; ?></span>
      </div>

      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>

  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
  <div class="card border-top-success rounded-top-0" id="table_card">
  	<div class="card-header header-elements-inline bg-light border-grey-300" >
  		<h5 class="card-title"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Dashboard'; ?>
  		</h5>
  		<div class="header-elements">
  			<div class="list-icons">
  				<a class="list-icons-item" data-action="fullscreen" title="FullScreen" data-popup="tooltip" data-placement="bottom"></a>
  				<a class="list-icons-item" data-action id="reload" title="Reload" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
  				<a class="list-icons-item" data-action="collapse" title="Collapse" data-popup="tooltip" data-placement="bottom"></a>
  			</div>
  		</div>
  	</div>
    <div class="card-body">
      <form class="form-validate-jquery" action="<?php echo AGENT_URL; ?>/profile/ajax.php?user_id=<?php echo $userid; ?>" id="content_form" method="post">
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Your Profile <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="first_name" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Type Your first name" required autofocus value="<?php echo $row['name']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="username" class="col-form-label">User Name <span class="text-danger">(Not editable)</span></label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Type Your user name" readonly autofocus value="<?php echo $row['username']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email" class="col-form-label">Email <span class="text-danger">(Not editable)</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Type Your Email" readonly autofocus value="<?php echo $row['email']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="mobile_no" class="col-form-label">Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Type Your Mobile No" required autofocus value="<?php echo $row['mobile_no']; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="old_pass" class="col-form-label">Old Password </label>
                <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="Enter Your Old Password" autofocus >
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="new_pass" class="col-form-label">New Password </label>
                <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="Enter Your New Password" autofocus >
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
        </div>
    </div>
</fieldset>
</form>
    </div>
  </div>
</div>
<!-- /content area -->
<?php include_once '../inc/footer.php'; ?>
<script>
  _formValidation();
</script>
</body>
</html>
