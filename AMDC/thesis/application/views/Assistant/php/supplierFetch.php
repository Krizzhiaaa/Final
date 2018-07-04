<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'supplier_id',
    1   =>  'company_name',
    2   =>  'supplier_contact',
    3   =>  'address',
    4   =>  'supplier_status',
    5   =>  'product',
    6   =>  'remarks',
);  //create column like table in database

$sql ="SELECT * FROM suppliers";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM suppliers WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" OR supplier_id Like '".$request['search']['value']."%' ";
    $sql.=" OR company_name Like '".$request['search']['value']."%' ";
    $sql.=" OR supplier_contact Like '".$request['search']['value']."%' ";
    $sql.=" OR address Like '".$request['search']['value']."%' ";
    $sql.=" OR supplier_status Like '".$request['search']['value']."%' ";
    $sql.=" OR product Like '".$request['search']['value']."%' ";
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
    $status = '';
    if($row["supplier_status"] == 'Active')
    {
        $status = '<span class="label label-success">Active</span>';
    }
    else
    {
        $status = '<span class="label label-danger">Inactive</span>';
    }
    $subdata=array();
    $subdata[]=$row[1]; 
    $subdata[]=$row[2]; 
    $subdata[]=$row[3];  
    $subdata[]=$row[5]; 
    $subdata[]=$status;
    $subdata[]=$row[6];  


           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                <button type="button" name="update" id="getUpdate" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalUpdate" data-id="'.$row[0].'"><i class="glyphicon glyphicon-random"></i> Change Status</button>
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
