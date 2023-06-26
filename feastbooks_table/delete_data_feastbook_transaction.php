<?php 
// require_once('connect.php');
require_once '../connect.php';
extract($_POST);
 
$delete = $conn->query("DELETE FROM `feastbooks_transactions` where feastbook_id = '{$feastbookID}'");
if($delete){
    $resp['status'] = 'success';
}else{
    $resp['status'] = 'success';
    $resp['msg'] = 'An error occured while saving the data. Error: '.$conn->error;
}
 
echo json_encode($resp);
?>