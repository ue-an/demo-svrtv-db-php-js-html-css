<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `events_tickets` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " ticket_id LIKE '%{$search['value']}%'";
    $search_where .= " OR event_name LIKE '%{$search['value']}%'";
    $search_where .= " OR ticket_type LIKE '%{$search['value']}%'";
    $search_where .= " OR ticket_name LIKE '%{$search['value']}%'";
    $search_where .= " OR ticket_cost LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "ticket_id",
    "event_name",
    "ticket_type",
    "ticket_name",
    "ticket_cost",
);
//ticket_id, event_id, ticket_type, ticket_name, ticket_cost
$query = $conn->query("SELECT ticket_id, events.event_name, ticket_type, ticket_name, ticket_cost FROM events_tickets INNER JOIN events ON events_tickets.event_id = events.event_id {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT ticket_id, events.event_name, ticket_type, ticket_name, ticket_cost FROM events_tickets INNER JOIN events ON events_tickets.event_id = events.event_id {$search_where}")->num_rows;
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