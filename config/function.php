<?php
function active_page($data, $index) {
	echo isset($data['page_index']) && $data['page_index'] == $index ? ' active' : '';
}

function nav_item_open($data, $index) {
	foreach ($data as $key => $value) {
		if ($value == $index) {
			return ' nav-item-open';
			break;
		}
	}
	return false;
}

function ajax() {
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		return;
	}
	include_once dirname(__FILE__) . '/../admin/error/404.php';
	exit;
}

function check_ajax() {
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		return true;
	}
	return false;
}

function gv($params, $keys, $default = Null) {
	return (isset($params[$keys]) AND $params[$keys]) ? $params[$keys] : $default;
}

function gbv($params, $keys) {
	return (isset($params[$keys]) AND $params[$keys]) ? 1 : 0;
}

//////////////////////////////////////////////////////////////////////// Date helper function starts

/*
 *  Used to check whether date is valid or not
 *  @param
 *  $date as timestamp or date variable
 *  @return true if valid date, else if not
 */

function validateDate($date) {
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d') === $date;
}

/*
 *  Used to calculate date difference between two dates
 */

function dateDiff($date1, $date2) {
	if ($date2 > $date1) {
		return date_diff(date_create($date1), date_create($date2))->days;
	} else {
		return date_diff(date_create($date2), date_create($date1))->days;
	}
}

/*
 *  Used to get date with start midnight time
 *  @param
 *  $date as timestamp or date variable
 *  @return date with start midnight time
 */

function getStartOfDate($date) {
	return date('Y-m-d', strtotime($date)) . ' 00:00';
}

/*
 *  Used to get date with end midnight time
 *  @param
 *  $date as timestamp or date variable
 *  @return date with end midnight time
 */

function getEndOfDate($date) {
	return date('Y-m-d', strtotime($date)) . ' 23:59';
}

/*
 *  Used to get date in desired format
 *  @return date format
 */

function getDateFormat() {
	if (config('date_format') === 'DD-MM-YYYY') {
		return 'd-m-Y';
	} elseif (config('date_format') === 'MM-DD-YYYY') {
		return 'm-d-Y';
	} elseif (config('date_format') === 'DD-MMM-YYYY') {
		return 'd-M-Y';
	} elseif (config('date_format') === 'MMM-DD-YYYY') {
		return 'M-d-Y';
	} else {
		return 'd-m-Y';
	}
}

/*
 *  Used to convert date for database
 *  @param
 *  $date as date
 *  @return date
 */

function toDate($date) {
	if (!$date) {
		return;
	}

	return date('Y-m-d', strtotime($date));
}

/*
 *  Used to convert time for database
 *  @param
 *  $time as time
 *  @return time
 */

function toTime($time) {
	if (!$time) {
		return;
	}

	return date('H:i', strtotime($time));
}

/*
 *  Used to convert date in desired format
 *  @param
 *  $date as date
 *  @return date
 */

function showDate($date) {
	if (!$date) {
		return;
	}

	$date_format = getDateFormat();
	return date($date_format, strtotime($date));
}

/*
 *  Used to convert time in desired format
 *  @param
 *  $datetime as datetime
 *  @return datetime
 */

function showDateTime($time = '') {
	if (!$time) {
		return;
	}

	$date_format = getDateFormat();
	if (config('time_format') === 'H:mm') {
		return date($date_format . ',H:i', strtotime($time));
	} else {
		return date($date_format . ',h:i a', strtotime($time));
	}
}

/*
 *  Used to convert time in desired format
 *  @param
 *  $time as time
 *  @return time
 */

function showTime($time = '') {
	if (!$time) {
		return;
	}

	if (config('time_format') === 'H:mm') {
		return date('H:i', strtotime($time));
	} else {
		return date('h:i a', strtotime($time));
	}
}
//////////////////////////////////////////////////////////////////////// Date helper function ends

//////////////////////////////////////////////////////////////////////// String helper function starts

