<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `events` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " user_id LIKE '%{$search['value']}%'";
    $search_where .= " OR event_id LIKE '%{$search['value']}%'";
    $search_where .= " OR event_name LIKE '%{$search['value']}%'";
    $search_where .= " OR event_type LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "user_id",
    "event_id",
    "event_name",
    "event_type",
);

$query = $conn->query("SELECT user_id, event_id, event_name, event_type FROM events {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT user_id, event_id, event_name, event_type FROM events {$search_where}")->num_rows;
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