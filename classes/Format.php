<?php
// include_once '../classes/Database.php';
/**
 * Format Class
 */
class Format {

	private $db;

	//__construct
	public function __construct() {
		$this->db = new Database();
	} //construct

	//formatDate
	public function formatDate($date) {
		return date('F j, Y', strtotime($date));
	} //formatDate

	//textShorten
	public function textShorten($text, $limit = 400) {
		$text = $text . " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text . "...";
		return $text;
	} //textShorten

	//validation
	public function validation($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($this->db->link, $data);
		return $data;
	} //end of validation

	//validationDetaiis
	public function validationDetaiis($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = mysqli_real_escape_string($this->db->link, $data);
		return $data;
	} //end of validation

	//dublicateCheck
	public function dublicateCheck($table, $column, $value) {
		$query = "SELECT * FROM $table WHERE $column = '$value'";
		$result = $this->db->select($query);
		if ($result) {
			if ($result->num_rows > 0) {
				return $result;
			} else {
				return false;
			}
		}
	} //dublicateCheck

	//emailcheak
	public function emailcheak($table, $email) {
		$query = "SELECT * FROM $table WHERE email = '$email'";
		$result = $this->db->select($query);
		if ($result) {
			if ($result->num_rows > 0) {
				return true;
			} else {
				return false;
			}
		}
	} //emailcheak

	//emailcheak
	public function userCheck($table, $username) {
		$query = "SELECT * FROM $table WHERE username = '$username'";
		$result = $this->db->select($query);
		if ($result) {
			if ($result->num_rows > 0) {
				return true;
			} else {
				return false;
			}
		}
	} //emailcheak

	//emailcheak
	public function userOrEmailCheck($table, $username_or_email) {
		$query = "SELECT * FROM $table WHERE user_name = '$username_or_email'";
		$result = $this->db->select($query);
		if ($result) {
			return true;
		} else {
			$query = "SELECT * FROM $table WHERE email = '$username_or_email'";
			$result = $this->db->select($query);
			if ($result) {
				return true;
			} else {
				return false;
			}
		}
	} //emailcheak

	//emailcheak
	public function user($table, $username_or_email, $password) {
		$query = "SELECT * FROM $table WHERE password = '$password' AND user_name = '$username_or_email' OR password = '$password' AND email = '$username_or_email'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		} else {
			$query = "SELECT * FROM $table WHERE user_name = '$username_or_email' AND  password = '$password'";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			} else {
				return false;
			}
		}
	} //emailcheak

}
?>
