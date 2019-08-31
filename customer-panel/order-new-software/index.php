<?php
require_once '../../config/config.php';
Session::checkSession('customer-panel', CUSTOMER_URL . '/order-new-software', 'Order New Software');
$data = array();
$data['page_title'] = 'Order New Software';
$data['element'] = ['modal' => 'lg'];
$data['page_index'] = 'order-new-software';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/customer-panel/order-new-software'];
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
  		
      <form class="form-validate-jquery" action="<?php echo(CUSTOMER_URL) ?>/order-new-software/ajax.php" id="content_form" method="post">
        <fieldset class="mb-3">
          <legend class="text-uppercase font-size-sm font-weight-bold">Add New Software Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


          <section class="fromarea">
            <div class="container py-5 bg-white" style="width: 100%; padding-right: 5%; padding-left: 5%; margin-top: -20px">



              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Expected Name of Software: <span class="text-danger">*</span></label>
                    <input type="text" name="expected_name_software" id="expected_name_software" class="form-control" placeholder="Provide a name" required="">
                  </div>
                </div>
                
                <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id ?>">

              </div>

              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Note For Software Feature: <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="documentation_note" id="documentation_note" cols="30" rows="10" required=""></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" style=" margin-top: 40px;">
                  <div class="form-group">
                    <label for="name" class="col-form-label"><span>Upload Documnt Of Feature</span> </label>
                    <input type="file" name="file_upload_documentation" id="file_upload_documentation" class="form-control"  autofocus>
                  </div>
                </div>

              </div>




              <div class="row">
                <div class="col-lg-12 ">
                  <div class="form-group" align="center">

                    <input type="submit"   name="submit" style="width: 40%;" id="submit" class="btn btn-success"  value="Submit" >
                    <input type="button"   name="submiting" style="width: 40%; display: none;" id="submiting" class="btn btn-success"  value="Submitting" disabled="">
                  </div>
                </div>
              </div>





            </div>
          </section>

        </fieldset>
      </form>
    </div>
  </div>
</div>
<!-- /content area -->
<?php include_once '../inc/footer.php'; ?>
<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/tables/datatables/extensions/select.min.js"></script>
<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
</body>
</html>
