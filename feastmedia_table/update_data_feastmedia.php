<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$update = $conn->query("UPDATE `feastmedia` set `event_name` = '{$event_name}', `ticket_type` = '{$ticket_type}', `event_type` = '{$event_type}', `event_date` = '{$event_date}', `ticket_cost` = '{$ticket_cost}' where feastmedia_event_id = '{$feastmedia_event_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>