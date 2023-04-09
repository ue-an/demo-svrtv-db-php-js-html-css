<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `events_orders` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " order_no LIKE '%{$search['value']}%'";
    $search_where .= " OR receipt_no LIKE '%{$search['value']}%'";
    $search_where .= " OR order_status LIKE '%{$search['value']}%'";
    $search_where .= " OR order_created_date LIKE '%{$search['value']}%'";
    $search_where .= " OR order_completed_date LIKE '%{$search['value']}%'";
    $search_where .= " OR pay_method LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "order_no",
    "receipt_no",
    "order_status",
    "order_created_date",
    "order_completed_date",
    "pay_method",
);

$query = $conn->query("SELECT order_no, receipt_no, order_status, order_created_date, order_completed_date, pay_method FROM events_orders {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT order_no, receipt_no, order_status, order_created_date, order_completed_date, pay_method FROM events_orders {$search_where}")->num_rows;
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