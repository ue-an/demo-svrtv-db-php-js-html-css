<?php
require '../function/import_function.php';
$conn = $conn;
$table = "fmm";
$filename = "file-fmm";
$idprefix = "fmmid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>