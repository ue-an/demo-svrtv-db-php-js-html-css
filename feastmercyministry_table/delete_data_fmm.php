<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$delete = $conn->query("DELETE FROM `feastmercyministry_records` where fmm_id = '{$fmmID}'");
if($delete){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>