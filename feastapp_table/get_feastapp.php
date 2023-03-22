<?php 
// require_once("connect.php");
require_once '../connect.php';
extract($_POST);
 
$totalCount = $conn->query("SELECT * FROM `feastapp` ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " feastappID LIKE '%{$search['value']}%' ";
    $search_where .= " OR email LIKE '%{$search['value']}%' ";
    $search_where .= " OR firstname LIKE '%{$search['value']}%' ";
    $search_where .= " OR lastname LIKE '%{$search['value']}%' ";
    $search_where .= " OR mobile LIKE '%{$search['value']}%' ";
    $search_where .= " OR downloadDate LIKE '%{$search['value']}%' ";
}
$columns_arr = array(
                     "feastappID",
                     "email",
                     "firstname",
                     "lastname",
                     "mobile",
                     "downloadDate",
                    );
// $query2 = $conn->query("SELECT * FROM `feastcon` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
$query = $conn->query("SELECT feastappID, users.email, users.firstname, users.lastname, users.mobile, downloadDate FROM feastapp INNER JOIN users ON feastapp.userID = users.userID {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
// $query = $conn->query("SELECT feastconID, users.email, country, feastDistrict, ticketType, classAttended
// FROM (feastcon
// INNER JOIN users ON feastcon.userID = users.userID)");
$recordsFilterCount = $conn->query("SELECT feastappID, users.email, users.firstname, users.lastname, users.mobile, downloadDate FROM feastapp INNER JOIN users ON feastapp.userID = users.userID {$search_where} ")->num_rows;
 
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