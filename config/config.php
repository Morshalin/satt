<?php
//Default Settings
date_default_timezone_set('Asia/Dhaka');

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

//Default Function

function check_https() {
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
		return 'https';
	}
	return 'http';
}

function app_url() {
	return check_https() . '://' . $_SERVER['HTTP_HOST'];
}

//Declaring Constant

//Local Config

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "satt");

define('BASE_URL', app_url() . '/satt');
define('ADMIN_URL', BASE_URL . '/admin');
define('AGENT_URL', BASE_URL . '/agent-panel');
define('CUSTOMER_URL', BASE_URL . '/customer-panel');
define('TITLE', 'Satt');
define('FOOTER', 'Satt');
define('TITLE_DIVIDER', ' | ');

//include Default_file
include_once dirname(__FILE__) . '/../classes/Session.php';
Session::init();
include_once dirname(__FILE__) . '/../classes/Database.php';
include_once dirname(__FILE__) . '/../classes/Format.php';
//Create Object
$db = new Database();
$fm = new Format();
include_once 'function.php';

$user = [];
$userRole = Session::get('userRole') ? Session::get('userRole') : 'student';
$user = Session::get('userData') ? Session::get('userData') : $user;

