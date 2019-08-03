<?php
	/**
	*Session Class
	**/
	class Session{
		public static function init(){
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if (session_id() == '') {
					session_start();
				}
			} else {
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
		}
        }

		public static function set($key, $val){
			$_SESSION[$key] = $val;
		}

		public static function get($key){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			} else {
				return false;
			}
		}

		public static function checkSession($middleware='admin', $goto= null, $page  = 'Dashboard'){
			self::init();
			if (self::get($middleware) == false) {
				self::destroy($middleware, $goto, $page, true);
			}
		}


		 public static function checkLogin($middleware = 'admin', $page = 'Login'){
			self::init();
			if (self::get($middleware) == true) {
					self::set('login_error', 'You can not access '.$page.' while logged in.');
					header('Location: '.BASE_URL.'/'.self::get('userRole'));
					die();
				}
		}

		 public static function destroy($middleware='admin', $goto= Null, $page = 'Dashboard', $self = null){
				 if (!$goto) {
				 	$goto = BASE_URL .'/login.php';
				 }
				 if ($self) {
				 	self::set('login_error', 'You need log in to access '.$page.' page.');
					$goto = BASE_URL.'/login.php?goto='.urlencode($goto);
				} else{
					self::set('login_message', 'You are Successfully logged out.');
				}
				 self::unset_data($middleware);
				 header('Location: '.$goto);
				 die();
		}

		public static function unset_data($middleware='admin'){
				Session::set('login', Null);
				Session::set($middleware, Null);
				Session::set('userRole', Null);
				Session::set($middleware.'Id', Null);
				return true;
			}
	}
?>
