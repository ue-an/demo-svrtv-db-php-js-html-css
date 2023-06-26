<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `feastbooks_products` set `product_name` = '{$product_name}', `cost` = '{$cost}', `variation` = '{$variation}', `category` = '{$category}' where product_id = '{$product_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>