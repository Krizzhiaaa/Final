<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 


if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join suppliers on purchase_orders.supplier = suppliers.company_name WHERE purchase_order_id=$id";
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
        $per_po_key=$row[12];
        $per_quantityDelivered=$row[13];
        $per_itemDeliveryRemarks=$row[14];
        $per_notes=$row[15];
        $per_purch_id=$row[16];
        $per_orderCreateDate=$row[17];        
        $per_purchOrderName=$row[18];
        $per_purchOrderStatus=$row[19];
        $per_purchOrderRemarks=$row[20];
        $per_gtotal=$row[21];
        $per_soft_deleted=$row[24];
        $per_sup_id=$row[25];


    }//end while
?>
<div class="row">
<div class="col-xs-1200">
<div class="box">
<div class="box-header">

<form class="form-horizontal" method="post">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-lg" style="width: 990px">
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
                                        <!-- end of modal header -->
                                      <div class="modal-body">
                                        <div class="box-header">
                                          <div class="margin">
                                              <center><h4><b>Check Deliveries</b></h4></center>
                                            </div>
                                        </div>
                                        <div class="box-body">                   
                                             <div class="form-group" style="width:100%">
                                                <label class="hidden" for="txtid">Purchase ID</label>
                                                    <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $per_purch_id;?>" readonly>
                                              </div>      
                                              <div class="row">
                                              <div class="col-md-5">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Name</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>
                                                  <input type="text" class="form-control" id="custName" name="custName" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </div>
                                              </div>
                                              </div>
                                              <div class="col-md-1">
                                              </div>

                                              <div class="col-md-5">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Supplier</label>
                                                   <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-group"></i>
                                                      </div>

                                        <input type="text" class="form-control" id="txtsupplier" name="txtsupplier" value="<?php echo $per_supplier;?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                        <input type="hidden" class="form-control" id="txtsupids" name="txtsupids" value="<?php echo $per_sup_id;?>" readonly>
                                          </div>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">

                                              <div class="col-md-5">
                                              <div class="form-group">
                                                 <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                    <label>Purchase Order Date</label>
                                                      <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_orderDate;?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-1">
                                                </div>


                                                <div class="col-md-5">
                                <div class="form-group">
                                    <label for="txtstatus">Status</label>
                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-toggle-on"></i>
                                                      </div>
                                        <input type="text" class="form-control" id="txtstatus" name="txtstatus" value="<?php echo $per_purchOrderStatus;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Delivery Date</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>

                                                      <input type="text" class="form-control" id="txtdeliverydate" name="txtdeliverydate" value="<?php echo $per_deliveryDate;?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-1">
                                                </div>
                                  <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Unique ID</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-key"></i>
                                                      </div>

                                                      <input type="text" class="form-control" id="txtuni" name="txtuni" value="<?php echo $per_po_uniq_id;?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  </div>
                                                </div>
                                              </div>
                            </div>
                                               <?php
                        $sql="SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join suppliers on purchase_orders.supplier = suppliers.company_name join supplies on supplies.supply_description = purchase_orders.description where purchase_order_id='$id' AND order_quantity != 0";
                        $result = $con->query($sql);
                        
                        $arrayPoId = '';
                        $arrayDesc = '';
                        $arrayUnit = '';
                        $arraySuppliesId = '';
                        $arrayQuantity = ''; 
                        $arrayStock = '';   
                        $arrayQuantityDelivered = '';   
                        $arrayUnitPrice = ''; 
                        $arraySupplier = '';
                        $arrayNotes = '';
                        $arraySup = '';
                        $arrayExpire = ''; 
                        $arrayExpiration = ''; 
                        $arrayType = '';
                        $arrayBrand = ''; 
                        $arraypokey = '';
                        $zero = 0;
                      ?>

                                          <div class="row">
                                        <div class="table-responsive">
                                          <span id="error"></span>
                                          <table class="table table-bordered" id="item_table" style="width:990px">
                                            <tr>
                                                <th class="hidden">ID</th>
                                                
                                               <th>Item Name</th>
                                               <th>Brand</th>
                                                <?php if ($per_itemDeliveryRemarks == 'Partial' ) {?>
                                                  <th>Quantity Remaining</th>
                                               <?php } else {?>
                                                  <th>Quantity Ordered</th>
                                               <?php } ?>
                                               <th>Quantity Delivered</th>
                                               <th>Unit Price</th>
                                               <th>Expiration Date</th>
            

                                              </tr>
                                              <?php if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { 
                                                  $arrayPoId .= $row['po_id'].', ';
                                                  $arrayDesc .= $row['description'].', ';
                                                  $arrayUnit .= $row['order_unit'].', ';
                                                  $arrayQuantity .= $row['order_quantity'].', ';   
                                                  $arrayQuantityDelivered .= $row['quantity_delivered'].', ';   
                                                  $arrayUnitPrice .= $row['unit_price'].', ';
                                                  $arraySupplier .= $row['supplier_id'].', ';
                                                  $arrayNotes .= $row['notes'].', ';
                                                  $arraySuppliesId .= $row['supply_id'].', ';
                                                  $arraySup .= $row['supplier'].', ';
                                                  $arrayStock .= $row['quantity_in_stock'].', ';
                                                  $arrayExpire .= $row['expiration_date'].', ';
                                                  $arrayExpiration .= $row['expiration_date'].', ';
                                                  $arrayType .= $row['supply_type'].', ';
                                                  $arrayBrand .= $row['brand_name'].', ';
                                                  $arraypokey .=  $row['po_key'].', ';
                                                  
                                                  $poid = explode(", ", $arrayPoId);
                                                  $desc = explode(", ", $arrayDesc);
                                                  $unit = explode(", ", $arrayUnit);
                                                  $quantity = explode(", ", $arrayQuantity);
                                                  $quantityDelivered = explode(", ", $arrayQuantityDelivered);
                                                  $unitPrice = explode(", ", $arrayUnitPrice);
                                                  $supplier = explode(", ", $arraySupplier);
                                                  $notes = explode(", ", $arrayNotes);
                                                  $supid = explode(", ", $arraySuppliesId);
                                                  $supp = explode(", ", $arraySup);
                                                  $stock = explode(", ", $arrayStock);
                                                  $exp = explode(", ", $arrayExpire);
                                                  $expired = explode(", ", $arrayExpiration);
                                                  $type = explode(", ", $arrayType);
                                                  $brand = explode(", ", $arrayBrand);
                                                  $pokey = explode(", ", $arraypokey);
                                                  }
                                                  
                                              ?>
                                            <!-- index 0 -->
                                            <tr>
                                              <?php 
                                              $countpoid = count($poid)-1;

                                              for($x=0; $x < $countpoid; $x++){
                                              ?>
                                              <td class="hidden">
                                              <input class="form-control" id="txtpoid<?php echo $x; ?>" name="txtpoid<?php echo $x; ?>" value="<?php print_r($poid[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>

                                              <td class="hidden">
                                              <input class="form-control" id="txtpokey<?php echo $x; ?>" name="txtpokey<?php echo $x; ?>" value="<?php print_r($pokey[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>

                                              <td class="hidden">
                                              <input class="form-control" id="txtsuppliesid<?php echo $x; ?>" name="txtsuppliesid<?php echo $x; ?>" value="<?php print_r($supid[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>

                                              <td class="hidden">
                                              <input class="form-control" id="txtsupplierid<?php echo $x; ?>" name="txtsupplierid<?php echo $x; ?>" value="<?php print_r($supplier[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>

                                              <td class="hidden">
                                              <input class="form-control" id="txtsupid<?php echo $x; ?>" name="txtsupid<?php echo $x; ?>" value="<?php print_r($supid[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>


                                              <td width="200px"><input class="form-control" id="txtdesc<?php echo $x; ?>" name="txtdesc<?php echo $x; ?>" value="<?php print_r($desc[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>

                                              <td width="175px"><input type="text" class="form-control" id="txtbrand<?php echo $x; ?>" name="txtbrand<?php echo $x; ?>" value="<?php echo($brand[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                            <?php if ($per_itemDeliveryRemarks == 'Partial' ) {?>
                                               <td width="100px"><input type="text" class="form-control" id="txtquantity<?php echo $x; ?>" name="txtquantity<?php echo $x; ?>" value="<?php print_r($quantity[$zero]-$quantityDelivered[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>

                                               <td width="100px"><input type="text" class="form-control" id="txtquantitydelivered<?php echo $x; ?>" name="txtquantitydelivered<?php echo $x; ?>" value="<?php print_r($quantityDelivered[$zero]); ?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>
                                               
                                               <?php }elseif ($per_itemDeliveryRemarks == '') {?>
                                               <td width="100px"><input type="text" class="form-control" id="txtquantity<?php echo $x; ?>" name="txtquantity<?php echo $x; ?>" value="<?php print_r($quantity[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>

                                                <td width="100px"><input type="text" class="form-control" id="txtquantitydelivered<?php echo $x; ?>" name="txtquantitydelivered<?php echo $x; ?>" value="<?php print_r($quantityDelivered[$zero]); ?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >  </td>
                                              <?php
                                               } ?>

                                            <td width="100px"><input type="text" id="unit_price<?php echo $x; ?>" name="unit_price<?php echo $x; ?>" class="form-control " value="&#8369 <?php print_r($unitPrice[$zero]); ?>" min="0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly> 
                                            </td>

                                              <td width="100px"><input type="text" class="form-control" id="txtexpiration<?php echo $x; ?>" name="txtexpiration<?php echo $x; ?>" value="<?php echo($expired[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                              <td class="hidden"><input type="text" class="form-control" id="txtexpire<?php echo $x; ?>" name="txtexpire<?php echo $x; ?>" value="<?php echo($exp[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                            <td class="hidden"><input class="form-control" id="txtsupplier<?php echo $x; ?>" name="txtsupplier<?php echo $x; ?>" value="<?php print_r($supp[$zero++]);?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                            </td>

                                            </tr>
                                            <?php } ?>
                                            <!-- end index 0 -->



                                            <?php 
                              }
                            
                          ?>


                                          </table>
                                        </div>
                                      

                                          </div>
                                        </div> <!-- BOX-BODY -->
                                        <div class="modal-footer">
                   <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                   <button type="submit" class="btn btn-success" name="btnEdit"><i class="fa fa-save"></i> Save</button>
                </div>
                                      <div>
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
            <!-- end of Items FORM -->
              </form>
              <?php
}//end if

?>