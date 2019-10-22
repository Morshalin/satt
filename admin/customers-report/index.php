<?php
require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL . '/customers-report', 'Customers Report');
$data = array();
$data['page_title'] = 'Customers Report';
$data['element'] = ['modal' => 'lg'];
$data['page_index'] = 'customers-report';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/admin/customers-report'];
$customer_id =  $user['id'];
?>
<?php include_once '../inc/header.php'; ?>
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
  	
  	<div class="card-body">
  		
      <form class="form-validate-jquery report_form" method="post">
        <fieldset class="mb-3">
    
    <div class="row">
        
        <div class="col-md-3"></div>
        <div class="col-md-6">
        
            <div class="form-group">
                <label for="from_date" class="col-form-label">From Date<span class="text-danger">*</span></label>
                <input type="text" name="from_date" id="from_date" class="form-control date" required>
            </div>
        
            <div class="form-group">
                <label for="to_date" class="col-form-label">To Date<span class="text-danger">*</span></label>
                <input type="text" name="to_date" id="to_date" class="form-control date" required>
            </div>
        
            <div class="form-group">
                <label for="users" class="col-form-label">Users<span class="text-danger">*</span></label>
                <select name="users" id="users" required="" class="form-control">
                    <option value="">Select Person</option>
                    <option value="admin_id">Admin</option>
                    <option value="systems_user_id">System Users</option>
                    <option value="agent_id">Agent</option>
                </select>
            </div>

            <div class="form-group" style="display: none;" id="admin_show">
                <label for="admin" class="col-form-label">Users (Admin)<span class="text-danger">*</span></label>
                <select name="admin" id="admin" required="" class="form-control">
                    <option value="">Select Admin</option>
                     <?php 
                        $query = "SELECT * FROM satt_users where status ='active' && from_table = 'satt_admins' ";
                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) { ?>
                               <option value="<?php echo $row['admin_id'] ?>"><?php echo $row['user_name']; ?> </option>  
                          <?php  } } ?>                
              </select>
            </div>

            <div class="form-group" style="display: none;" id="systems_user_id">
                <label for="system_user" class="col-form-label">Users (System User)<span class="text-danger">*</span></label>
                <select name="system_user" id="system_user" required="" class="form-control">
                    <option value="">Select System User</option>
                     <?php 
                        $query = "SELECT * FROM satt_users where status ='active' && from_table = 'users'";
                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) { ?>
                               <option value="<?php echo $row['systems_user_id'] ?>"><?php echo $row['user_name']; ?> </option>  
                          <?php  } } ?>                
              </select>
            </div>

            <div class="form-group" style="display: none;" id="agent_id">
                <label for="agent" class="col-form-label">Users (Agent)<span class="text-danger">*</span></label>
                <select name="agent" id="agent" required="" class="form-control">
                    <option value="">Select Agent</option>
                     <?php 
                        $query = "SELECT * FROM satt_users where status ='active' && from_table = 'agent_list' ";
                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) { ?>
                               <option value="<?php echo $row['agent_id'] ?>"><?php echo $row['user_name']; ?> </option>  
                          <?php  } } ?>                
              </select>
            </div>
              
        
            <div class="form-group">
                <label for="customer_type" class="col-form-label">Customer Type<span class="text-danger">*</span></label>
                <select name="customer_type" id="customer_type" required="" class="form-control">
                    <option value="intro_customer">Introduced Customer</option>
                    <option value="exis_customer">Existing Customer</option>
                </select>
            </div>


            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary" id="view">View Report</button>
                    
                </div>
            </div>

        </div>
        <div class="col-md-3"></div> 
    </div>


    <div class="div pt-3 " style="border-top: 3px solid #bbb;" id="show_report">
           
    </div>

        </fieldset>
      </form>
    </div>
  </div>
</div>
<!-- /content area -->
<?php include_once '../inc/footer.php'; ?>

</body>
</html>
