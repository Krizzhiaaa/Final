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
        $per_id=$row[0];
        $per_userName=$row[2];
        $per_userStatus=$row[8];


    }//end while
?>
    <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <div class="col-md-2">
                                                <img src="../assets/dist/img/user3-128x128.png" alt="User Image" style="width:80px;height:80px;">
                                            </div>
                                            <div class="col-md-8">
                                                
                                                <div class="margin">
                                                    <center><h5>Assumption Medical Diagnostic Center</h5></center>
                                                    <center><h6>10 Assumption Rd., Baguio City</h6></center>
                                                    <center><h6>Philippines</h6></center>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of modal header -->
                                        <div class="modal-body">
                                        <div class="box-header">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <center><h3 class="modal-title"><b>Are you sure to change the status of</h3><h2><b><?php echo 'Username: '; ?><u><?php echo $per_userName;?></u>?</b></h2></b></h3></center>
                        <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">User ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-8 control-label" for="txtUserstatus"></label>
                            <div class="col-sm-1">
                                <input type="hidden" class="form-control" id="txtUserStatus" name="txtUserStatus" hidden value="<?php echo $per_userStatus;?>" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-warning" name="btnUpdate"><i class="glyphicon glyphicon-random"></i>&nbsp;&nbsp;Change</button>
            </div>
        </div>
    </form>

<?php
}//end if
?>