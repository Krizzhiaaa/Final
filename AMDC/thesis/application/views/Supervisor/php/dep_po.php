<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE inventory_order_id=$id AND quantity !=0";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_uniqid=$row[0];
        $per_id=$row[1];
        $per_date=$row[2];
        $per_name=$row[3];
        $per_department=$row[4];
        $per_status=$row[5];
        $per_remarks=$row[6];
        $per_issuedDate=$row[7];
        $per_inventorySupid=$row[8];
        $per_supplyName=$row[9];
        $per_supplyUnit=$row[10];
        $per_supplyQuantity=$row[11];
        $per_quantityIssued=$row[12];
        $per_supplyID=$row[13];
        $per_supplyType=$row[14];
        $per_supplyDesc=$row[15];
        $per_brandName=$row[16];
        $per_unit=$row[17];
        $per_quantityStock=$row[18];
        $per_unitPrice=$row[19];
        $per_unitOrder=$row[20];
        $per_reorderLevel=$row[21];
        $per_expiration=$row[22];

    }//end while
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
    <form class="form-horizontal" method="post" action="purchases/addPurchases">
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
            <div class="modal-body">
                <div class="box-header">
                    <div class="margin">
                        <center><h4><b>Department's Purchase Order Form</b></h4></center>
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group hidden">
                            <label class="col-sm-4 control-label hidden" for="txtid">Order ID</label>
                            <div class="col-sm-6 hidden">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="col-sm-4 control-label hidden" for="txtuniqid">Order Unique ID</label>
                            <div class="col-sm-6 hidden">
                                <input type="hidden" class="form-control" id="txtuniqid" name="txtuniqid" hidden value="<?php echo $per_uniqid;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="col-sm-8 control-label hidden" for="txtstatus"></label>
                            <div class="col-sm-1 hidden">
                                <input type="hidden" class="form-control" id="txtstatus" name="txtstatus" hidden value="<?php echo $per_status;?>" readonly>
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
                                        <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $per_name ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" margin="0px auto" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                        <input type="text" class="form-control" id="deptName" name="deptName" value="<?php echo $per_department;?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">       
                                            <i class="fa fa-group"></i>
                                        </div>
                                        <select class="form-group select2" name="supp" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                            <option value="">Select a Supplier</option>
                                                <?php
                                                $conn =mysqli_connect("localhost","root","");
                                                mysqli_select_db($conn, "itproject");
                                                $sql = "SELECT * FROM suppliers";
                                                $results = mysqli_query($conn, $sql);

                                                foreach($results as $supplier) { 
                                                ?>
                                            <option value="<?php echo $supplier["company_name"]; ?>" name="supp"><?php echo $supplier["company_name"]; ?></option>
                                                <?php 
                                                  }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purchase Order Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?php $date = date("Y-m-d"); ?>
                                        <input type="text" class="form-control" name="orDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                    </div>
                                                    <!-- /.input group -->
                                </div>
                            </div>
                        </div>

                        <?php 
                                $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE inventory_order_id=$id AND quantity !=0 AND (quantity_in_stock = 0 OR quantity_in_stock IS NULL) ";
                                $result = $con->query($sql);

                                $arrayOrdId = '';
                                $arrayOrdUniqId = '';
                                $arrayStatus = '';
                                $arraySupervisor = '';   
                                $arrayQtyStock = '';   
                                $arrayDesc = '';
                                $arrayQtyOrdered = '';
                                $arrayQtyIssued = '';
                                $arrayInventory = '';
                                $zero = 0;
                        ?>
                        <div class="row">
                            <div class="table-responsive">
                                <span id="error"></span>
                                <table class="table table-bordered" id="item_table">
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Item Description</th>
                                    </tr>
                                    <?php 
                                        if($result->num_rows > 0){
                                            while ($row = $result->fetch_assoc()) {
                                                $arrayOrdId .= $row['inventory_order_id'].', ';
                                                $arrayOrdUniqId .= $row['inventory_order_uniq_id'].', ';
                                                $arrayStatus .= $row['inventory_order_status'].', ';
                                                $arraySupervisor .= $row['inventory_order_name'].', ';   
                                                $arrayQtyStock .= $row['quantity_in_stock'].', ';   
                                                $arrayDesc .= $row['supply_name'].', ';
                                                $arrayQtyOrdered .= $row['quantity'].', ';
                                                $arrayQtyIssued .= $row['quantity_issued'].', ';
                                                $arrayInventory .= $row['inventory_order_supplies_id'].', ';

                                                $order_id = explode(", ", $arrayOrdId);
                                                $order_uniqid = explode(", ", $arrayOrdUniqId);
                                                $status = explode(", ", $arrayStatus);
                                                $supervisor = explode(", ", $arraySupervisor);
                                                $qty_stock = explode(", ", $arrayQtyStock);
                                                $item_desc = explode(", ", $arrayDesc);
                                                $qty_ordered = explode(", ", $arrayQtyOrdered);
                                                $qty_issued = explode(", ", $arrayQtyIssued);
                                                $inventory_supid = explode(", ", $arrayInventory);

                                            }
                                        
                                    ?>
                                    <tr>
                                        <?php 
                                            $count = count($order_id)-1;
                                            for ($x=0; $x < $count; $x++) { 
                                        ?>
                                        <td width="100px">
                                            <input class="form-control" type="number" id="number" name="number[]" min="1" pattern="^[0-9]$" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required />
                                        </td>
                                        <td width="250px">
                                            <input type="text" class="form-control" id="supply" name="neym[]" value="<?php print_r($item_desc[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                        </td>

                                        <td class="hidden">
                                            <input type="hidden" class="form-control hidden" id="status" name="status" value="<?php print_r($status[$zero++]);?>" hidden style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                        </td>

                                    </tr>
                                    <?php 
                                     }   
                                    }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-success" name="btnOrder"><i class="fa fa-shopping-cart"></i> Order</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
<?php
}//end if
?>
