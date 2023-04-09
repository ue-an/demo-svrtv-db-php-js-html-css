<?php 
// require_once("connect.php");
require_once '../connect.php';
extract($_POST);
 
$totalCount = $conn->query("SELECT * FROM `feastmercyministry` ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " fmm_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR user_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR donor_type LIKE '%{$search['value']}%' ";
    $search_where .= " OR donation_start_date LIKE '%{$search['value']}%' ";
    $search_where .= " OR donation_end_date LIKE '%{$search['value']}%' ";
    $search_where .= " OR amount LIKE '%{$search['value']}%' ";
    $search_where .= " OR pay_method LIKE '%{$search['value']}%' ";
}
$columns_arr = array(
                     "fmm_id",
                     "user_id",
                     "donor_type",
                     "donation_start_date",
                     "donation_end_date",
                     "amount",
                     "pay_method",
                    );
// $query2 = $conn->query("SELECT * FROM `feastcon` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
$query = $conn->query("SELECT fmm_id, user_id, donor_type, donation_start_date, donation_end_date, amount, pay_method FROM feastmercyministry {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
// $query = $conn->query("SELECT feastconID, users.email, country, feastDistrict, ticketType, classAttended
// FROM (feastcon
// INNER JOIN users ON feastcon.userID = users.userID)");
$recordsFilterCount = $conn->query("SELECT fmm_id, user_id, donor_type, donation_start_date, donation_end_date, amount, pay_method FROM feastmercyministry {$search_where} ")->num_rows;
 
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