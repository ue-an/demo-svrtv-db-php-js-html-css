<?php
require '../function/import_function.php';
$conn = $conn;
$table = "anawim";
$filename = "file-anawim";
$idprefix = "anid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>