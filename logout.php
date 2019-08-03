<?php
require_once 'config/config.php';
ajax();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_GET['goto'])) {
    $goto =  urlencode($_GET['goto']);
  }
  if (Session::unset_data($userRole)) {
    session_destroy();
    Session::set('login_message', 'You are Successfully logged out.');
    die(json_encode(['message' => 'Logout Success full', 'goto' => isset($goto) ? $goto : BASE_URL.'/login.php' ]));

  } else {
    http_response_code(405);
    die(json_encode(['errors' => 'Something Wrong. Please Try Again Later']));
  }
}
