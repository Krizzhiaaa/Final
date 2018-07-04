<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
	0   =>  'po_id',
    1   =>  'order_date',
    2   =>  'order_quantity',
    3   =>  'order_unit',
    4   =>  'po_unitprice',
	5   =>  'total',
	6   =>  'grand_total',
	7   =>  'po_remarks',
	
);  //create column like table in database

$sql ="SELECT * FROM purchase_orders";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM purchase_orders WHERE 1=1";	
if(!empty($request['search']['value'])){
	$sql.=" OR po_id Like '".$request['search']['value']."%' ";
	$sql.=" OR order_date Like '".$request['search']['value']."%' ";
    $sql.=" OR order_quantity Like '".$request['search']['value']."%' ";
    $sql.=" OR order_unit Like '".$request['search']['value']."%' ";
    $sql.=" OR po_unitprice Like '".$request['search']['value']."%' ";
	$sql.=" OR total Like '".$request['search']['value']."%' ";
	$sql.=" OR grand_total Like '".$request['search']['value']."%' ";
	$sql.=" OR remarks Like '".$request['search']['value']."%' ";
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
	$subdata[]=$row[1]; 
    $subdata[]=$row[2]; 	 	
    $subdata[]=$row[3];
	$subdata[]=$row[4];	
	$subdata[]=$row[5];
	$subdata[]=$row[6];	
	$subdata[]=$row[7];
	
           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
             <a href="purchases?delete='.$row[0].'" onclick="return confirm(\'Are You Sure to delete the item?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Remove</a>';
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
