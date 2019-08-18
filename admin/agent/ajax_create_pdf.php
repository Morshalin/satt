<?php
require_once '../../config/config.php';
		// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
// require_once 'dompdf/src/Dompdf.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 

		$dompdf = new Dompdf();


ajax();
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	if ($agent_id) {
		$query = "SELECT * FROM agent_list WHERE id = '$agent_id'";
		$result = $db->select($query)->fetch_assoc();
		if (!$result) {
			http_response_code(500);
			die(json_encode(['message' => 'Agent Not Found']));
		}

		$house = $result['present_house'];
		$road = $result['present_road'];
		$name = $result['name'];
		$village = $result['present_village'];
		$upazila = $result['present_up'];
		$district = $result['present_dist'];
		$postal_code = $result['present_post_code'];
		$date = date('F Y h');

		$html = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Confirmation  Letter</title>
        <!--     css    -->
        <!--font-fontawesome-->
        <style>
        .page {
        width: 28.7cm;
        min-height: 29cm;
        padding-left: 2cm;
        padding-top: 0cm;
        padding-right: 2cm;
        font-size: 25px;
        }
        @page {
        size: A4 portrait;
        margin: 0cm;
        margin-top: 2cm;
        margin-right: 2cm;
         margin-bottom: 2cm;
        }
          .backgroundimage {
        position: relative;
        top: 250px;
        } 
        .para1 {
        position: relative;
        top: 210px;
        padding-left: 75px !important;
        margin-top: -170px
        }
        .para {
        position: relative;
        top: 200px;
        margin-top: -230px;
        padding-left: 60px !important;
        }
        </style>
    </head>
    <body style="background-image: url(';
    $html .= 'images/Letterhead-90.png';
    $html .='); background-size: cover; background-repeat: no-repeat; background-position: top; ">
        <div>
            <table width="100%"  style="margin-top: 150px; margin-left: 45px; margin-right: 15px;">
                <tr>
                    <td style="font-size: 17px; font-weight: bold;" colspan="2">';
    $html .= $date;
    $html .= '</td>
                </tr>
                <tr>
                    <td style="font-size: 20px;font-family: verdana;text-transform: uppercase;" colspan="2">
                        <h4>
                        '.$name.'
                        </h4>
                        <P>';

     if ($house) {
     	$html .= $house.', ';
     }
     if ($road) {
     	$html .= $road.', ';
     }
	$html .= $village.', <br>';
	$html .= $upazila.', ';
	$html .= $district.'-';
	$html .= $postal_code;

    $html .='</P>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:bold; font-size:22px;" colspan="2">
                        Sub: Letter of Agent Confrimation.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        Dear Sir,
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: justify;">
                        We have received your application and would like to confirm that, you have been selected as the agent of our IT company. Now your agent position is in the basic label. We are offering you for selling our software and services. As we promised, you will get the commission and other facilities as per sell.
                        <br>
                        <br>
                        The appointment is with effect from ';
    $html .=$date;
    $html .=' to December 31, 2019. After that, shall assist the performance and increase the time period further. The next confirmation latter shall be renewed by the company. Please be prepared to take your responsibility and work on it.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: justify;">
                        <br>
                        <br>
                        Your Sincerely, <br>
                        <img src="';
    $html .= 'images/vai-sign.png';
    $html .='" width="110" alt="" style="margin-top: 5px;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify;">
                        <span style="font-weight: bold; font-size:25px;">MD ABDUS SAMAD</span> <br>
                        <span style="font-size: 23px;font-family: verdana;">Chairman <br>
                            <span style="font-weight:bold; "> SATT IT</span> </span>
                        </td>
                        <td>
                            <img src="';
    $html .= 'images/Sill.png';
    $html .= '" width="150" style="margin-top: -10px"
                            alt="">
                        </td>
                    </tr>
                </table>
            </div>

            </body>
        </html>';

		// $dompdf->loadHtml($html);
		
		// $dompdf->render();
        $dompdf->setPaper('A4','portrait');
		
$dompdf->load_html($html);
$dompdf->render();
$pdf_name = 'appiontment_letters/'.$name.'_'.$result['id'].".pdf";
$file_location = $_SERVER['DOCUMENT_ROOT']."/satt/admin/agent/".$pdf_name;

if (file_put_contents($file_location, $dompdf->output())) {
    $query = "UPDATE agent_list set confirmation_letter = '$pdf_name' WHERE id = '$agent_id'";
    $set_confirmation_letter = $db->update($query);
}

		
	}
}


?>