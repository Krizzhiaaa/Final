<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col = array(
    0   =>  'user_id',
    1   =>  'user_type',
    2   =>  'username',
    3   =>  'password',
    4   =>  'lname',
    5   =>  'fname',
    6   =>  'user_contact',
    7   =>  'user_email',
    8   =>  'user_status',
);  //create column like table in database

$sql ="SELECT * FROM users";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM users WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" OR user_id Like '".$request['search']['value']."%' ";
    $sql.=" OR username Like '".$request['search']['value']."%' ";
    $sql.=" OR password Like '".$request['search']['value']."%' ";
    $sql.=" OR lname Like '".$request['search']['value']."%' ";
    $sql.=" OR fname Like '".$request['search']['value']."%' ";
    $sql.=" OR user_contact Like '".$request['search']['value']."%' ";
    $sql.=" OR user_email Like '".$request['search']['value']."%' ";
    $sql.=" OR user_status Like '".$request['search']['value']."%' ";
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
    $subdata[]=$row[5];  
    $subdata[]=$row[4]; 
    $subdata[]=$row[6];  
    $subdata[]=$row[7];
    $subdata[]=$row[8];  


           //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
             <a href="user_accounts?delete='.$row[0].'" onclick="return confirm(\'Are You Sure ?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
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

<?php
$connection=mysqli_connect('localhost','root','','itproject');  
 //CREATE or ADD User
  if (isset($_POST['addUser'])) {
  $sql = $connection->prepare("INSERT INTO users (username, fname, lname, user_contact, password, user_email) VALUES (?, ?, ?, ?, ?, ?)");  
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_contact = $_POST['user_contact'];
  $password = $_POST['password'];
  $user_email = $_POST['user_email'];
  $sql->bind_param("ssssss", $username, $fname, $lname, $user_contact, $password, $user_email);

  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','An account with username ".$username." has been successfully created','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $connection->close();
  header("Location: ../userAccounts");
  } 
?>

<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from users WHERE user_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
       
        $per_username=$row[2];
        $per_password=$row[3];
        $per_lname=$row[4];
         $per_id=$row[0];
        $per_fname=$row[5];
        $per_usercontact=$row[6];
        $per_email=$row[7];
         $per_status=$row[8];

    }//end while
?>
    <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                             <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">UserID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                            <label class="col-sm-4 control-label" for="txtusername">User Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtusername" name="txtusername" value="<?php echo $per_username;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtpassword">Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtpassword" name="txtpassword" value="<?php echo $per_password;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtlname">Last Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtlname" name="txtlname" value="<?php echo $per_lname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtfname">First Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtfname" name="txtfname" value="<?php echo $per_fname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtuser_contact">Contact Number</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtuser_contact" name="txtuser_contact" value="<?php echo $per_usercontact;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtemail">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="txtemail" name="txtemail" value="<?php echo $per_email;?>">
                            </div>
                        </div>
                               <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtstatus">Status</label>
                            <div class="col-sm-6">
                                <input type="status" class="form-control" id="txtstatus" name="txtstatus" value="<?php echo $per_status;?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <<div class="modal-footer">
                <a href="useraccountsphp"><button type="button" class="btn btn-danger">Cancel</button> </a>
                <button type="submit" class="btn btn-primary" name="btnEdit">Save</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>




