<?php 
// require_once("connect.php");
require_once '../connect.php';
extract($_POST);
 
$totalCount = $conn->query("SELECT * FROM `feastmedia` ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " feastmedia_event_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR event_name LIKE '%{$search['value']}%' ";
    $search_where .= " OR ticket_type LIKE '%{$search['value']}%' ";
    $search_where .= " OR event_type LIKE '%{$search['value']}%' ";
    $search_where .= " OR event_date LIKE '%{$search['value']}%' ";
    $search_where .= " OR ticket_cost LIKE '%{$search['value']}%' ";
    $search_where .= " OR no_of_tickets_bought LIKE '%{$search['value']}%' ";
    $search_where .= " OR total_cost LIKE '%{$search['value']}%' ";
    //ticket_cost; no_of_tickets_bought; total_cost
}
$columns_arr = array(
                     "feastmedia_event_id",
                     "user_id",
                     "event_name",
                     "ticket_type",
                     "event_type",
                     "event_date",
                     "ticket_cost",
                     "no_of_tickets_bought",
                     "total_cost",
                    );
// $query2 = $conn->query("SELECT * FROM `feastcon` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
$query = $conn->query("SELECT feastmediaID, users.email, users.firstname, users.lastname, users.mobile FROM feastmedia INNER JOIN users ON feastmedia.userID = users.userID {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
// $query = $conn->query("SELECT feastconID, users.email, country, feastDistrict, ticketType, classAttended
// FROM (feastcon
// INNER JOIN users ON feastcon.userID = users.userID)");
$recordsFilterCount = $conn->query("SELECT feastmediaID, users.email, users.firstname, users.lastname, users.mobile FROM feastmedia INNER JOIN users ON feastmedia.userID = users.userID {$search_where} ")->num_rows;
 
$recordsTotal= $totalCount;
$recordsFiltered= $recordsFilterCount;
$data = array();
$i= 1 + $start;
while($row = $query->fetch_assoc()){
    $row['no'] = $i++;
    // $row['isBonafied'] = $row['isBonafied'] == 0 ? "true" : "false";
    $data[] = $row;
}
echo json_encode(array('draw'=>$draw,
                       'recordsTotal'=>$recordsTotal,
                       'recordsFiltered'=>$recordsFiltered,
                       'data'=>$data
                       )
);
?>