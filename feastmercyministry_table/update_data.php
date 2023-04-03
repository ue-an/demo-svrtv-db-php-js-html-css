<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `anawim` set `address` = '{$address}', `monthlyDonation` = '{$monthlyDonation}', `category` = '{$category}' where anawimID = '{$anawimID}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>