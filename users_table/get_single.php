<?php
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$query = $conn->query("SELECT * FROM `attendees` where user_id = '{$userID}'");
if($query){
    $resp['status'] = 'success';
    $resp['data'] = $query->fetch_array();
}else{
    $resp['status'] = 'success';
    $resp['error'] = 'An error occured while fetching the data. Error: '.$conn->error;
}
echo json_encode($resp);
?>