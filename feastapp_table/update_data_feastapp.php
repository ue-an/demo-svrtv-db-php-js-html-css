<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$update = $conn->query("UPDATE `feastapp` set `date_downloaded` = '{$date_downloaded}' where feastapp_id = '{$feastapp_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>