/*
 *  Used to convert slugs into human readable words
 *  @param
 *  $word as string
 *  @return string
 */

function toWord($word) {
	$word = str_replace('_', ' ', $word);
	$word = str_replace('-', ' ', $word);
	$word = ucwords($word);
	return $word;
}

/*
 *  Used to generate random string of certain lenght
 *  @param
 *  $length as numeric
 *  $type as optional param, can be token or password or username. Default is token
 *  @return random string
 */

function randomString($length, $type = 'token') {
	if ($type === 'password') {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	} elseif ($type === 'username') {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	} else {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	}
	$token = substr(str_shuffle($chars), 0, $length);
	return $token;
}

/*
 *  Used to whether string contains unicode
 *  @param
 *  $string as string
 *  @return boolean
 */

function checkUnicode($string) {
	if (strlen($string) != strlen(utf8_decode($string))) {
		return true;
	} else {
		return false;
	}
}

/*
 *  Used to generate slug from string
 *  @param
 *  $string as string
 *  @return slug
 */

function createSlug($string) {
	if (!$string) {
		return;
	}

	if (checkUnicode($string)) {
		$slug = str_replace(' ', '-', $string);
	} else {
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
	}
	return $slug;
}

/*
 *  Used to remove script tag from input
 *  @param
 *  $string as string
 *  @return slug
 */

function scriptStripper($string) {
	return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
}

function isInteger($input) {
	return (ctype_digit(strval($input)));
}

//////////////////////////////////////////////////////////////////////////////////// String helper function ends

//////////////////////////////////////////////////////////////////////////////////// Select helper function starts

/*
 *  Used to generate select option for vue.js multiselect plugin
 *  @param
 *  $data as array of key & value pair
 *  @return select options
 */

function generateSelectOption($data) {
	$options = array();
	foreach ($data as $key => $value) {
		$options[] = ['name' => $value, 'id' => $key];
	}
	return $options;
}

/*
 *  Used to round number
 *  @param
 *  $number as numeric value
 *  $decimal_place as integer for round precision
 *  @return number
 */

function formatNumber($number, $decimal_place = 2) {
	return round($number, $decimal_place);
}

////////////////////////////////////////////////////////////////////////////////////// IP helper function starts

/*
 *  Used to get IP address of visitor
 *  @return date
 */

function getRemoteIPAddress() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return array_key_exists('REMOTE_ADDR', $_SERVER) ? $_SERVER['REMOTE_ADDR'] : null;
}

/*
 *  Used to get IP address of visitor
 *  @return IP address
 */

function getClientIp() {
	$ips = getRemoteIPAddress();
	$ips = explode(',', $ips);
	return !empty($ips[0]) ? $ips[0] : '';
}

function getClientDetails() {

	//ip = Ip address
	//re = Referance
	//ag = User Agent
	//ts = Date Time

	$log = array(
		'ip' => getClientIp(),
		're' => array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : null,
		'ag' => $_SERVER['HTTP_USER_AGENT'],
		'ts' => date("Y-m-d h:i:s", time()),
	);

	return json_encode($log);
}

/*
 * get Maximum post size of server
 */

function getPostMaxSize() {
	if (is_numeric($postMaxSize = ini_get('post_max_size'))) {
		return (int) $postMaxSize;
	}

	$metric = strtoupper(substr($postMaxSize, -1));
	$postMaxSize = (int) $postMaxSize;

	switch ($metric) {
	case 'K':
		return $postMaxSize * 1024;
	case 'M':
		return $postMaxSize * 1048576;
	case 'G':
		return $postMaxSize * 1073741824;
	default:
		return $postMaxSize;
	}
}

function isConnected() {
	$connected = @fsockopen("www.google.com", 80);
	if ($connected) {
		fclose($connected);
		return true;
	}

	return false;
}

/*
 *  Used to get logo
 *  @return string
 */
