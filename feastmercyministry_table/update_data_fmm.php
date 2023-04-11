<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$update = $conn->query("UPDATE `feastmercyministry` set `donor_type` = '{$donor_type}', `donation_start_date` = '{$donation_start_date}', `donation_end_date` = '{$donation_end_date}', `amount` = '{$amount}', `pay_method` = '{$pay_method}' where fmm_id = '{$fmm_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>