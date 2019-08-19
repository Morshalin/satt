<?php
  require_once '../../config/config.php';
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
  $data = array();
  $data['page_title'] = 'Manage Agent ';
  $data['element'] = ['modal' => 'full'];
  $data['page_index'] = 'agent';
  $data['page_css'] = [];
  $data['page_js'] = ['assets/js/admin/agent'];
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
  	<div class="card-header header-elements-inline bg-light border-grey-300" >
  		<h5 class="card-title"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Dashboard'; ?>
  		<a href="../../agent/index.php" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>Register New Agent</a>
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
  		<!-- <div class="text-center">
  			<img src="<?php echo BASE_URL; ?>/assets/preloader.gif" id="table_loading" width="100px">
  		</div> -->
  		<div id="table_display">
  			<table class="table content_managment_table" data-url="<?php echo ADMIN_URL; ?>/agent/table.php">
  				<thead>
  					<tr>
  						<th>#</th>
  						<th>Name</th>
              <th>Image</th>
              <th>Contact</th>
              <th>Interested</th>
              <th>Status</th>
  						<th>Action</th>
  					</tr>
  				</thead>
  				<tbody>
  				</tbody>
  			</table>
  		</div>
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
