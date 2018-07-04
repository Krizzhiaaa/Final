<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from departments WHERE department_id=$id";
    $sql2="SELECT * FROM departments JOIN users ON department_name = dept_name JOIN purchase_order_bm on CONCAT(fname, ' ',lname) = purchase_order_name WHERE department_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_departmentName=$row[1];
        $per_departmentLocation=$row[2];
        $per_departmentStatus=$row[3];
//        $per_Status=$row[22];


    }//end while
    $sql3="SELECT * FROM users JOIN purchase_order_bm on CONCAT(fname, ' ',lname) = purchase_order_name WHERE dept_name LIKE '%".$per_departmentName."%' AND purchase_order_status = 'Pending' AND branch LIKE '%".$per_departmentLocation."%'";
    $result = $con->query($sql3); 
      if ($result->num_rows < 1){
?>
       <div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
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
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <?php if($per_departmentStatus == 'Inactive'){ ?>
                            <center>
                                <h3 class="modal-title">
                                    <b>Are you sure to activate </b>
                                </h3>
                                <h4>
                                    <b>Department Name: <u><?php echo $per_departmentName;?></u></b>
                                </h4>
                                <h4>
                                    <b>Branch Location: <u><?php echo $per_departmentLocation;?></u></b>
                                </h4>
                            </center>
                        <?php }else { ?>
                            <center>
                                <h3 class="modal-title">
                                    <b>Are you sure to deactivate </b>
                                </h3>
                                <h4>
                                    <b>Department Name: <u><?php echo $per_departmentName;?></u></b>
                                </h4>
                                <h4>
                                    <b>Branch Location: <u><?php echo $per_departmentLocation;?></u></b>
                                </h4>
                            </center>
                        <?php } ?>
                        <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Department ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-8 control-label" for="txtdepartmentstatus"></label>
                            <div class="col-sm-1">
                                <input type="hidden" class="form-control" id="txtdepartmentStatus" name="txtdepartmentStatus" hidden value="<?php echo $per_departmentStatus;?>" readonly>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <?php if($per_departmentStatus == 'Inactive'){ ?>
                    <button type="submit" class="btn btn-success" name="btnUpdate"><i class="fa fa-check"></i> Activate</button>
                <?php }else { ?>
                    <button type="submit" class="btn btn-danger" name="btnUpdate"><i class="fa fa-remove"></i> Deactivate</button>
                <?php } ?>
            </div>
        </div>
    </div>
    </form>
<?php
    }else{
?>
<div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
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
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <center><h3 class="modal-title"><b>Cannot deactivate <h4><b>Department Name: <u><?php echo $per_departmentName;?></u></b> <br><b>Branch Location: <u><?php echo $per_departmentLocation;?></u></b></h4><b>There are still pending orders.</b></h3></center>
                        <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Department ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-8 control-label" for="txtdepartmentstatus"></label>
                            <div class="col-sm-1">
                                <input type="hidden" class="form-control" id="txtdepartmentStatus" name="txtdepartmentStatus" hidden value="<?php echo $per_departmentStatus;?>" readonly>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>
        </div>
    </div>
    </form>
<?php
    }
?>

<?php
}//end if
?>