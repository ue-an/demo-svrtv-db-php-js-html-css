<?php
require '../function/import_function.php';
$conn = $conn;
$table = "holyweek";
$filename = "file-holyweek";
$idprefix = "hwrid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>