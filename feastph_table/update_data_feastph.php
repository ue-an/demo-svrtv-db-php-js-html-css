<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
$update = $conn->query("UPDATE `feastph_records` set `file_name` = '{$file_name}', `file_download_date` = '{$file_download_date}' where feastph_id = '{$feastph_id}'");
if($update){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>