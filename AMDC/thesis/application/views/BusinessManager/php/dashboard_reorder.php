<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE supply_id=$id";
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
        $per_orderID=$row[9];
        $per_supplyName=$row[11];
        $per_supplyUnit=$row[12];
        $per_supplyQuantity=$row[13];
        $per_quantityIssued=$row[14];
        $per_quantityRem=$row[15];
        $per_supplyID=$row[16];
        $per_supplyType=$row[17];
        $per_supplyDesc=$row[18];
        $per_brandName=$row[19];
        $per_unit=$row[20];
        $per_quantityStock=$row[21];
        $per_unitPrice=$row[22];
        $per_unitOrder=$row[23];
        $per_reorderLevel=$row[24];
        $per_expiration=$row[25];

    }//end while
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
    <form class="form-horizontal" method="post" action="BusinessManager/purchases/addPurchases">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <div class="col-md-2">
                    <img src="assets/dist/img/user3-128x128.png" alt="User Image" style="width:80px;height:80px;">
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
                        <center><h4><b>Reorder Supplies Form</b></h4></center>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%">
                                <label for="exampleInputEmail1">Purchasing Officer</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" id="custName" name="custName" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" margin="0px auto" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Purchase Order No.</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-hashtag"></i>
                                    </div>
                                    <?php 
                                    $conn=mysqli_connect("localhost","root","");
                                        mysqli_select_db($conn, "itproject");
                                    $query_ord = "SELECT * FROM purchase_orders JOIN purchase_order_bm USING(purchase_order_uniq_id) GROUP BY purchase_order_id";
                                    $resulty = $conn->query($query_ord);
                                    date_default_timezone_set('Asia/Manila');
                                    $date = date("mdY");
                                    $counter = 0 ;
                                    if ($resulty->num_rows > 0) {
                                        while($row = $resulty->fetch_assoc()) {
                                            $order = $row["order_no"];
                                            $order2 = $row["purchase_order_id"];
                                        }
                                        $counter1 = $order2+1; 
                                    ?>
                                    <input type="text" class="form-control" id="orderNum" name="orderNum" value="<?php echo 'PO'.$date.'-'.$counter1; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    <?php }else{ ?>
                                    <input type="text" class="form-control" id="orderNum" name="orderNum" value="<?php echo 'PO'.$date.'-'.$counter; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%">
                                <label for="exampleInputEmail1">Supplier</label>
                                <div class="input-group">
                                    <div class="input-group-addon">       
                                        <i class="fa fa-group"></i>
                                    </div>
                                    <select class="form-control select2" name="supp" id="supp"  required>
                                        <option value="">Select a Supplier</option>
                                            <?php
                                            $conn =mysqli_connect("localhost","root","");
                                            mysqli_select_db($conn, "itproject");
                                            $sql = "SELECT * FROM suppliers WHERE supplier_status = 'Active'";
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Purchase Order Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php
                                    date_default_timezone_set("Asia/Manila"); 
                                    $date = date("Y-m-d H:i:s"); ?>
                                    <input type="text" class="form-control" name="orDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>

                    <?php 
                            $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies WHERE supply_id=$id GROUP BY supply_description";
                            $result = $con->query($sql);
                            $arrayOrdId = '';
                            $arrayOrdUniqId = '';
                            $arrayStatus = '';
                            $arraySupervisor = '';   
                            $arrayQtyStock = '';   
                            $arrayDesc = '';
                            $arrayUnit = '';
                            $arrayType = '';
                            $zero = 0;
                    ?>
                    <div class="row">
                        <div class="table-responsive">
                            <span id="error"></span>
                            <table class="table table-bordered" id="item_table">
                                <tr>
                                    <th width="15%"> Qty to be Ordered </th>
                                    <th width="52.5%"> Description </th>
                                    <th width="16%"> Unit </th>
                                    <th width="16.5%"> Item Type </th>
                                </tr>
                                <?php 
                                    if($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $arrayOrdId .= $row['inventory_order_id'].', ';
                                            $arrayOrdUniqId .= $row['inventory_order_uniq_id'].', ';
                                            $arrayStatus .= $row['inventory_order_status'].', ';
                                            $arraySupervisor .= $row['inventory_order_name'].', ';   
                                            $arrayQtyStock .= $row['quantity_in_stock'].', ';   
                                            $arrayDesc .= $row['supply_description'].', ';
                                            $arrayUnit .= $row['unit'].', ';
                                            $arrayType .= $row['supply_type'].', ';
                                            $order_id = explode(", ", $arrayOrdId);
                                            $order_uniqid = explode(", ", $arrayOrdUniqId);
                                            $status = explode(", ", $arrayStatus);
                                            $supervisor = explode(", ", $arraySupervisor);
                                            $qty_stock = explode(", ", $arrayQtyStock);
                                            $item_desc = explode(", ", $arrayDesc);
                                            $unit = explode(", ", $arrayUnit);
                                            $type = explode(", ", $arrayType);
                                        }
                                    
                                ?>
                                <tr>
                                    <?php 
                                        $count = count($order_id)-1;
                                        for ($x=0; $x < $count; $x++) { 
                                    ?>
                                    <td>
                                        <?php 
                                        if($qty_stock[$zero] == 0) { 
                                            $number = 500;
                                        } else{ 
                                            $number = 500-$qty_stock[$zero];
                                        }?>
                                        <input class="form-control" type="number" id="number" name="number[]"  min="1" pattern="^[0-9]$" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;"  
                                        value="<?php echo $number; ?>"
                                        readonly
                                        />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="supply" name="neym[]" value="<?php print_r($item_desc[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="unit" name="unit[]" value="<?php print_r($unit[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="type" name="type[]" value="<?php print_r($type[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" class="form-control hidden" id="status" name="status" value="<?php print_r($status[$zero++]);?>" hidden style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;">
                                    </td>
                                </tr>
                                <?php 
                                    }   
                                }?>
                            </table>
                        </div>
                    </div>
                </div>
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
