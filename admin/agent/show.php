<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/agent', 'View Agent Info');
if (isset($_GET['agent_id'])) {
	$agent_id = $_GET['agent_id'];
	$query = "SELECT * FROM agent_list WHERE id='$agent_id'";
	$result = $db->select($query);
	if ($result) {
		$row = $result->fetch_assoc();
	} else {
		http_response_code(500);
		die(json_encode(['message' => 'agent Not Found']));
	}

} else {
	http_response_code(500);
	die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
  <fieldset class="mb-3">
    <div class="row">
                <div class="col-md-12">
                    <h3>Status</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td class="text-center">
                                Registered
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
                        <div class="row">
                <div class="col-md-6">
                    <h3>Photo</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td class="text-center">
                               <a href="https://agent.sattit.com/storage/Photos/August2019/md-hasibul-2019-08-06-5d4907c0c1f18.jpg" target="_blank"> <img src="https://agent.sattit.com/storage/Photos/August2019/md-hasibul-2019-08-06-5d4907c0c1f18.jpg" alt="" height="300px" width="300px"></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Agent Data</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>
                                <strong>Name:</strong> MD. Hasibul
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Father Name:</strong> MD. Naim Uddin
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Mother Name:</strong> Hasna Hena
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Occupation:</strong> Student
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Eduactional qualification:</strong> HSC
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Interested Dist:</strong> Faridpur
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Interested Up:</strong> Nagarkanda
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Permanent Address</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Road: </td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>House: </td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>Village: </td>
                            <td>Shankarpasha</td>
                        </tr>
                        <tr>
                            <td>Post: </td>
                            <td>Talma</td>
                        </tr>
                        <tr>
                            <td>Up: </td>
                            <td>Nagarkanda</td>
                        </tr>
                        <tr>
                            <td>District: </td>
                            <td>Faridpur</td>
                        </tr>
                        <tr>
                            <td>Post Code: </td>
                            <td>7841</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Present Address <small>Same As Present</small></h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Road: </td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>House: </td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>Village: </td>
                            <td>Shankarpasha</td>
                        </tr>
                        <tr>
                            <td>Post: </td>
                            <td>Talma</td>
                        </tr>
                        <tr>
                            <td>Up: </td>
                            <td>Nagarkanda</td>
                        </tr>
                        <tr>
                            <td>District: </td>
                            <td>Faridpur</td>
                        </tr>
                        <tr>
                            <td>Post Code: </td>
                            <td>7841</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Contact Info</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Mobile: </td>
                            <td>01736003767</td>
                        </tr>
                        <tr>
                            <td>Alternate Mobile: </td>
                            <td>01736003767</td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td>ahsanhasib1@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Signature: </td>
                            <td>Hasibul</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Birth_Certificate</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td>Document: </td>
                            <td> <a href="https://agent.sattit.com/storage/Birth_Certificate/August2019/md-hasibul-2019-08-06-5d4907c0c6e77.jpg" target="_blank"><img src="https://agent.sattit.com/storage/Birth_Certificate/August2019/md-hasibul-2019-08-06-5d4907c0c6e77.jpg" alt="" width="300px"></a></td>
                        </tr>
                                            </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Bussiness</h3>
                    <table class="table table-bordered table-striped table-vcenter ">
                        <tr>
                            <td > </td>
                            <td> <a href="https://agent.sattit.com/storage/Trade/August2019/md-hasibul-2019-08-06-5d4907c0dfaf8.jpg" target="_blank"><img src="https://agent.sattit.com/storage/Trade/August2019/md-hasibul-2019-08-06-5d4907c0dfaf8.jpg" alt="" width="300px"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
</fieldset>
<!-- /login form -->
