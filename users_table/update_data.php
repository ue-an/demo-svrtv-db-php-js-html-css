<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$mobile_num = strval($mobile);
 
$update = $conn->query("UPDATE `users` set `email` = '{$email}',
`last_name` = '{$lastname}', `first_name` = '{$firstname}', `mobile_no` = '{$mobile_num}',
`is_bonafied` = '{$isMain}', `is_feast_attendee` = '{$isFeastAttendee}', `feast_name` = '{$feastName}',
`feast_district` = '{$district}', `address` = '{$address}', `city` = '{$city}', `country` = '{$country}' where user_id = '{$userID}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>