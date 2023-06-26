<?php
function feastbookOrdersExist($mysqli, $order_id) {
 $sql = "SELECT * FROM feastbooks_orders WHERE order_id = ?";
 $stmt = mysqli_stmt_init($mysqli);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
  exit();
 }
  mysqli_stmt_bind_param($stmt,"s",$order_id);
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