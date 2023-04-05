<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `events_orders` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " order_no LIKE '%{$search['value']}%'";
    $search_where .= " OR receipt_no LIKE '%{$search['value']}%'";
    $search_where .= " OR event_id LIKE '%{$search['value']}%";
    $search_where .= " OR paymentMethod LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "order_no",
    "receipt_no",
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