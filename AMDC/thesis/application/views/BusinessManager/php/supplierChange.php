<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM suppliers WHERE supplier_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_supplierName=$row[1];
        $per_supplierContact=$row[2];
        $per_supplierAddress=$row[3];
        $per_supplierProduct=$row[5];
        $per_supplierStatus=$row[4];
        $per_supplierRemarks=$row[6];

    }//end while
    $query = "SELECT * FROM suppliers JOIN purchase_orders ON company_name = supplier WHERE supplier LIKE '%".$per_supplierName."%' AND po_remarks = 'Pending' OR item_delivery_remarks = 'Partial' AND supplier_id = $id";
    $result_query = $con->query($query);

    if($result_query->num_rows < 1){ 
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <form class="form-horizontal" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <?php if($per_supplierStatus == 'Inactive'){ ?>
                                        <center>
                                            <h3 class="modal-title">
                                                <b>Are you sure to activate supplier</b>
                                            </h3>
                                            <h2>
                                                <b><u><?php echo $per_supplierName;?></u>?</b>
                                            </h2>
                                        </center>
                                    <?php }else{ ?>
                                        <center>
                                            <h3 class="modal-title">
                                                <b>Are you sure to deactivate supplier</b>
                                            </h3>
                                            <h2>
                                                <b><u><?php echo $per_supplierName;?></u>?</b>
                                            </h2>
                                        </center>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label hidden="true" class="col-sm-4 control-label" for="txtid">Suppliers ID</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label" for="txtsupplierstatus"></label>
                                        <div class="col-sm-1">
                                            <input type="hidden" class="form-control" id="txtsupplierstatus" name="txtsupplierstatus" hidden value="<?php echo $per_supplierStatus;?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                            <?php if($per_supplierStatus == 'Inactive'){ ?>
                                <button type="submit" class="btn btn-success" name="btnUpdate"> <i class="fa fa-check"></i> Activate</button>
                            <?php }else { ?>
                                <button type="submit" class="btn btn-danger" name="btnUpdate"> <i class="fa fa-remove"></i> Deactivate</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                        <center>
                                            <h3 class="modal-title">
                                                <b>Cannot deactivate</b>
                                            </h3>
                                            <h2>
                                                <b><u><?php echo $per_supplierName;?></u></b>
                                            </h2>
                                            <h2><b>because of ongoing delivery/ies </b></h2>
                                        </center>
                                    <div class="form-group">
                                        <label hidden="true" class="col-sm-4 control-label" for="txtid">Suppliers ID</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label" for="txtsupplierstatus"></label>
                                        <div class="col-sm-1">
                                            <input type="hidden" class="form-control" id="txtsupplierstatus" name="txtsupplierstatus" hidden value="<?php echo $per_supplierStatus;?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button><!-- 
                                <button type="submit" class="btn btn-success" name="btnUpdate"> <i class="fa fa-check"></i> Activate</button>
                                <button type="submit" class="btn btn-danger" name="btnUpdate"> <i class="fa fa-remove"></i> Deactivate</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php
}//end if
?>