<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/software-details', 'Software Details');
if (isset($_GET['software_details_id'])) {
	$software_details_id = $_GET['software_details_id'];
	$query = "SELECT * FROM software_details WHERE id='$software_details_id'";
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
            $query_price = "SELECT * FROM software_price WHERE software_id='$software_id'";
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

<!-- Login form -->
  <fieldset class="mb-3">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Basic Informantion </legend>
            <div class="row">
                    <b class="col-md-4">Software Name :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['software_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Software Status :</b>
                    <h6 class="col-md-8"><?php echo ucwords($row['software_status_name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Developing Languages :</b>
                    <?php 

            while ($row_lang_multi = mysqli_fetch_assoc($result_lang_multi)) {
              $lang_id = $row_lang_multi['language_id'];
              $query_lang = "select * from software_language WHERE id = '$lang_id'";
              $result_lang = $db->select($query_lang)->fetch_assoc();
              $lang_name = $result_lang['software_language_name']; ?>

                 <span class="badge badge-success mr-1"><?php echo ucfirst($lang_name); ?></span>

     <?php   } ?>
            </div>
            <div class="row pt-2 pb-2">
                    <b class="col-md-4">Developed By :</b>
                <?php 
                  while ($row_develope_by = mysqli_fetch_assoc($result_develope_by)) {
                      $developer_id = $row_develope_by['developer_id'];
                      $query_developer = "select * from developer WHERE id = '$developer_id'";
                      $result_developer = $db->select($query_developer)->fetch_assoc();
                      $developer_name = $result_developer['name']; ?>

                 <span class="badge badge-success mr-1"><?php echo ucfirst($developer_name); ?></span>

             <?php   } ?>
            </div>
            <div class="row">
                    <b class="col-md-4">Start Date :</b>
                    <h6 class="col-md-8"><?php echo $new_create_date; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">End Date :</b>
                    <h6 class="col-md-8" ><?php echo $new_end_date; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Short Features :</b>
                    <h6 class="col-md-8"><?php echo $row['short_feature']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Software Proposal and Condition :</b>
                    <h6 class="col-md-8"><?php echo $row['condition_details']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Software User Manual :</b>
                    <h6 class="col-md-8"><?php echo $row['user_manual']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Project End Time remaining  :</b>
                    <h6 class="col-md-8"><span class="mr-1" id="expired"><span class="mr-1" id="days"> </span><span class="mr-1" id="hours"> </span><span class="mr-1" id="minutes"> </span><span class="mr-1" id="seconds"> </span></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
            <hr>
            <legend class="text-uppercase text-center font-size-m font-weight-bold">Software Price Details </legend>
        <div class="col-lg-6">
            <div class="row">
                    <b class="col-md-8">Software Demo URL :</b>
                    <h6 class="col-md-4"><a target="blank" href="https://<?php echo $row_price['demo_url']; ?>"><?php echo $row_price['demo_url']; ?></a></h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Installation Charge :</b>
                    <h6 class="col-md-4"><?php echo $row_price['installation_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Monthly Cahrge :</b>
                    <h6 class="col-md-4"><?php echo $row_price['monthly_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Yearly Charge :</b>
                    <h6 class="col-md-4"><?php echo $row_price['yearly_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Direct Sell(One Time) :</b>
                    <h6 class="col-md-4"><?php echo $row_price['direct_sell']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Total Price :</b>
                    <h6 class="col-md-4"><?php echo $row_price['total_price']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Agent Commission (One Time Sell) :</b>
                    <h6 class="col-md-4"><?php echo $row_price['agent_commission_one_time']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Agent Commission (Monthly) :</b>
                    <h6 class="col-md-4"><?php echo $row_price['agent_commission_monthly']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">Maximum Discount Offer  :</b>
                    <h6 class="col-md-4"><?php echo $row_price['discount_offer']; ?> /=</h6>
            </div>
             <div class="row">
                    <b class="col-md-8">Yearly Renew Charge  :</b>
                    <h6 class="col-md-4"><?php echo $row_price['yearly_renew_charge']; ?> /=</h6>
            </div>
            

        </div>

<?php 

// software price details section

        if ($software_id) {
            $new_query_price = "SELECT * FROM software_price_log WHERE software_id='$software_id'";
            $new_result_price = $db->select($new_query_price);
                if ($new_result_price) {
                 $new_row_price = $new_result_price->fetch_assoc(); ?>


            <div class="col-lg-6">
            <div class="row">
                    <b class="col-md-8">New Installation Charge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['installation_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Monthly Cahrge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['monthly_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Yearly Charge :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['yearly_charge']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Direct Sell(One Time) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['direct_sell']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Total Price :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['total_price']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Agent Commission (One Time Sell) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['agent_commission_one_time']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Agent Commission (Monthly) :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['agent_commission_monthly']; ?> /=</h6>
            </div>
            <div class="row">
                    <b class="col-md-8">New Maximum Discount Offer  :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['discount_offer']; ?> /=</h6>
            </div>
             <div class="row">
                    <b class="col-md-8">New Yearly Renew Charge  :</b>
                    <h6 class="col-md-4"><?php echo $new_row_price['yearly_renew_charge']; ?> /=</h6>
            </div>

        </div>





         <?php   }
            } else {
                http_response_code(500);
                die(json_encode(['message' => 'Software Price Not Found']));
            }
// software price details section End


 ?>

    </div>
</fieldset>
<!-- /login form -->
<!-- Display the countdown timer in an element -->

<script>
    
   function makeTimer() {

    //      var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");  
        var endTime = new Date("<?php echo $end_date ?>");         
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400); 
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
  
            if (hours < "10") { hours = "0" + hours; }
            if (minutes < "10") { minutes = "0" + minutes; }
            if (seconds < "10") { seconds = "0" + seconds; }
                if (days < 1) {
                    var badge='badge badge-danger';
                  }else{
                    var badge='badge badge-success';

                  }
            $("#days").html('<span class="'+badge+'">'+days+' Days</span>');
            $("#hours").html('<span class="'+badge+'">'+hours+' Hours</span>');
            $("#minutes").html('<span class="'+badge+'">'+minutes+' Minutes</span>');
            $("#seconds").html('<span class="'+badge+'">'+seconds+' Seconds</span>');

      

    }    
   function makeTimer2() {

    //      var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");  
        var endTime = new Date("<?php echo $end_date ?>");         
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400); 
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
  


              // If the count down is finished, write some text 
            return days;
      

    }

var x = setInterval(function() { makeTimer(); }, 1000);


setInterval(function() { 
    var days = makeTimer2(); 
    console.log(days);
    if (days <= -1 ) {
                clearInterval(x);
                $("#expired").html('<span class="badge badge-danger">DATE EXPIRED</span>');
            }
}, 1000);

          
</script>



