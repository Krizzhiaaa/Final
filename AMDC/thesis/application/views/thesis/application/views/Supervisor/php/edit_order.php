<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_id=$id GROUP BY inventory_order_id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[1];
        $per_date=$row[2];
        $per_name=$row[3];
        $per_department=$row[4];
        $per_status=$row[5];
        $per_remarks=$row[6];
        $per_supplyName=$row[8];
        $per_supplyUnit=$row[9];
        $per_supplyQuantity=$row[10];


    }//end while
?>
    <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
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
            <div class="modal-body">
                <div class="box-header">
                    <div class="margin">
                        <center><h4><b>Departments Order Form</b></h4></center>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row" margin="0px auto">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="hidden" for="exampleInputEmail1">Order ID</label>
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Supervisor Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $per_name; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Date</label>
                                <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_date;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                            </div>
                        </div>
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtstatus">Status</label>
                                <input type="text" class="form-control" id="txtstatus" name="txtstatus" value="<?php echo $per_status;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                            </div>
                        </div>
                    </div>
                      <?php
                        $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_id=$id AND quantity !=0";
                        $result = $con->query($sql);    
                      ?>
                    <div class="table-responsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <tr>
                                <th>Item Description</th>
                                <th>Unit of Measure</th>
                                <th>Quantity</th>
                            </tr>
                            <?php if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) { 
                            ?>
                            <tr>
                                <td width="150"><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['supply_name'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </td>

                                <td width="100"><input class="form-control" id="txtunit" name="txtunit" value="<?php echo $row['unit_name'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </td>
                                            
                                <td width="50"><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['quantity'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">  
                                </td>
                            </tr>
                            <?php 
                            }
                        }?>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="txtremarks" name="txtremarks" value="<?php echo $per_remarks; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div> <!-- BOX-BODY -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary" name="btnEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </form>

<?php
}//end if
?>









