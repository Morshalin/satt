<?php
require_once '../../config/config.php';
ajax();
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = "SELECT * FROM satt_users WHERE id='$userid'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'User Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

?>