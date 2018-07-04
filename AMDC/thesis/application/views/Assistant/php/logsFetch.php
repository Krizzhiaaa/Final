<?php
//ISSUED SUPPLIES RETRIEVE / FETCH
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'fk_user_id',
    1   =>  'activity',
    2   =>  'module',
    3   =>  'created_at'

);  //create column like table in database

$sql ="SELECT * FROM logs";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM logs";
if(!empty($request['search']['value'])){
    $sql.=" OR 'created_at'          Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'activity'            Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'fk_user_id'          Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'module'              Like '%".$request['search']['value']."%' ";
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