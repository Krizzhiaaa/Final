<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM returns INNER JOIN supplies ON supplies_id = supply_id INNER JOIN suppliers ON returns.supplier_id = suppliers.supplier_id JOIN purchase_orders ON supplies.supply_description = purchase_orders.description JOIN deliveries ON deliveries.po_key = purchase_orders.po_key WHERE return_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $order_no=$row[60];
        $supplier=$row[51];
        $delivered_by=$row[69];
        $delivery_id=$row[72];
    }//end while
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box" style="width: 1010px">
            <div class="box-header">
    <form class="form-horizontal" method="post" action="dashboard/returnItemFrom">
        <div class="modal-content" style="width: 990px">
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
                        <center><h4><b>Returning Item/s</b></h4></center>
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
                                    <input type="text" class="form-control" id="orderNum" name="orderNum" value="<?php echo $order_no; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%">
                                <label for="exampleInputEmail1">Delivery ID</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="deliveryID" value="<?php echo $delivery_id; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Supplier</label>
                                <div class="input-group">
                                    <div class="input-group-addon">       
                                        <i class="fa fa-group"></i>
                                    </div>
                                    <input type="text" class="form-control" name="supplier_name" value="<?php echo $supplier; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%">
                                <label for="exampleInputEmail1">Delivered By</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="deliveredBy" value="<?php echo $delivered_by; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Return Date & Time</label>
                                <div class="input-group">
                                    <div class="input-group-addon">       
                                        <i class="fa fa-group"></i>
                                    </div>
                                    <?php
                                    date_default_timezone_set("Asia/Manila"); 
                                    $date = date("Y-m-d H:i:s"); ?>
                                    <input type="text" class="form-control" name="returnDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                            $sql="SELECT * FROM returns INNER JOIN supplies ON supplies_id = supply_id INNER JOIN suppliers ON returns.supplier_id = suppliers.supplier_id JOIN purchase_orders ON supplies.supply_description = purchase_orders.description JOIN deliveries ON deliveries.po_key = purchase_orders.po_key WHERE return_id=$id";
                            $result = $con->query($sql);

                            $arraySupid = '';
                            $arrayReturn = '';
                            $arrayQtyDelivered = '';
                            $arrayQtyReturnedTo = '';
                            $arrayQtyReturnedFrom = '';
                            $arrayDescription = '';   
                            $arrayReturnStatus = '';
                            $arrayQtyStock = '';
                            $zero = 0;
                    ?>
                    <div class="row">
                        <div class="table-responsive">
                            <span id="error"></span>
                            <table class="table table-bordered" id="item_table">
                                <tr>
                                    <th width="6%"> ID</th>
                                    <th width="15%"> Qty Delivered</th>
                                    <th width="16.5%"> Qty Item Returned </th>
                                    <th width="16%"> Qty Item Replacement</th>
                                    <th width="52.5%"> Supply Description </th>
                                </tr>
                                <?php 
                                    if($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $arraySupid .= $row['supply_id'].', ';
                                            $arrayReturn .= $row['return_id'].', ';
                                            $arrayQtyDelivered .= $row['qty_delivered'].', ';
                                            $arrayQtyReturnedTo .= $row['quantity_returned'].', ';
                                            //$arrayQtyReturnedFrom .= $row['quantity_in_stock'].', ';  
                                            $arrayDescription.= $row['items_delivered'].', ';
                                            $arrayReturnStatus .= $row['return_status'].', ';
                                            $arrayQtyStock .= $row['quantity_in_stock'].', ';

                                            $supply_id = explode(", ", $arraySupid);
                                            $return_id = explode(", ", $arrayReturn);
                                            $qty_delivered = explode(", ", $arrayQtyDelivered);
                                            $return_to = explode(", ", $arrayQtyReturnedTo);
                                            //$return_from = explode(", ", $arrayQtyReturnedFrom);
                                            $description = explode(", ", $arrayDescription);
                                            $return_status = explode(", ", $arrayReturnStatus);
                                            $qty_stock = explode(", ", $arrayQtyStock);
                                        }
                                    
                                ?>
                                <tr>
                                    <!-- <?php 
                                        $count //= count($order_id)-1;
                                        //for ($x=0; $x < $count; $x++) { 
                                    ?> -->
                                    <td>
                                        <input type="number" id="supplyID" name="supplyID" style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" value="<?php print_r($supply_id[$zero]); ?>" readonly />
                                    </td>
                                    <td class="hidden">
                                        <input class="hidden" type="number" id="returnID" name="returnID" hidden style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" value="<?php print_r($return_id[$zero]); ?>" readonly />
                                    </td>
                                    <td class="hidden">
                                        <input class="hidden" type="number" id="qtyStock" name="qtyStock" hidden style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" value="<?php print_r($qty_stock[$zero]); ?>" readonly />
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" id="delivered" name="delivered" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" value="<?php print_r($qty_delivered[$zero]); ?>" readonly />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="returnTo" name="returnTo" value="<?php print_r($return_to[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" id="returnFrom" name="returnFrom" value="" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" max="<?php print_r($return_to[$zero]);?>" pattern="^[0-9]$" required/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="description" name="description" value="<?php print_r($description[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" class="form-control hidden" id="status" name="status" value="<?php print_r($return_status[$zero++]);?>" hidden style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;">
                                    </td>
                                </tr>
                                <?php 
                                   
                                }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-success" name="btnOrder"><i class="fa fa-undo"></i> Return</button>
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
