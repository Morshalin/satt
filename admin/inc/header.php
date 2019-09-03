<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo isset($data['page_title']) ? $data['page_title'].TITLE_DIVIDER.TITLE : TITLE ; ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/assets/css/colors.min.css" rel="stylesheet" type="text/css">

	<link href="<?php echo ADMIN_URL; ?>/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/parsley.css">
	<style>
    .pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#29d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}.pace .pace-progress-inner{display:block;position:absolute;right:0;width:100px;height:100%;box-shadow:0 0 10px #29d,0 0 5px #29d;opacity:1;-webkit-transform:rotate(3deg) translate(0,-4px);-moz-transform:rotate(3deg) translate(0,-4px);-ms-transform:rotate(3deg) translate(0,-4px);-o-transform:rotate(3deg) translate(0,-4px);transform:rotate(3deg) translate(0,-4px)}.pace .pace-activity{display:block;position:fixed;z-index:2000;top:15px;right:15px;width:14px;height:14px;border:solid 2px transparent;border-top-color:#29d;border-left-color:#29d;border-radius:10px;-webkit-animation:pace-spinner .4s linear infinite;-moz-animation:pace-spinner .4s linear infinite;-ms-animation:pace-spinner .4s linear infinite;-o-animation:pace-spinner .4s linear infinite;animation:pace-spinner .4s linear infinite}@-webkit-keyframes pace-spinner{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes pace-spinner{0%{-moz-transform:rotate(0);transform:rotate(0)}100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}@-o-keyframes pace-spinner{0%{-o-transform:rotate(0);transform:rotate(0)}100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes pace-spinner{0%{-ms-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes pace-spinner{0%{transform:rotate(0);transform:rotate(0)}100%{transform:rotate(360deg);transform:rotate(360deg)}}
</style>
	<!-- /global stylesheets -->
  <?php
    if (isset($data['page_css'])) {
      foreach ($data['page_css'] as $value) {
        ?>
  <link href="<?php echo BASE_URL; ?>/<?php echo $value; ?>.css" rel="stylesheet" type="text/css">
        <?php
      }
    }
  ?>

	<script>

		const ADMIN_URL = '<?php echo BASE_URL; ?>/admin';
		const BASE_URL = '<?php echo BASE_URL; ?>';

  </script>

</head>

<body>
<?php if (Session::get('admin')) {
	?>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
    <!-- Header with logos -->
		<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
			<div class="navbar-brand navbar-brand-md">
				<a href="<?php echo ADMIN_URL; ?>" class="d-inline-block">
					<?php echo getLogo(); ?>
				</a>
			</div>

			<div class="navbar-brand navbar-brand-xs">
				<a href="<?php echo ADMIN_URL; ?>" class="d-inline-block">
					<?php echo getSmLogo(); ?>
				</a>
			</div>
		</div>
		<!-- /header with logos -->


		<!-- Mobile controls -->
		<div class="d-flex flex-1 d-md-none">
			<div class="navbar-brand mr-auto">
				<a href="<?php echo ADMIN_URL; ?>" class="d-inline-block">
					<?php echo getLogo(); ?>
				</a>
			</div>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>

			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<!-- /mobile controls -->

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>

			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>

			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="true">
						<i class="icon-bubbles4"></i>
						<span class="d-md-none ml-2">Messages</span>
						<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" id="message"></span>
					</a>
				</li>

				<li class="nav-item dropdown dropdown-user">

					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo getUserImage($user); ?>" class="rounded-circle" alt="<?php echo gv($user, 'first_name') ?>">
						<span><?php echo gv($user, 'first_name').' ' .gv($user, 'last_name'); ?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo ADMIN_URL; ?>/profile" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<div class="dropdown-divider"></div>
						<a href="<?php echo BASE_URL; ?>/lock.php?goto=<?php echo app_url().$_SERVER['REQUEST_URI']; ?>" class="dropdown-item" id="lock"><i class="icon-user-lock"></i> Lock User</a>
						<a href="<?php echo BASE_URL; ?>/logout.php" class="dropdown-item" id="logout"><i class="icon-switch2"></i> Logout</a>
						<a href="<?php echo BASE_URL; ?>/change-password.php?userid=<?php echo $user['id']; ?>" class="dropdown-item" id="logout"><i class="icon-key"></i> Change Password</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	<?php
	} ?>

	<!-- Page content -->
	<div class="page-content">
		<?php if (Session::get('admin')) {
			?>
		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="<?php echo ADMIN_URL; ?>/profile"><img src="<?php echo getUserImage($user); ?>" width="38" height="38" class="rounded-circle" alt="<?php echo gv($user, 'first_name'); ?>"></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold"><?php echo gv($user, 'first_name').' ' .gv($user, 'last_name'); ?></div>
								<div class="font-size-xs opacity-50">
									<i class="icon-address-book font-size-sm"></i> &nbsp;<?php echo gv($user, 'email'); ?>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<?php include 'side_bar.php'; ?>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->
		<?php
		} ?>
<input type="hidden" name="admin_id" id="admin_id" value="<?php echo($user['id']); ?>">
		<!-- Main content -->
		<div class="content-wrapper">
