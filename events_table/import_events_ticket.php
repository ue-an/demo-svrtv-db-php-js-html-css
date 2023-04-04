<?php
require '../function/import_function.php';
$conn = $conn;
$table = "events_ticket";
$filename = 'file-events-ticket';
$idprefix = "tcktid-";
$result = importFunction($conn, $table, $filename, $idprefix);
echo $result;
?>