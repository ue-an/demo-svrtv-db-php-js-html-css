<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `feastbooks_orders` set `order_status` = '{$order_status}', `order_created` = '{$order_created}', `order_completed` = '{$order_completed}' where order_id = '{$order_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>