function getLogo() {
	if (config('logo') && file_exists($_SERVER['DOCUMENT_ROOT'] . config('logo'))) {
		return '<img src="' . BASE_URL . '/' . config('logo') . '" alt="' . config('institute_name', 'Team TRT') . '">';
	} else {
		return '<img src="' . BASE_URL . '/global_assets/images/logo_light.png' . '" alt="' . config('institute_name', 'Team TRT') . '">';
	}
}

/*
 *  Used to get logo
 *  @return string
 */
function getSmLogo() {
	if (config('sm_logo') && file_exists($_SERVER['DOCUMENT_ROOT'] . config('sm_logo'))) {
		return '<img src="' . BASE_URL . '/' . config('sm_logo') . '" alt="' . config('institute_name', 'Team TRT') . '">';
	} else {
		return '<img src="' . BASE_URL . '/global_assets/images/logo_icon_light.png' . '" alt="' . config('institute_name', 'Team TRT') . '">';
	}
}

function numberPadding($number, $length) {
	return str_pad($number, $length, '0', STR_PAD_LEFT);
}

function createExcerpt($content, $length = 20, $more = '...') {
	$excerpt = strip_tags(trim($content));
	$words = str_word_count($excerpt, 2);
	if (count($words) > $length) {
		$words = array_slice($words, 0, $length, true);
		end($words);
		// $position = key( $words ) + strlen( current( $words ) );
		$position = key($words);
		$excerpt = substr($excerpt, 0, $position) . $more;
	}
	return $excerpt;
}

function calc($mathString) {
	$mathString = trim($mathString);
	$mathString = preg_replace('[^0-9\+-\*\/\(\) ]', '', $mathString);

	$compute = create_function("", "return (" . $mathString . ");");
	return 0 + $compute();
}

function searchByKey($data, $key, $value) {
	$index = array_search($value, array_column($data, $key));

	return ($index === FALSE) ? [] : $data[$index];
}

function config($name, $default = Null) {
	global $db;
	if (!$name) {
		return $default;
	}
	$query = "SELECT * FROM satt_settings WHERE name='$name' LIMIT 1";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
		return $row['value'];
	}
	return $default;
}

function getLoginUser($table, $id) {
	global $db;
	$query = "SELECT * FROM $table WHERE user_id='$id' LIMIT 1";
	$result = $db->select($query);
	if ($result) {
		return $result;
	}
	return false;
}

function getUserImage($user) {
	if (gv($user, 'logo') && file_exists($_SERVER['DOCUMENT_ROOT'] . gv($user, 'logo'))) {
		return BASE_URL . '/' . gv($user, 'logo');
	} else {
		return BASE_URL . '/assets/user_image.png';
	}
}



	function permission_check($permission){
		global $db;
		$role_name = Session::get("role");
		$user_serial_no = Session::get("systems_user_id");
		$user_type = Session::get("user_type");

		if ($role_name == 'admin') {
			return true;
		}

		$query = "SELECT * FROM role WHERE role_name = '$role_name'";
		$role_info = $db->select($query);
		if ($role_info) {
			$role_info = $role_info->fetch_assoc();
		}
		$role_serial_no = $role_info['serial_no'];

		$query = "SELECT * FROM user_has_role WHERE user_type = '$user_type' AND user_serial_no ='$user_serial_no' AND role_serial_no = '$role_serial_no'";
		$get_user_has_role = $db->select($query);

		
		if (!$get_user_has_role) {
			return false;
		}

		

		$query = "SELECT * FROM role_has_permission WHERE role_serial_no = '$role_serial_no'";
		$get_permission = $db->select($query);
		$permissions = [];

		if ($get_permission) {
			while ($row = $get_permission->fetch_assoc()) {
				$get_permission_serial_no =  $row['permission_serial_no'];
				$query = "SELECT * FROM permission WHERE serial_no = '$get_permission_serial_no'";
				$permissions[] = $db->select($query)->fetch_assoc()['permission_name'];
			}
		}
		if (in_array($permission, $permissions)) {
			return true;
		}

		return false;

	}

