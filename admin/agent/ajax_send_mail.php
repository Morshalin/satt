<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

require_once '../../config/config.php';

// ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'Agent');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$result = $db->select($query)->fetch_assoc();
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}


       $mail->SMTPDebug = false;    
           $mail->IsSMTP();        //Sets Mailer to send message using SMTP
             $mail->Host = 'smtp.mailtrap.io';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
             $mail->Port = 587;        //Sets the default SMTP server port
             $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
             $mail->Username = 'b5575dfcc215e2';     //Sets SMTP username
             $mail->Password = 'f9e4f9e57a5040';     //Sets SMTP password
             $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
             $mail->From = 'sattitbd@gmail.com';     //Sets the From email address for the message
             $mail->FromName = 'Sohag';    //Sets the From name of the message
             $mail->AddAddress('web-tutorial@programmer.net', 'Webslesson');  //Adds a "To" address
             $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
             $mail->IsHTML(true);       //Sets message type to HTML
             $mail->AddAttachment($result['confirmation_letter']);     //Adds an attachment from a path on the filesystem
             $mail->AddAttachment('appiontment_letters/software_price_list.pdf');     //Adds an attachment from a path on the filesystem
             $mail->Subject = 'Agent Confirmation Letter From SATT IT';    //Sets the Subject of the message
             $mail->Body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        *{margin:0;outline: 0;

        }

        body {
            width: 80%; height: auto; margin:0 auto;padding: 20px;
        }
        h3{margin-bottom: 15px;margin-top: 15px;}
        ul{margin-bottom: 15px;margin-top: 15px;}
        li{margin-bottom: 1px;margin-top: 1px;}
        a{text-decoration: none;}

    </style>
</head>
<body>

    <p> অভিনন্দন। আপনি স্যাট আইটির  এজেন্ট হিসেবে নির্বাচিত হয়েছেন।</p>


    <h3>শর্তাবলী সমূহঃ</h3>

<ul style="list-style: none;">
<li>♥ সফটওয়্যার গুলোর মূল্য কোম্পানি থেকে নির্ধারিত থাকবে । কোনো ভাবেই সফটওয়্যার এর মূল্য বৃদ্ধি করা যাবে না। </li>

<li>♥ প্রত্যেক এজেন্ট বিক্রয়কৃত সকল সফটওয়্যারের আলাদা আলাদা ২৫% কমিশন পাবে। </li>

<li>♥ এজেন্ট চাইলে আমাদের অন্যান্য সেবা সমূহ বিক্রয় করে কমিশন নিতে পারবে। সেবাসমূহ দেখতে এখানে ক্লিক করুন। </li>

<li>♥ সফটওয়্যার বিক্রিত পুর্ন অর্থ (মাসিক, বাৎসরিক কিংবা এককালীন) নির্দিষ্ট মেথডে স্যাট আইটি-কে পরিশোধ করতে হবে। </li>

<li>♥ কোম্পানির সকল নিয়ম বিনাশর্তে মেনে চলতে হবে।</li>

<li>♥ কোম্পানির নীতিমালা বহির্ভূত কোন কাজ করলে এজেন্টশীপ বাতিল বলে গণ্য হবে।</li>

<li>♥ আপনি স্ব-ইচ্ছায় চুক্তিপত্র বাতিল করতে চাইলে ১ মাস পূর্বে নোটিশ প্রদান করতে হবে।</li>

<li>♥ চুক্তির নীতিমালা ও শর্তাবলী যেকোন সময় সংশোধন, সংযোজন করার এখতিয়ার কোম্পানি সংরক্ষণ করে। </li>

<li>♥ কোম্পানির স্বার্থে যেকোন পরিবর্তিত নীতিমালার ব্যাপারে এজেন্টকে ইতিবাচক মনোভাব পোষণ করতে হবে। </li>
</ul>



<p>স্যাট আইটির সেবা সমূহের মধ্যে সফটওয়্যার সেবা আন্যতম। আমাদের আরো সেবা রয়েছে।</p>


   <hr style="width: 56%;">

<h3>সেবাসমূহ এক নজরেঃ</h3>
<ul style="list-style: none;">

     <li><a href="https://satthost.com/">► ডোমেইন এবং হোস্টিং*</a></li>

     <li><a href="https://sattit.com/details-Graphics.html">► গ্রাফিক্স ডিজাইন</a></li>

     <li><a href="https://sattit.com/Detailswebdesign.html">►  যে কোন ধরনের ওয়েবসাইট তৈরি</a></li>

     <li><a href="https://sattit.com/products-details.html">►  যে কোন ধরনের সফটওয়্যার</a></li>

     <li><a href="https://sattit.com/web-design/ECommerce-1/">► অনলাইন শপ (ই-কমার্স)</a></li>
    </ul>

 আমাদের যে কোন সেবা প্রোমোট করার মাধ্যমে কমিশন ভোগ করতে পারবেন।

   <hr style="width: 50%;">

<h3>অতিরিক্ত বিক্রয়ের সুবিধাঃ</h3>

<ul style="list-style: none;">
 <li>একটি সফটওয়্যার বিক্রি করার পর কোম্পানী থেকে এজেন্ট আইডি কার্ড  লিফলেট এবং কোম্পানি ভিজিটিং কার্ড প্রদান করা হবে</li>

