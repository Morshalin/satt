<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/office_stuff', 'Office Stuff');
if (isset($_GET['office_stuff_id'])) {
	$office_stuff_id = $_GET['office_stuff_id'];
	if ($office_stuff_id) {
		$query = "SELECT * FROM office_stuff WHERE id = '$office_stuff_id'";
		$result = $db->select($query);
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Office Stuff Not Found']));
		}else{
			$result = $result->fetch_assoc();
		}
	}
}
/*================================================================
	Update data into database
===================================================================*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_GET['action']) AND $_GET['action'] == 'update') {
	$office_stuff_id = $_GET['office_stuff_id'];
	if ($office_stuff_id) {
	if ($result) {
	$img = $result['image'];
	$stuff_id_no = $result['stuff_id'];
	// die($stuff_id_no);
	}

	$error = array();
	$stuff_id = $fm->validation($_POST['stuff_id']);
	$name = $fm->validation($_POST['name']);
	$designation = $fm->validation($_POST['designation']);
	$joining_date = $fm->validation($_POST['joining_date']);
	$skill = $fm->validation($_POST['skill']);
	$projects = $fm->validation($_POST['projects']);
	$blood_group = $fm->validation($_POST['blood_group']);
	$bio = $fm->validation($_POST['bio']);

	$image = $_FILES['image'];
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_temp = $image['tmp_name'];
    $div = explode(".", $file_name);
    $file_extension = strtolower(end($div));
    $unique_image = md5(time()); 
    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
	$uploaded_image = './image/'.$unique_image;

	// die($file_temp);
	
	$present_address = $fm->validation($_POST['present_address']);
	$permanent_address = $fm->validation($_POST['permanent_address']);
	$mobile_no_personal = $fm->validation($_POST['mobile_no_personal']);
	$mobile_no_alternative = $fm->validation($_POST['mobile_no_alternative']);
	$email = $fm->validation($_POST['email']);
	$facebook = $fm->validation($_POST['facebook']);
	$twitter = $fm->validation($_POST['twitter']);
	$linkedin = $fm->validation($_POST['linkedin']);
	$instagram = $fm->validation($_POST['instagram']);
	$email = $fm->validation($_POST['email']);


	$query = "SELECT * FROM office_stuff WHERE stuff_id != '$stuff_id_no'";
	$stuff_id_check = $db->select($query);
	$exist = false;
	if ($stuff_id_check) {
		while ($row = $stuff_id_check->fetch_assoc()) {
			$stuff_id_no1 = $row['stuff_id'];
			if ($stuff_id_no1 == $stuff_id_no) {
				$exist = true;
				break;
			}
		}
	}


	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$stuff_id) {
		$error['stuff_id'] = 'Stuff ID required';
	}elseif ($exist) {
		$error['stuff_id'] = 'Stuff ID Already Exist';
	}
	
	if (!$name) {
		$error['name'] = 'Name Field required';
	}
	if (!$designation) {
		$error['designation'] = 'Designation Field required';
	}
	if (!$joining_date) {
		$error['joining_date'] = 'Joining Date Field required';
	}
	if (!$skill) {
		$error['skill'] = 'Skill Field required';
	}
	if (!$projects) {
		$error['projects'] = 'Projects Field required';
	}
	if (!$blood_group) {
		$error['blood_group'] = 'Blood Group Field required';
	}
	if (!$blood_group) {
		$error['blood_group'] = 'Blood Group Field required';
	}
	
	if (!$present_address) {
		$error['present_address'] = 'Present Address Field required';
	}
	if (!$mobile_no_personal) {
		$error['mobile_no_personal'] = 'Mobile No (Personal)  Field required';
	}
	if (!$mobile_no_alternative) {
		$error['mobile_no_alternative'] = 'Alternative Mobile No (Home)  Field required';
	}
	if (!$facebook) {
		$error['facebook'] = 'Facebook Link Field required';
	}

	if (!$email) {
		$error['email'] = 'Email Field required';
	} 


		if ($error) {
			http_response_code(500);
			die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
		} else {
			$query = "UPDATE office_stuff SET 
				stuff_id = '$stuff_id',
				name = '$name',
				designation = '$designation',
				joining_date = '$joining_date',
				skill = '$skill',
				blood_group = '$blood_group',
				bio = '$bio',
				projects = '$projects',
				present_address = '$present_address',
				permanent_address = '$permanent_address',
				mobile_no_personal = '$mobile_no_personal',
				mobile_no_alternative = '$mobile_no_alternative',
				facebook = '$facebook',
				twitter = '$twitter',
				linked_in = '$linkedin',
				instagram = '$instagram',
				email = '$email',
				status = '$status'
				WHERE id='$office_stuff_id'";





			$result = $db->update($query);
			$update = "";

			if ($result) {
				if ($file_name) {
					if ($img) {
						unlink($img);
					}
					if (move_uploaded_file($file_temp, $uploaded_image)) {
						$query = "UPDATE office_stuff SET image = '$uploaded_image' where id = '$office_stuff_id'";
						$update = $db->update($query);
					}
				}else{
					die(json_encode(['message' => 'Office Stuff Updated Successfully.']));
				}
				
				if ($update) {
					die(json_encode(['message' => 'Information Updated Successfully And Image Also Uploaded.']));
				}else{
					http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Image Upload Failed.']));
				}
			}else{
				http_response_code(500);
					die(json_encode(['errors' => $error, 'message' => 'Sorry Information Not Updated']));
			}
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}
/*================================================================
		Insert Data into Database
===================================================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$error = array();
	$stuff_id = $fm->validation($_POST['stuff_id']);
	$name = $fm->validation($_POST['name']);
	$designation = $fm->validation($_POST['designation']);
	$joining_date = $fm->validation($_POST['joining_date']);
	$skill = $fm->validation($_POST['skill']);
	$projects = $fm->validation($_POST['projects']);
	$blood_group = $fm->validation($_POST['blood_group']);
	$bio = $fm->validation($_POST['bio']);

	$image = $_FILES['image'];
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_temp = $image['tmp_name'];
    $div = explode(".", $file_name);
    $file_extension = strtolower(end($div));
    $unique_image = md5(time()); 
    $unique_image= substr($unique_image, 0,10).'.'.$file_extension;
	$uploaded_image = './image/'.$unique_image;

	// die($file_temp);
	
	$present_address = $fm->validation($_POST['present_address']);
	$permanent_address = $fm->validation($_POST['permanent_address']);
	$mobile_no_personal = $fm->validation($_POST['mobile_no_personal']);
	$mobile_no_alternative = $fm->validation($_POST['mobile_no_alternative']);
	$email = $fm->validation($_POST['email']);
	$facebook = $fm->validation($_POST['facebook']);
	$twitter = $fm->validation($_POST['twitter']);
	$linkedin = $fm->validation($_POST['linkedin']);
	$instagram = $fm->validation($_POST['instagram']);
	$email = $fm->validation($_POST['email']);


	$stuff_id_check = $fm->dublicateCheck('office_stuff', 'stuff_id', $stuff_id);

	if (isset($_POST['status'])) {
		$status = 1;
	} else {
		$status = 0;
	}

	if (!$stuff_id) {
		$error['stuff_id'] = 'Stuff ID required';
	}elseif ($stuff_id_check) {
		$error['stuff_id'] = 'Stuff ID Already Exist';
	}
	
	if (!$name) {
		$error['name'] = 'Name Field required';
	}
	if (!$designation) {
		$error['designation'] = 'Designation Field required';
	}
	if (!$joining_date) {
		$error['joining_date'] = 'Joining Date Field required';
	}
	if (!$skill) {
		$error['skill'] = 'Skill Field required';
	}
	if (!$projects) {
		$error['projects'] = 'Projects Field required';
	}
	if (!$blood_group) {
		$error['blood_group'] = 'Blood Group Field required';
	}
	if (!$blood_group) {
		$error['blood_group'] = 'Blood Group Field required';
	}
	if (!$file_name) {
		$error['image'] = 'Image Field required';
	}
	if (!$present_address) {
		$error['present_address'] = 'Present Address Field required';
	}
	if (!$mobile_no_personal) {
		$error['mobile_no_personal'] = 'Mobile No (Personal)  Field required';
	}
	if (!$mobile_no_alternative) {
		$error['mobile_no_alternative'] = 'Alternative Mobile No (Home)  Field required';
	}
	if (!$facebook) {
		$error['facebook'] = 'Facebook Link Field required';
	}

	if (!$email) {
		$error['email'] = 'Email Field required';
	} 



	if ($error) {
		http_response_code(500);
		die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
	} else {
		
		if (move_uploaded_file($file_temp, $uploaded_image)) {
			$query = "INSERT INTO office_stuff 
			(stuff_id,name,designation,joining_date,skill,blood_group,bio,projects,image,present_address,permanent_address,mobile_no_personal,mobile_no_alternative,facebook,twitter,linked_in,instagram,email,status)
			VALUES 
			('$stuff_id','$name','$designation','$joining_date','$skill','$blood_group','$bio','$projects','$uploaded_image','$present_address','$permanent_address','$mobile_no_personal','$mobile_no_alternative','$facebook','$twitter','$linkedin','$instagram','$email','$status')";
			$result = $db->insert($query);
			if ($result != false) {
				die(json_encode(['message' => 'Office Stuff Added Successfully']));
			} else {
				http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Something Happend Wrong. Please Check Your Form']));
			}
		}else{
			http_response_code(500);
				die(json_encode(['errors' => $error, 'message' => 'Image Upload Failed And Information Not Saved']));
		}

	
	}
}

/*================================================================
		Delate  Data from Database
===================================================================*/
// $error['software_language_name'] = 'Course Name Required';
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' AND isset($_GET['action']) AND $_GET['action'] == 'delete') {
	$office_stuff_id = $_GET['office_stuff_id'];
	if ($office_stuff_id) {
		$query = "DELETE FROM office_stuff WHERE id = '$office_stuff_id'";
		if (unlink($result['image'])) {
			$result = $db->delete($query);
			if ($result) {
				die(json_encode(['message' => 'Office Stuff Deleted Successfully']));
			}else{
				http_response_code(500);
				die(json_encode(['message' => 'Image Deleted. But Info Not Deleted']));
			}
		}else{
			http_response_code(500);
			die(json_encode(['message' => 'Image Unlink Failed. And Info Not Deleted']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT' AND isset($_GET['action']) AND $_GET['action'] == 'status') {
	$office_stuff_id = $_GET['office_stuff_id'];
	$status = $_GET['status'];
	$status = $status ? 0 : 1;

	if ($office_stuff_id) {
		$query = "UPDATE office_stuff SET status = '$status' WHERE id = '$office_stuff_id'";
		$result = $db->delete($query);
		if ($result) {
			die(json_encode(['message' => 'Office Stuff Status Changed Successfull']));
		}
	}
	http_response_code(500);
	die(json_encode(['message' => 'Something Happend Wrong. Please Try Again Later']));

}
