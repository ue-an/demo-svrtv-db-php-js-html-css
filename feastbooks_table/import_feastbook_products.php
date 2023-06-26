<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastbooks_products";
$filename = 'file-feastbook-product';
$idprefix = "prdid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>