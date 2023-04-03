<?php
require '../function/import_function.php';
$conn = $conn;
$table = "event";
$filename = 'file-event';
$idprefix = "eventid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>