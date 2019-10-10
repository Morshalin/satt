<?php
require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL . '/existing-software-report', 'Report Of Existing Software');
$data = array();
$data['page_title'] = 'Report Of Existing Software';
$data['element'] = ['modal' => 'lg'];
$data['page_index'] = 'existing-software-report';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/admin/existing-software-report'];
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
                <label for="report_type" class="col-form-label">Report Type<span class="text-danger">*</span></label>
                <select name="report_type" id="report_type"  class="form-control" required>
                    <option value="">Please Select One...</option>
                    <option value="all">All Orders</option>
                    <option value="cost_profit">Cost & Profit Report</option>
                    <option value="status">Status Report</option>
                    <option value="transaction">Transaction Report</option>
                </select>
            </div>
        
            <div class="form-group status_div" style="display:none" >
                <label for="status" class="col-form-label">Please Select A Status<span class="text-danger">*</span></label>
                <select name="status" id="status"  class="form-control">
                    <option value="">Please Select One...</option>
                    <option value="Pending">Pending</option>
                    <option value="Developing">Developing</option>
                    <option value="Printing">Printing</option>
                    <option value="Sent To Currier">Sent To Currier</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancel Order</option>
                </select>
            </div>
        
            <div class="form-group transaction_type_div" style="display:none" >
                <label for="transaction_type" class="col-form-label">Transaction Type<span class="text-danger">*</span></label>
                <select name="transaction_type" id="transaction_type"  class="form-control">
                    <option value="">Please Select One...</option>
                    <?php 

                      $query = "SELECT DISTINCT(payment_method) from graphics_pay";
                      $get_payment_method = $db->select($query);
                      if ($get_payment_method) {
                        while ($row = $get_payment_method->fetch_assoc()) {
                          ?>
                            <option value="<?php echo $row['payment_method'] ?>"><?php echo $row['payment_method'] ?></option>
                          <?php
                        }
                      }
                    
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary ml-31" id="view">View Report</button>
                    
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
