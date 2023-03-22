<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$mobile_num = strval($mobile);
 
$update = $conn->query("UPDATE `users` set `email` = '{$email}',
`lastname` = '{$lastname}', `firstname` = '{$firstname}', `mobile` = '{$mobile_num}',
`isBonafied` = '{$isMain}', `isFeastAttendee` = '{$isFeastAttendee}', `feastName` = '{$feastName}',
`district` = '{$district}', `address` = '{$address}', `city` = '{$city}', `country` = '{$country}' where userID = '{$userID}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>