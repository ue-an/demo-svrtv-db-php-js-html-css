<?php
function userExist($mysqli, $email, $lastname, $firstname) {
 $sql = "SELECT * FROM users WHERE (email = ? AND last_name = ?) AND first_name = ?";
 $stmt = mysqli_stmt_init($mysqli);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
  exit();
 }
  mysqli_stmt_bind_param($stmt,"sss",$email, $lastname, $firstname);
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