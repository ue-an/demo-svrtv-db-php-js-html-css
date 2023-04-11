<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$update = $conn->query("UPDATE `holyweekretreat` set `event_date` = '{$event_date}' where hwr_id = '{$hwr_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>