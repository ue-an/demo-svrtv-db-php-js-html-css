<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$update = $conn->query("UPDATE `events_ticket` set `event_id` = '{$event_id}', `ticket_type` = '{$ticket_type}', `ticket_name` = '{$ticket_name}', `ticket_cost` = '{$ticket_cost}' where ticket_id = '{$ticket_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>