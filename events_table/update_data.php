<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `feastcon` set `country` = '{$country}', `feastDistrict` = '{$feastDistrict}', `ticketType` = '{$ticketType}', `classAttended` = '{$classAttended}' where feastconID = '{$feastconID}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>