<?php
  require_once '../../config/config.php';
  Session::checkSession('customer-panel', CUSTOMER_URL.'/profile', 'CustomerProfile');
  $data['page_title'] = 'CustomerProfile';
  $data['page_index'] = 'profile';
 include_once '../inc/header.php'; 
  $userid = $user['id'];
  $query = "SELECT * FROM satt_customer_informations WHERE id = '$userid'";
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
      <form class="form-validate-jquery" action="<?php echo CUSTOMER_URL; ?>/profile/ajax.php?user_id=<?php echo $userid; ?>" id="content_form" method="post">
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Update Your Profile <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">

        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-form-label"> Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type Your first name" required autofocus value="<?php echo $row['name']; ?>">
                <input type="hidden" name="customer_user_id" value="<?php echo $row['user_id']; ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="facebook_name" class="col-form-label">Facebook Name<span class="text-danger">*</span></label>
                <input type="text" name="facebook_name" id="facebook_name" class="form-control" placeholder="Type Your first facebook_name" required autofocus value="<?php echo $row['facebook_name']; ?>">
            </div>
        </div>
        
       <!--  <div class="col-lg-6">
           <div class="form-group">
               <label for="last_name" class="col-form-label">Last Name <span class="text-danger">*</span></label>
               <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Type Your last name" required autofocus value="<?php //echo $row['last_name']; ?>">
           </div>
       </div>
       <div class="col-lg-6">
           <div class="form-group">
               <label for="user_name" class="col-form-label">User Name <span class="text-danger">*</span></label>
               <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Type Your user name" required autofocus value="<?php //echo $row['user_name']; ?>">
           </div>
       </div> -->
       <!--  <div class="col-lg-6">
           <div class="form-group">
               <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
               <input type="email" name="email" id="email" class="form-control" placeholder="Type Your Email" required autofocus value="<?php //echo $row['email']; ?>">
           </div>
       </div> -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="number" class="col-form-label">Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="number" id="number" class="form-control" placeholder="Type Your Mobile No" required autofocus value="<?php echo $row['number']; ?>">
            </div>
        </div>
        <!-- <div class="col-lg-6">
            <div class="form-group">
                <label for="alternate_mobile_no" class="col-form-label">Alternate Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="alternate_mobile_no" id="alternate_mobile_no" class="form-control" placeholder="Type Your Alternate Mobile No" autofocus value="<?php //echo $row['alternate_mobile_no']; ?>">
            </div>
        </div> -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="image" class="col-form-label">Image </label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Enter Your Image" autofocus value="">
            </div>
        </div>
        <!-- <div class="col-lg-6">
            <div class="form-group">
                <label for="bio" class="col-form-label">Bio </label>
                <textarea name="bio" id="bio" class="form-control" placeholder="Type your bio" autofocus ><?php //echo $row['bio']; ?></textarea>
            </div>
        </div> -->
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
