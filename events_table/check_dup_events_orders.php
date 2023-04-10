<?php
function eventsOrdersExist($mysqli, $orderNo, $receiptNo) {
 $sql = "SELECT * FROM events_orders WHERE (order_no = ? OR receipt_no = ?)";
 $stmt = mysqli_stmt_init($mysqli);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
  exit();
 }
  mysqli_stmt_bind_param($stmt,"ss",$orderNo, $receiptNo);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }
  mysqli_stmt_close($stmt);
}
?>