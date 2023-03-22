<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastapp";
$filename = "file-feastapp";
$idprefix = "fstapp-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>