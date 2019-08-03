<?php
require_once dirname(__FILE__) . '/../../config/config.php';
$data = array();
$data['page_title'] = '404 Page not found';
$data['page_css'] = [];
$data['page_js'] = [];
include_once dirname(__FILE__) . '/../../admin/inc/header_without_sidebar.php';

?>

<!-- Page header -->
<div class="page-header page-header-light">

  <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
      <div class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item active">error</span>
        <span class="breadcrumb-item active">404</span>
      </div>

      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>

  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content d-flex justify-content-center align-items-center">

	<!-- Container -->
	<div class="flex-fill">

		<!-- Error title -->
		<div class="text-center mb-3">
			<h1 class="error-title">404</h1>
			<h5>Oops, an error has occurred. Page not found!</h5>
		</div>
		<!-- /error title -->
    <div class="row">
						<div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">

							<!-- Buttons -->
							<div class="row">
								<div class="col-sm-6 offset-3">
									<a href="<?php echo BASE_URL; ?>/student" class="btn btn-link btn-block"><i class="icon-home mr-2"></i> Dashboard</a>
								</div>
							</div>
							<!-- /buttons -->

						</div>
					</div>

	</div>
	<!-- /container -->

</div>
<!-- /content area -->


<?php include_once dirname(__FILE__) . '/../../student/inc/footer.php';?>

</body>
</html>
