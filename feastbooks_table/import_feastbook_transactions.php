<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastbooks_transactions";
$filename = 'file-feastbook-transaction';
$idprefix = "prdid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>