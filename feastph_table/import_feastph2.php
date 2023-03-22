<?php
// require_once('connect.php');
require_once '../connect.php';
require 'check_dup_feastapp.php';
require '../function/import_function.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$conn = $conn;
$table = "feastph";
$filename = 'file-feastapp'; //change based on table
$idprefix = "fstapp-";

importFunction($conn, $table, $filename, $idprefix);

?>