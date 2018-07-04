<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql=" SELECT * FROM purchase_orders WHERE po_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
		$per_id=$row[0];
        $per_orderDate=$row[1];
		$per_orderCustomerName=$row[2];
		$per_orderDepartment=$row[3];

    }//end while
?>
    <form class="form-horizontal" method="post" action="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"aria-label="Close"> <span aria-hidden="true">&times;</span></button>
				<div class="margin">
                <center><h3>Edit Order</h3></center>
				</div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                     <table>
                     <tr>
                    <div class="box-body">
                        <div class="form-group" style="width:100%;">
                            <label for="txtid">Order ID</label>
                                <input type="number" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                        </div>
						 <div class="row">
                         <div class="col-md-6">
						<div class="form-group" style="width:100%;">
                            <label for="txtpurchasedate">Order Date</label>
                           <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                             </div>
                                <input type="date" class="form-control pull-right" id="txtorderdate" name="txtorderdate" value="<?php echo $per_orderDate;?>">
                            </div>
                        </div>
						</div>
						
						  <div class="col-md-6">
						 <div class="form-group" style="width:100%;">
                            <label for="txtcustomerName">Customer Name</label>
                                <input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName" value="<?php echo $per_orderCustomerName;?>">
                            </div>
						 </div>
						 </div>
						 
						  <div class="row">
                          <div class="col-md-6">
						 <div class="form-group" style="width:100%">
                            <label for="txtdepartment">Department</label>
                                <input type="text" class="form-control" id="txtdepartment" name="txtDepartment" value="<?php echo $per_orderDepartment;?>">
                            </div>
                        </div>

							</div>
                            </tr>
                            </table>
					</form>
                </div>
				<div class="modal-footer">
                   <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success" name="btnEdit">Save</button>
                </div>
        </div>
		</div>
		</div>
    </form>
<?php
}//end if
?>









