<?php
require '../function/import_function.php';
$conn = $conn;
$table = "users";
$filename = "file";
$idprefix = "uid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>