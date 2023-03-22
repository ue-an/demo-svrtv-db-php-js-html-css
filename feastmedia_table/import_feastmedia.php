
<?php
require '../function/import_function.php';
$conn = $conn;
$table = "feastmedia";
$filename = "file-feastmedia";
$idprefix = "fmedid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>