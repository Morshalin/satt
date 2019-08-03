<?php
require_once 'config/config.php';
Session::checkLogin($userRole, 'Login');
$goto = urlencode('default');
if (isset($_GET['goto'])) {
	$goto = urlencode($_GET['goto']);
}
$data = array();
$data['page_title'] = 'Login';
$data['page_index'] = 'login';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/login'];
?>
<?php include_once './admin/inc/header.php';?>
<!-- /content area -->
<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form" action="<?php echo BASE_URL; ?>/ajax/login.php" id="login_form" method="post">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1 user_icon"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                <input type="hidden" name="goto" value="<?php echo $goto; ?>">
                <input type="hidden" name="from" value="login">
								<input type="text" class="form-control" placeholder="Username Or Email" name="username_or_email" id="username_or_email" autofocus autocomplete="username_or_email" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" id="password" autocomplete="new-password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

              <div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" name="remember">
									Remember Me
								</label>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block" id="submit">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div>
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->
<!-- /content area -->
<?php include_once './admin/inc/footer.php';?>
<script type="text/javascript">

</script>
</body>
</html>
