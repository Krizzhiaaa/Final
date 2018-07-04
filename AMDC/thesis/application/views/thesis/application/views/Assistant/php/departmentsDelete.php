<?php
$conn=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from departments WHERE department_id=$id";
    $run_sql=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
    }//end while
?>
    <form class="form-horizontal" method="post" action ="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                 <center><h3 class="modal-title"><b>Do you want to delete this item?</b></h3></center>
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                             <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Supply ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="departments"><button type="button" class="btn btn-danger">Cancel</button> </a>
                <button type="submit" class="btn btn-warning" name="depDelete">Delete</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>