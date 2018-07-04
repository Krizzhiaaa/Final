<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) WHERE purchase_order_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
         $per_po_uniq_id=$row[0];
        $per_po_id=$row[1];
        $per_orderDate=$row[2];
        $per_quantity=$row[3];
        $per_unit=$row[4];
        $per_po_remarks=$row[5];
        $per_description=$row[6];
        $per_deliveryDate=$row[7];
        $per_supply_type=$row[8];
        $per_supplier=$row[9];
        $per_unitprice=$row[10];
        $per_total=$row[11];
        $per_purch_id=$row[12];
        $per_qtyDelivered=$row[13];
        $per_delRemarks=$row[14];
        $per_notes=$row[15];
        $per_id=$row[16];
        $per_createdDate_=$row[17];
        $per_orderName=$row[18];  
        $per_status=$row[19]; 
        $per_purchRemarks=$row[20];
        $per_gtotal=$row[21];
        $per_key=$row[22];
        $per_itemdelRemarks=$row[23];
        $per_soft_deleted=$row[24];
        $date = date("Y-m-d");
        

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
                      <center><h5>Assumption Medical Diagnostic Center, Inc.</h5></center>
                                                    <center><h6>10 Assumption Rd., Baguio City</h6></center>
                                                    <center><h6>Philippines</h6></center>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="modal-body">
                                        <div class="box-header">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <center><h2 class="modal-title"><b>Are you sure to change the status of the purchase order?</b></h2></center>
                        <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Purchase ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_key;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 control-label" for="txtstatus"></label>
                            <div class="col-sm-1">
                                <input type="hidden" class="form-control" id="txtstatus" name="txtstatus" hidden value="<?php echo $per_status;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                                     <input type="hidden" class="form-control pull-right" name="orDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-warning" name="btnUpdate"> <i class="fa fa-random"></i> Change</button>
            </div>
        </div>
    </form>

<?php
}//end if
?>