<?php
  require_once '../config/config.php';
  Session::checkSession('customer-panel', ADMIN_URL);
  $goto = '';
  if (isset($_GET['goto'])) {
    $goto =  '?goto='.urlencode($_GET['goto']);
  }
  if (isset($_GET['action']) AND $_GET['action'] == 'logout') {
    Session::destroy('admin', $goto);
  }
  if (isset($_GET['action']) AND $_GET['action'] == 'lock') {
    Session::destroy('admin', BASE_URL.'/lock.php?goto='.$goto);
  }
  $data = array();
  $data['page_title'] = 'Admin Dashboard';
  $data['page_index'] = 'dashboard';
  $data['page_css'] = [];
  $data['page_js'] = [];
?>
<?php include_once 'inc/header.php'; ?>
<!-- /content area -->
<div class="content">
  hello google mama
</div>
<!-- /content area -->
<?php include_once 'inc/footer.php'; ?>
</body>
</html>
