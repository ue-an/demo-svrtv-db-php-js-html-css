<?php 
// require_once("connect.php");
require_once '../connect.php';
extract($_POST);
 
$totalCount = $conn->query("SELECT * FROM `attendees` ")->num_rows;
$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " user_id LIKE '%{$search['value']}%' ";
    $search_where .= " OR email LIKE '%{$search['value']}%' ";
    $search_where .= " OR last_name LIKE '%{$search['value']}%' ";
    $search_where .= " OR first_name LIKE '%{$search['value']}%' ";
    $search_where .= " OR is_bonafied LIKE '%{$search['value']}%' ";
}
$columns_arr = array("user_id",
                     "email",                     
                     "last_name",
                     "first_name",
                     "mobile_no",
                     "is_bonafied",
                     "is_feast_attendee",
                     "feast_name",
                     "feast_district",
                     "address",
                     "city",
                     "country"
                    );
$query = $conn->query("SELECT * FROM `attendees` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
$recordsFilterCount = $conn->query("SELECT * FROM `attendees` {$search_where} ")->num_rows;
 
$recordsTotal= $totalCount;
$recordsFiltered= $recordsFilterCount;
$data = array();
$i= 1 + $start;
while($row = $query->fetch_assoc()){
    $row['no'] = $i++;
    $row['is_bonafied'] = $row['is_bonafied'] == 0 ? "true" : "false";
    $row['is_feast_attendee'] = $row['is_feast_attendee'] == 0 ? "true" : "false";
    $data[] = $row;
}
echo json_encode(array('draw'=>$draw,
                       'recordsTotal'=>$recordsTotal,
                       'recordsFiltered'=>$recordsFiltered,
                       'data'=>$data
                       )
);
?>