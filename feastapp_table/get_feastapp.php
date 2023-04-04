<?php 
// require_once("connect.php");
require_once '../connect.php';
extract($_POST);
 
$totalCount = $conn->query("SELECT * FROM `feastapp` ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " feastapp_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR user_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR date_downloaded LIKE '%{$search['value']}%' ";
}
$columns_arr = array(
                     "feastapp_id",
                     "user_id",
                     "date_downloaded",
                    );
// $query2 = $conn->query("SELECT * FROM `feastcon` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
$query = $conn->query("SELECT feastapp_id, user_id, date_downloaded FROM feastapp {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
// $query = $conn->query("SELECT feastconID, users.email, country, feastDistrict, ticketType, classAttended
// FROM (feastcon
// INNER JOIN users ON feastcon.userID = users.userID)");
$recordsFilterCount = $conn->query("SELECT feastapp_id, user_id, date_downloaded FROM feastapp {$search_where} ")->num_rows;

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