<?php
require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL . '/new_order_form_available', 'New Order form available');
$data = array();
$data['page_title'] = 'New Order form available';
$data['element'] = ['modal' => 'lg'];
$data['page_index'] = 'new_order_form_available';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/admin/new_order_form_available'];
//$customer_id =  $user['id'];
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
  		
      <form class="form-validate-jquery" id="cart_form" action="" method="post">
        <fieldset class="mb-3">
          <legend class="text-uppercase font-size-sm font-weight-bold">Add New Software Order <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>


          <section class="fromarea">
            <div class="container py-5 bg-white" style="width: 100%; padding-right: 5%; padding-left: 5%; margin-top: -20px">



              <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Select Availible Software: <span class="text-danger">*</span></label>
                        <select name="software_id" id="software_id" class="form-control select">
                        <option value="" >Select One</option>
                      <?php 
                      $query = "SELECT * FROM software_details";
                      $result = $db->select($query);
                      if ($result) {
                        while ($data = $result->fetch_assoc()) {  ?>
                          <option value="<?php echo $data['id']; ?>"><?php echo $data['software_name']; ?></option>
                           <?php } } ?>
                        </select>
                  </div>
                </div>
                <div class="col-lg-2"></div>

                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Select Agent<span class="text-danger">*</span></label>
                        <select name="agent_id" id="agent_id" class="form-control select">
                          <option value="">Please Select One</option>
                           <option value="0">No Agent</option>
                      <?php 
                      $query = "SELECT * FROM agent_list";
                      $result = $db->select($query);
                      if ($result) {
                        while ($data = $result->fetch_assoc()) {  ?>
                          <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                           <?php } } ?>
                        </select>
                  </div>
                </div>
                <div class="col-lg-2"></div>

                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Select Customer: <span class="text-danger">*</span></label>
                      <select name="customer_id" id="customer_id" class="form-control select">
                        <option value="">Please Select Agent</option>
                        </select>
                  </div>
                </div>
                <div class="col-lg-2"></div>

                  <div class="col-lg-2"></div>
                  <div class="col-lg-8">
                      <div class="form-group">
                          <label for="pay_types" class="col-form-label"><strong>Select Pay Type </strong><span class="text-danger">*</span></label>

                          <select class="select form-control"  name="pay_type" id="pay_type">
                            <option value="">Please Select one</option>
                              <option value="monthly_pay"> Monthly Pay</option>
                              <option value="yearly_pay">Yearly Pay</option>
                              <option value="direct_sell">Direct Sell</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-lg-2"></div>
            
                
               

              </div>

              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Note For Software Feature: <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="documentation_note" id="documentation_note" cols="30" rows="10"></textarea>
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

<script type="text/javascript">
  $(document).ready(function(){

      $(document).on('change','#agent_id', function(e){
          e.preventDefault();
          var agent_id = $("#agent_id").val();
          if (agent_id) {
            $.ajax({
              url: './custome_ajax.php',
              data:{agent_name:agent_id},
              type: 'post',
              dataType: 'json',
              success: function(data){
                  //console.log(data);
                  $("#customer_id").html(data);
              }
          });
        } 
      });



        $(document).on('submit','#cart_form',function(e){
            e.preventDefault();
            console.log("Hello");
            var software_id = $('#software_id').val();
            var customer_id = $('#customer_id').val();
            var pay_type = $('#pay_type').val();
            var agent_id = $('#agent_id').val();
            var documentation_note = $('#documentation_note').val();
            console.log(agent_id);
            $.ajax({
                //url: './admin/new_order_form_available/insert_ajax.php',
                url: './insert_ajax.php',
                data:{
                    software_id : software_id,
                    customer_id : customer_id,
                    pay_type : pay_type,
                    agent_id: agent_id,
                    documentation_note:documentation_note 
                },
                type: 'post',
                dataType: 'json',
                success: function(data){
                   $("option:selected").prop("selected", false);
                   $('#documentation_note').val('');
                    p_notify(data.message, data.type, jsUcfirst(data.type));
                  
                }
            });
        });
      
  });
</script>
</body>
</html>
