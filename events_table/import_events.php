<?php
require '../function/import_function.php';
$conn = $conn;
$table = "events";
$filename = 'file-events';
$idprefix = "";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>