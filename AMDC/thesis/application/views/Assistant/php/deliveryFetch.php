<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'supply_description',
    1   =>  'brand_name',
    2   =>  'delivery_date',
    3   =>  'company_name',
    4   =>  'total_quantity',
    5   =>  'unit',
    6   =>  'unit_price',
    7   =>  'total_amount',
    8   =>  'delivery_status',
    9   =>  'good_condition',
    10   =>  'damaged',
);  //create column like table in database

$sql ="SELECT DISTINCT supply_description, brand_name, deliveries.delivery_date, company_name, total_quantity, unit, unit_price, total_amount, delivery_status, good_condition, damaged FROM deliveries JOIN supplies JOIN suppliers JOIN purchase_orders WHERE delivery_status = 'Requested' GROUP BY supply_description";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT DISTINCT supply_description, brand_name, deliveries.delivery_date, company_name, total_quantity, unit, unit_price, total_amount, delivery_status, good_condition, damaged FROM deliveries JOIN supplies JOIN suppliers JOIN purchase_orders WHERE delivery_status = 'Requested' && 1=1 GROUP BY supply_description";
if(!empty($request['search']['value'])){
    $sql.=" OR supply_description Like '".$request['search']['value']."%' ";
    $sql.=" OR brand_name Like '".$request['search']['value']."%' ";
    $sql.=" OR delivery_date Like '".$request['search']['value']."%' ";
    $sql.=" OR company_name Like '".$request['search']['value']."%' ";
    $sql.=" OR total_quantity Like '".$request['search']['value']."%' ";
    $sql.=" OR unit Like '".$request['search']['value']."%' ";
    $sql.=" OR unit_price Like '".$request['search']['value']."%' ";
    $sql.=" OR total_amount Like '".$request['search']['value']."%' ";
    $sql.=" OR delivery_status Like '".$request['search']['value']."%' ";
    $sql.=" OR good_condition Like '".$request['search']['value']."%' ";
    $sql.=" OR damaged Like '".$request['search']['value']."%' ";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();

while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[2]; 
    $subdata[]=$row[0]; 
    $subdata[]=$row[1];  
    $subdata[]=$row[3]; 
    $subdata[]=$row[4];
    $subdata[]=$row[5];
    $subdata[]=$row[6]; 
    $subdata[]=$row[7];
    $subdata[]=$row[9];
    $subdata[]=$row[10];

           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='<button type="button" id="getFull" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'">Full</button>
                <button type="button" name="update" id="getPartial" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalUpdate" data-id="'.$row[0].'">Partial</button>
    ';
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>
