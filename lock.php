<?php
require_once 'config/config.php';
$goto = '';
if (check_ajax()) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_GET['goto'])) {
			$goto = '?goto=' . urlencode($_GET['goto']);
		}
		$msg = 'User Lock Successfull';
		if (isset($_GET['type']) and $_GET['type'] == 'inactivity') {
			$msg = 'Lock Due To Inactivity Till 1200 Sec.';
		}
		if (Session::unset_data($userRole)) {
			die(json_encode(['message' => $msg, 'goto' => BASE_URL . '/lock.php' . $goto]));
		} else {
			http_response_code(405);
			die(json_encode(['errors' => 'Something Wrong. Please Try Again Later']));
		}
	}
} else {
	Session::checkLogin($userRole, 'Lock');
	if (!array_key_exists('HTTP_REFERER', $_SERVER)) {
		session_destroy();
		header('Location: ' . BASE_URL . '/login.php' . $goto);
	}
}
if (isset($_GET['goto'])) {
	$goto = urlencode($_GET['goto']);
}
$data = array();
$data['page_title'] = gv($user, 'first_name') . ' Lock';
$data['page_index'] = 'login';
$data['page_css'] = [];
$data['page_js'] = ['assets/js/lock'];
?>
<?php include_once './admin/inc/header.php';?>
<!-- /content area -->
<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

        <!-- Unlock form -->
				<form class="login-form" action="<?php echo BASE_URL; ?>/ajax/login.php" id="login_form" method="post">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center">
								<div class="card-img-actions d-inline-block mb-3 user_icon">
									<img class="rounded-circle" src="<?php echo getUserImage($user); ?>" width="160" height="160" alt="">
									<div class="card-img-actions-overlay card-img rounded-circle">

									</div>
								</div>
							</div>

							<div class="text-center mb-3">
								<h6 class="font-weight-semibold mb-0"><?php echo gv($user, 'first_name') . ' ' . gv($user, 'last_name'); ?></h6>
								<span class="d-block text-muted">Unlock your account</span>
							</div>
              <input type="hidden" name="goto" value="<?php echo $goto; ?>">
              <input type="hidden" name="from" value="lock">
              <input type="hidden" name="username_or_email" id="username_or_email" value="<?php echo $user['user_name']; ?>" data-parsley-errors-container="#username_or_email_error">

							<div class="form-group form-group-feedback form-group-feedback-right">
								<input type="password" class="form-control" placeholder="Password" name="password" id="password" autocomplete="new-password" required>
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
                <span id="username_or_email_error"></span>
							</div>

							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
                  <label class="form-check-label">
  									<input type="checkbox" class="form-check-input" name="remember">
  									Remember Me
  								</label>
								</div>

								<a href="login_password_recover.html" class="ml-auto">Forgot password?</a>
							</div>

							<button type="submit" class="btn btn-primary btn-block" id="submit"><i class="icon-unlocked mr-2 user_icon"></i> Unlock</button>
						</div>
					</div>
				</form>
				<!-- /unlock form -->
				<!-- /login form -->

			</div>
			<!-- /content area -->
<!-- /content area -->
<?php include_once './admin/inc/footer.php';?>
<script type="text/javascript">

</script>
</body>
</html>
