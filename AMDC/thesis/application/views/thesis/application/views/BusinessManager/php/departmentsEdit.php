<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from departments WHERE department_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_departmentName=$row[1];
        $per_departmentLocation=$row[2];
        //$per_reqId=$row[3];
        //$per_userId=$row[5];
        //$per_suppId=$row[4];
        //$per_suppId=$row[3];

    }//end while
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
                                                    <center><h5>Assumption Medical Diagnostic Center </h5></center>
                                                    <center><h6>10 Assumption Rd., Baguio City</h6></center>
                                                    <center><h6>Philippines</h6></center>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of modal header -->
                                        <div class="modal-body">
                                        <div class="box-header">
                                          <div class="margin">
                                              <center><h4><b>Update Department Details</b></h4></center>
                                            </div>
                                        </div>
                    <form class="form-horizontal" method="post">
                    <div class="box-body">
                            <div class="form-group">
                            <label hidden="true" for="txtid">Department ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                                 </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group" style="width:100%">
                                    <label class="exampleInputEmail" for="txtlocation">Branch Location</label>
                                    <select id="txtlocation" name="txtlocation" class="form-control">
                                        <option value="Baguio City" <?php echo ($per_departmentLocation =='Baguio City')?'selected':'' ?>>Baguio City</option>
                                        <option value="La Trinidad" <?php echo ($per_departmentLocation =='La Trinidad')?'selected':'' ?>>La Trinidad</option>
                                        <option value="SLU Hospital" <?php echo ($per_departmentLocation =='SLU Hospital')?'selected':'' ?>>SLU Hospital</option>
                                    </select> 
                                </div> 
                                </div>   
                                <div class="col-md-6">   
                                    <div class="form-group">    
                                        <label class="exampleInputEmail" for="txtdepartmentname">Department Name</label>
                                        <input type="text" class="form-control" id="txtdepartmentname" name="txtdepartmentname" value="<?php echo $per_departmentName;?>">
                                    </div>
                            </div>
                        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="btnEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
    </div>
</div>
    </form>
<?php
}//end if
?>









