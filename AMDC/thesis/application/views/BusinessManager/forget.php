<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['username'])){
    $username=intval($_REQUEST['username']);
    $sql="select * from users WHERE username=$username";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_userId=$row[0];
        $per_userName=$row[3];
        $per_password=$row[4];
        $per_type=$row[2];
        //$per_reqId=$row[3];
        //$per_userId=$row[5];
        //$per_suppId=$row[4];
        //$per_suppId=$row[3];

    }//end while
    if($per_type == 'BusinessManager'){
?>
<form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Forget Password</h4>
            </div>
                                                <!-- end of modal header -->
<div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                             <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">User ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_userId;?>" readonly>
                            </div>
                            </div>
                            <label class="col-sm-4 control-label" for="txtusername">Department Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtusername" name="txtdepartmentname" value="<?php echo $per_userName;?>">
                            </div>
                        </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputEmail1">Enter New Password</label>
                                                          <input type="email" name="pwd" class="form-control">
                                                        </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputEmail1">Confirm New Password</label>
                                                          <input type="email" name="pwd" class="form-control">
                                                        </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputEmail1">Security Question: Who is you favorite superhero?</label>
                                                          <input type="text " name="secq" class="form-control" placeholder="Answer">
                                                        </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="change" class="btn btn-primary" data-toggle="modal" data-target="#modal-warning">Change Password</button>
                                              </div>
                                            </div>
                                            <!-- /.modal-content --> 
                                          </div>
                                          <!-- /.modal-dialog -->
                                        </div>
                                        <!-- MODAL -->
                                   <!--  <div class="modal fade" id="modal-warning">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <h4>New Password Saved!</h4>
                                  </div>
                                </div> -->
                                <!-- /.modal-content -->
                              <!-- </div> -->
                              <!-- /.modal-dialog -->
                            <!-- </div> -->
                            <!-- /.modal -->
                            <?php
}elseif ($per_type == 'Assistant' || $per_type == 'Supervisor') {
  // echo '<script>alert("Please Go to the Office of the Business Manager")</script>';
?>
<div class="modal modal-success fade" id="modal-success">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>Please Go to the Office of the Business Manager&hellip;</h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                          
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
<?php  
}
?>
                            <?php
}//end if
?>