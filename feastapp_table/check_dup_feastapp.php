<?php
function feastappExist($mysqli, $userID, $downloadDate) {
 $sql = "SELECT * FROM feastapp WHERE (user_id = ? AND date_downloaded = ?)";
 $stmt = mysqli_stmt_init($mysqli);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
  exit();
 }
  mysqli_stmt_bind_param($stmt,"ss",$userID, $downloadDate);
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