<?php
//MEDICAL SUPPLIES RETRIEVE / FETCH
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'supply_id',
    1   =>  'supply_type',
    2   =>  'supply_description',
    3   =>  'brand_name',
    4   =>  'unit',
    5   =>  'quantity_in_stock',
    6   =>  'unit_price',
    7   =>  'unit_on_order',
    8   =>  'reorder_level',
    9   =>  'expiration_date',
    10  =>  'good_condition',
    11  =>  'damaged',
    12  =>  'total_quantity',
    13  =>  'total_amount',
    14  =>  'delivery_id',
    15  =>  'supplier_id',
    16  =>  'soft_deleted'
);  //create column like table in database

$sql ="SELECT * FROM supplies";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM supplies WHERE 1=1 AND supply_type LIKE 'Medical' AND soft_deleted!='N' ";
if(!empty($request['search']['value'])){
    $sql.=" 0R supply_id            Like '%".$request['search']['value']."%' ";
    $sql.=" OR supply_description   Like '%".$request['search']['value']."%' ";
    $sql.=" OR unit                 Like '%".$request['search']['value']."%' ";
    $sql.=" OR quantity_in_stock    Like '%".$request['search']['value']."%' ";
    $sql.=" OR unit_price           Like '%".$request['search']['value']."%' ";
    $sql.=" OR reorder_level        Like '%".$request['search']['value']."%' ";
    $sql.=" OR expiration_date      Like '%".$request['search']['value']."%' ";
    $sql.=" OR good_condition       Like '%".$request['search']['value']."%' ";
    $sql.=" OR damaged              Like '%".$request['search']['value']."%' ";
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
    $subdata[]=$row[9];
    $subdata[]=$row[2]; 
    $subdata[]=$row[5];  
    $subdata[]=$row[4]; 
    $subdata[]='<td align="right">&#8369 '.$row[6].'</td>';
    $subdata[]=$row[8];

           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='
            <button type="button" id="getRestore" class="btn btn-success btn-xs" data-toggle="modal"
        data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-repeat"></i> Restore</button>&nbsp;
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