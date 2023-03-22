<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastph";
$filename = "file-feastph";
$idprefix = "fphid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>