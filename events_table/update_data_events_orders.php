<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `events_orders` set `order_status` = '{$order_status}', `order_created_date` = '{$order_created_date}', `order_completed_date` = '{$order_completed_date}', `pay_method` = '{$pay_method}' where order_no = '{$order_no}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>