<li>দুইটি সফটওয়্যার বিক্রি করার পর এজেন্ট কে কোম্পানী থেকে টি-শার্ট এবং নিজস্ব ভিজিটিং কার্ড প্রদান করা হবে</li>


 <li>প্রতি মাসে পাঁচটি সফটওয়্যার বিক্রয় করলে কমিশন ৩০% হবে।</li>

 <li>মাসিক/ বাৎসরিক কিস্তিতে বিক্রিত সফটওয়্যার গুলোর ক্ষেত্রে এজেন্ট সমস্ত বিষয় তদারকি করবে ইত্যাদি।

    </ul>

       <hr style="width: 70%;">

    <h3>সফটওয়্যারসমূহঃ (ডেমো দেখতে লিংকে ক্লিক করুন)  </h3>
<div style="width:70%;">
<ul style="list-style: none;">

<li><a href="https://school.sattit.com/"> ♦ স্কুল ম্যানেজমেন্ট সফটওয়্যার</a></li>

<li><a href="https://school.sattit.com/"> ♦ কলেজ ম্যানেজমেন্ট সফটওয়্যার</a></li>

<li><a href="https://school.sattit.com/"> ♦ বিশ্ববিদ্যালয় ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://school.sattit.com/"> ♦ কোচিং ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="http://sattit.com/web-apps/sells-erp/admin"> ♦ ই.আর.পি ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="http://sattit.com/web-apps/sells-erp/admin"> ♦ শপ ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="http://sattit.com/web-apps/sells-erp/admin"> ♦ ই-কমার্স ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/feed/"> ♦ পোল্ট্রী ফীড ম্যানেজমেন্ট সফটওয়্যার</a></li>
<li><a href="https://sattit.com/web-apps/pharmecy/"> ♦ ফার্মেসী ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="http://sattit.com/web-apps/loan"> ♦ ক্ষুদ্রঋণ ও সমবায় ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/hospital-management/backend/index.php"> ♦ হসপিটাল ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/hospital-management/backend/index.php"> ♦ ডক্টর ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/restaurant-v2"> ♦ রেস্টুরেন্ট ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/stock-manegment/index.php"> ♦ স্টক ম্যানেজমেন্ট সফটওয়্যার</a></li>

<li><a href="http://sattit.com/web-apps/household/login.php"> ♦ হাউস রেন্ট ম্যানেজমেন্ট সফটওয়্যার</a></li>

<li> <a href="http://sattit.com/web-apps/dealer"> ♦ ডিলার ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="http://sattit.com/web-apps/cable-management/"> ♦ ক্যাবল টিভি/ডিশলাইন ম্যানেজমেন্ট সফটওয়্যার</a></li>

 <li><a href="https://sattit.com/web-apps/news/admin/login.php"> ♦ নিউজপোর্টাল ম্যানেজমেন্ট সফটওয়্যার</a></li>
 </ul>
 </div>
 
 <p>এজেন্টশীপ কনফার্ম হওয়ার পর কি করবেন জানতে ভিডিওটি  দেখুন</p>

ভিডিও লংকঃ <a href="https://youtu.be/kRxnjeJOYo8?list=PLSLTIb1pBFcc8VIaS_vI3tJFSl_aUy0MD">https://youtu.be/kRxnjeJOYo8?list=PLSLTIb1pBFcc8VIaS_vI3tJFSl_aUy0MD</a>



<p style="margin-top:50px;">ইউটিউবে আমাদের সফটওয়্যারগুলোর ভিডিও দেখুন... <br> <br><a style="padding:10px;background: green;color: white;border: 1px solid;" href="https://www.youtube.com/channel/UC02AhNHwgb5C3FGvzo9U0Wg" target="_blank"> ক্লিক করুন  </a> </p>

   <hr style="width: 30%;margin: 20px;">

    <p> অন্যান্য তথ্যের জন্য বিস্তারিত জানতে সার্বক্ষণিক যোগাযোগ করতে পারবেন নিম্নোক্ত </p>

<p> মোবাইল নম্বরে 01850054500, 01317339225 </p>

<p> Email : sattitbd@gmail.com </p>



<img style="margin-bottom: 5px;margin-top: 10px;width:150px;height: auto;" src="https://sattit.com/img/Logo2.png" alt="satt-logo">
<p style="margin-top: 15px">Kind Regards,<br><br>



524, Manik Mia Road (Near Varendra University),<br>
Talaimari, Rajshahi 6204<br>
Mobile: 01850054500 , 01317339225<br>
Email: info@sattit.com , sattitbd@gmail.com <br>
 </p>
    <br>

<a style="padding: 5px;background:green;color: white;border:1px solid;margin-top:20px;" href="https://sattit.com" target="_blank">Visit Our Website</a>

</body>
</html>';       
//An HTML or plain text message body
             if($mail->Send())        //Send an Email. Return true on success or false on error
             {
                $no_of_mail = (int)$result['send_mail'] + 1;
                $query = "UPDATE agent_list set send_mail = '$no_of_mail'";
                $update_mail = $db->update($query);
                if ($update_mail) {
                    $message = 'Mail Sent Successfully';
                    
                    die(json_encode(['message' => $message]));
                }
             
             }
             else
             {
              $message = '<div class="alert alert-danger">There is an Error</div>';
             }
            }


}

?>