<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from memo WHERE memo_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_memodate=$row[1];
        $per_memouser=$row[2];
        $per_memodescription=$row[3];
        $per_memosoft=$row[4];
        $per_memostatus=$row[5];
        $memo_title=$row[6];

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
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                          <center><h2 class="modal-title"><b>Are you sure to mark this memo entitled</b> <br><center> <u> <b><?php echo $memo_title; ?></u> <br><b> finished? </b></h2></center> 
                        <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Memo ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 control-label" for="txtmemostatus"></label>
                            <div class="col-sm-1">
                                <input type="hidden" class="form-control" id="txtmemostatus" name="txtmemostatus" value="<?php echo $per_memostatus;?>" readonly>
                            </div>
                        </div>
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-warning" name="btnUpdate"><i class="fa fa-flag"></i> Mark Finished</button>
            </div>
        </div>
    </form>

<?php
}//end if
?>