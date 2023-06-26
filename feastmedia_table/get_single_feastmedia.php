<?php
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$query = $conn->query("SELECT * FROM `feastmedia_records` where feast_media_event_id = '{$feastmediaID}'");
if($query){
    $resp['status'] = 'success';
    $resp['data'] = $query->fetch_array();
}else{
    $resp['status'] = 'success';
    $resp['error'] = 'An error occured while fetching the data. Error: '.$conn->error;
}
echo json_encode($resp);
?>