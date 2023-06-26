<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
// $mobile_num = strval($mobileno);
//, `mobile_no` = '{$mobile_no}', `is_bonafied` = '{$isBonafied}', `is_feast_attendee` = '{$isFeastAttendee}', `feast_name` = '{$feastName}', `feast_district` = '{$district}', `address` = '{$address}', `city` = '{$city}', `country` = '{$country}'

$update = $conn->query("UPDATE `attendees` set `email` = '{$email}', `last_name` = '{$last_name}', `first_name` = '{$first_name}', `is_bonafied` = '{$is_bonafied}' where user_id = '{$user_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>