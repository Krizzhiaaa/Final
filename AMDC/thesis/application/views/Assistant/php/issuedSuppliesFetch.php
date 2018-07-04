<?php
//ISSUED SUPPLIES RETRIEVE / FETCH
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'request_date',
    1   =>  'issue_date',
    2   =>  'supply_type',
    3   =>  'supply_description',
    4   =>  'quantity_in_stock',
    5   =>  'department_name',
    6   =>  'location'  
);  //create column like table in database

$sql ="SELECT * FROM request_supplies";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM issuedSupplies";
if(!empty($request['search']['value'])){
    $sql.=" 0R request_date            Like '%".$request['search']['value']."%' ";
    $sql.=" OR issue_date              Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'supply_type'           Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'supply_description'    Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'quantity_in_stock'     Like '%".$request['search']['value']."%' ";
    $sql.=" OR department_name         Like '%".$request['search']['value']."%' ";
    $sql.=" OR location                Like '%".$request['search']['value']."%' ";
    
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']." ";

$query=mysqli_query($con,$sql);

$data=array();

while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[0];
    $subdata[]=$row[1];
    $subdata[]=$row[2];
    $subdata[]=$row[3];
    $subdata[]=$row[4];  
    $subdata[]=$row[5];
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