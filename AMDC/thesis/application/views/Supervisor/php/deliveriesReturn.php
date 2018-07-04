<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) WHERE purchase_order_id=$id";
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


    }//end while
?>
<div id="printThis">
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
                                              <center><h4><b>Returns</b></h4></center>
                                            </div>
                                      </div>
                                        <div class="box-body">
                                        <div class="row hidden">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label hidden" for="txtid">Purchase Order ID</label>
                                                <div class="col-sm-6 hidden">
                                                    <input type="hidden" class="form-control hidden" id="txtid" name="txtid" hidden value="<?php echo $per_po_key;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                </div>
                                            </div>
                                          </div>
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

                                        <input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo $per_supplier;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                          </div>
                                              </div>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Purchase Order Date</label>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_orderDate;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
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
                                                      <input type="text" class="form-control" id="txtddate" name="txtddate" value="<?php echo $per_deliveryDate;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  </div>
                                                </div>
                                                </div>
                                                <div class="col-md-1"></div>

                                                <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Unique ID</label>
                                                    <div class="input-group">
                                                       <div class="input-group-addon">
                                                        <i class="fa fa-key"></i>
                                                      </div>
                                                      <input type="text" class="form-control" id="txtuniq" name="txtuniq" value="<?php echo $per_po_uniq_id;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
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
                                                <th>Qty Delivered</th>
                                                <th>Qty Ordered</th>
                                                <th>Qty Returned</th>
                                                <th>Reason</th>
            

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

                                              <td width="50px"><input type="text" class="form-control" id="txtquantitydelivered<?php echo $x; ?>" name="txtquantitydelivered<?php echo $x; ?>" value="<?php print_r($quantityDelivered[$zero]); ?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >  </td>
                                                            
                                              <td width="50px"><input type="text" class="form-control" id="txtquantity<?php echo $x; ?>" name="txtquantity<?php echo $x; ?>" value="<?php print_r($quantity[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>

                                              <td width="50px">
                                                <input type="text" class="form-control" id="txtreturn" name="txtreturn" value="" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>  
                                              </td>
                                              
                                              <td width="150px">
                                                <input type="text" class="form-control" id="txtnotes<?php echo $x; ?>" name="txtnotes<?php echo $x; ?>" value="" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">  
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
                      <button id="btnPrint" type="button" class="btn btn-danger" style="float:left;"><i class="fa fa-times-circle"></i>&nbsp;Cancel</button>
                      <button type="submit" class="btn btn-success" name="btnReturn"><i class="fa fa-undo"></i> Return</button>
                      <!-- <button type="submit" class="btn btn-primary" name="">Save</button> -->
                    </div>
                  </div>
                <!-- /.modal-dialog -->
                </div>
              <!-- end of Items FORM -->
              </form>
            </div>
<?php
}//end if
?>
<script>
document.getElementById("btnPrint").onclick = function () {
printElement(document.getElementById("printThis"));

window.print();
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    
    $printSection.appendChild(domClone);
}
</script>

<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>