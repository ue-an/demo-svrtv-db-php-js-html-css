<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `feastbooks_transactions` set `order_id` = '{$order_id}', `product_id` = '{$product_id}', `user_id` = '{$user_id}', `quantity` = '{$quantity}' where feastbook_id = '{$feastbook_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>