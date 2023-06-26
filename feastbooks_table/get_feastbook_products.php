<?php
require '../connect.php';
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `feastbooks_products` ")->num_rows;
$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " product_id LIKE '%{$search['value']}%'";
    $search_where .= " OR product_name LIKE '%{$search['value']}%'";
    $search_where .= " OR cost LIKE '%{$search['value']}%'";
    $search_where .= " OR variation LIKE '%{$search['value']}%'";
    $search_where .= " OR category LIKE '%{$search['value']}%'";
}
$columns_arr = array(
    "product_id",
    "product_name",
    "cost",
    "variation",
    "category",
);

$query = $conn->query("SELECT product_id, product_name, cost, variation, category FROM feastbooks_products {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");
$recordsFilterCount = $conn->query("SELECT product_id, product_name, cost, variation, category FROM feastbooks_products {$search_where}")->num_rows;
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