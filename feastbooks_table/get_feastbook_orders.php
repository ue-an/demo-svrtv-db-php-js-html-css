<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `feastbooks_orders` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " order_id LIKE '%{$search['value']}%'";
    $search_where .= " OR order_status LIKE '%{$search['value']}%'";
    $search_where .= " OR order_created LIKE '%{$search['value']}%'";
    $search_where .= " OR order_completed LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "order_id",
    "order_status",
    "order_created",
    "order_completed",
);

$query = $conn->query("SELECT order_id, order_status, order_created, order_completed FROM feastbooks_orders {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT order_id, order_status, order_created, order_completed FROM feastbooks_orders {$search_where}")->num_rows;
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