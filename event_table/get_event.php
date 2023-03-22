<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `events` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " orderNo LIKE '%{$search['value']}%'";
    $search_where .= " OR receiptNo LIKE '%{$search['value']}%'";
    $search_where .= " OR email LIKE '%{$search['value']}%'";
    $search_where .= " OR transactionDate LIKE '%{$search['value']}%'";
    $search_where .= " OR transactionAmount LIKE '%{$search['value']}%'";
    $search_where .= " OR eventName LIKE '%{$search['value']}%'";
    $search_where .= " OR ticketType LIKE '%{$search['value']}%'";
    $search_where .= " OR eventType LIKE '%{$search['value']}%'";
    $search_where .= " OR paymentMethod LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "orderNo",
    "receiptNo",
    "userID",
    "firstname",
    "lastname",
    "transactionDate",
    "transactionAmount",
    "eventName",
    "ticketType",
    "eventType",
    "paymentMethod",
);

$query = $conn->query("SELECT orderNo, receiptNo, events.userID, users.firstname, users.lastname, transactionDate, transactionAmount, eventName, ticketType, eventType, paymentMethod FROM events INNER JOIN users ON events.userID = users.userID {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT orderNo, receiptNo, events.userID, users.firstname, users.lastname, transactionDate, transactionAmount, eventName, ticketType, eventType, paymentMethod FROM events INNER JOIN users ON events.userID = users.userID {$search_where}")->num_rows;
$recordsTotal = $totalCount;
$recordsFiltered = $recordsFilterCount;
$data = array();
$i = 1 + $start;
while ($row = $query->fetch_assoc()) {
    $row['no'] = $i++;
    $data[] = $row;
}
echo json_encode(array('draw'=>$draw,
                        'recordsTotal'=>$recordsTotal,
                        'recordsFiltered'=>$recordsFiltered,
                        'data'=>$data
                        )
)
?>