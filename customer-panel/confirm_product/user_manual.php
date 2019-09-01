<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('customer-panel', ADMIN_URL . '/confirm_product', 'Confirm Product');
if (isset($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	$query = "SELECT * FROM software_details WHERE id='$product_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
        $software_id = $row['id'];
        $create_date = $row['create_date'];
        $new_create_date = date("d-M-Y", strtotime($create_date));
        $end_date = $row['end_date'];
        $new_end_date = date("d-M-Y", strtotime($end_date));


        if ($software_id) {
          $query_lang_multi = "select * from software_language_multi WHERE software_id = '$software_id' ";
          $result_lang_multi = $db->select($query_lang_multi);

          $query_develope_by = "select * from software_develope_by WHERE software_id = '$software_id' ";
          $result_develope_by = $db->select($query_develope_by);
      }

 // software price details section

      if ($software_id) {
        $query_price = "SELECT * FROM software_details WHERE id ='$software_id'";
        $result_price = $db->select($query_price);
        if ($result_price) {
           $row_price = $result_price->fetch_assoc();
       }
   } else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Price Not Found']));
}
// software price details section End


} else {
    http_response_code(500);
    die(json_encode(['message' => 'Software Details Not Found']));
}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<fieldset class="mb-3">
    <div class="row">
        <b class="col-md-4">Software User Manual :</b>
        <h6 class="col-md-8"><?php echo $row['user_manual']; ?>. <a target="_blank" href="<?php echo $row['user_manual_link']; ?>"> See More</a></h6>
    </div>
    <div class="row">
        <b class="col-md-4">Software User Manual video :</b>
        <h6 class="col-md-8"><a target="_blank" href="<?php echo $row['feature_video']; ?>"> See video</a></h6>
    </div>
    <br ><br />
    <div class="form-group row">
        <div class="col-lg-3 offset-lg-4">
            <button type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>

<!-- /login form -->
