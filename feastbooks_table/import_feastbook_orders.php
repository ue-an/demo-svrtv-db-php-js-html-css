<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastbooks_orders";
$filename = 'file-feastbook-order';
$idprefix = "ordid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>