<?php
require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL . '/cash-balance-report', 'Cash Balance');
$data = array();
$data['page_title'] = 'Cash Balance';
$data['element'] = ['modal' => 'lg'];
$data['page_index'] = 'cash-balance-report';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/admin/cash-balance-report'];
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
        
           
            
            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary ml-31" id="view">View Report</button>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3"></div> 
    </div>


    <div class="div pt-3 " style="border-top: 3px solid #bbb;" id="show_report">








    <div id="print_table"><div class="text-center pb-2">
								<h2>Cash Balance</h2>
								
								<h6 style="border-bottom: 2px dotted blue; padding-bottom: 10px;">10.10.1994<span class="text-danger px-2">To</span>10.10.1994</h6>
              </div>

<div class="row text-center">
  <div class="col-md-6">
    <p class="py-2 text-light" style="background-color:#4CAF50;"> Income</p>
    <br>
    <div class="row border">
      <div class="col-md-6 border-right">
        <p class="m-0 py-2"> Dinner </p>
      </div>
      <div class="col-md-6">
        <p class="m-0 py-2"> 2000 TK</p>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <p class="py-2 text-light" style="background-color:#4CAF50;"> Expense</p>

    <br>
    <div class="row border ">
      <div class="col-md-6 border-right">
        <p class="m-0 py-2"> Dinner </p>
      </div>
      <div class="col-md-6">
        <p class="m-0 py-2"> 2000 TK</p>
      </div>
    </div>
  </div>
  </div>
  <div class="row pt-3">
    <div class="col-md-12 text-center border">
      <p class="mb-0 py-2"> Cash In Hand : <span>500 /=</span></p>
    </div>
  </div>
</div>

							<div class="mt-3">
							<a class=" text-light btn-success btn" onclick="printContent('print_table')"><i class="icon-printer"></i> Print</span> </a>
							</div>

























           
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
