
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
        $qtyRem=$row[16];
        $ordrNo=$row[17];        
        $per_purch_id=$row[18];
        $per_orderCreateDate=$row[19];        
        $per_purchOrderName=$row[20];
        $per_purchOrderStatus=$row[21];
        $per_purchOrderRemarks=$row[22];
        $per_gtotal=$row[23];
        $pobmremarks=$row[25];
        $per_soft_deleted=$row[26];
        $per_sup_id=$row[27];


    }//end while
?>
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
                                              <center><h4><b>Delivery Form</b></h4></center>
                                            </div>
                                        </div>
                                        <div class="box-body">                   
                                             <div class="form-group" style="width:100%">
                                                <label class="hidden" for="txtid">Purchase ID</label>
                                                    <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $per_purch_id;?>" readonly>

                                                    <input type="hidden" class="form-control" id="txtpID" name="txtpID" value="<?php echo $per_po_key;?>" readonly>

                                                    <input type="hidden" class="form-control" id="txtstat" name="txtstat" hidden value="<?php echo $per_purchOrderStatus;?>" readonly>

                                                    <?php 
                                                    date_default_timezone_set("Asia/Manila");
                                                    $date = date("Y-m-d H:i:s"); ?>
                                                    <input type="hidden" class="form-control pull-right" name="orDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; " />
                                              </div>      
                                              <div class="row">
                                              <div class="col-md-5">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Purchasing Officer</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>
                                                  <input type="text" class="form-control" id="custName" name="custName" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
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

                                        <input type="text" class="form-control" id="txtsupplier" name="txtsupplier" value="<?php echo $per_supplier;?>" style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;">
                                        <input type="hidden" class="form-control" id="txtsupids" name="txtsupids" value="<?php echo $per_sup_id;?>" readonly>
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
                                                  
                                                      <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_orderDate;?>"  style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Delivery Date</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>

                                                      <?php 
                                                      date_default_timezone_set("Asia/Manila");
                                                      $date = date("Y-m-d H:i:s"); ?>
                                                      <input type="text" class="form-control" id="txtdeliverydate" name="txtdeliverydate" value="<?php echo $date;?>"  style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                                  </div>
                                                </div>
                                              </div>
                            
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Purchase Order No.</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-hashtag"></i>
                                                      </div>

                                                      <input type="text" class="form-control" id="txtordr" name="txtordr" value="<?php echo $ordrNo;?>"  style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1; border-bottom: 1px solid black;" required>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="col-md-1">
                                                </div>
<!--
                                  <?php
//                                    $sqldelby="SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join suppliers on purchase_orders.supplier = suppliers.company_name join deliveries using (po_id) WHERE purchase_order_id=$id";
//                                    $run_sqldelby=mysqli_query($con,$sqldelby);
//                                    while($row=mysqli_fetch_array($run_sqldelby)){
//                                        $per_courier=$row[43];
//                                    }//end while
    
//                                    if($per_courier == '' || $per_courier == NULL){
                                  ?>
-->
                                  <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Delivered By</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>

                                                      <input type="text" class="form-control" id="txtdelBy" name="txtdelBy" value=""  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                                  </div>
                                                </div>
                                              </div>
<!--
                                  <?php
//                            }else{
                            ?>
-->
<!--
                                  <div class="col-md-5">
                                              <div class="form-group">
                                                    <label>Delivered By</label>
                                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>

                                                      <input type="text" class="form-control" id="txtdelBy" name="txtdelBy" value="<?php //echo $per_courier;?>"  style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" required>
                                                  </div>
                                                </div>
                                              </div>
-->
                                  
<!--
                                  <?php
//                            }
                            ?>
-->
                            </div>
                            
                            <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-group">
                                      <label>Delivery ID</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                          </div>
                                                <?php 
                                $conn=mysqli_connect("localhost","root","");
                                      mysqli_select_db($conn, "itproject");
                                $query_ord = "SELECT * FROM deliveries GROUP BY delivery_id";
                                $resulty = $conn->query($query_ord);
                                date_default_timezone_set('Asia/Manila');
                                $date = date("mdY");
                                $counter = 0 ;
                                $rand = substr(uniqid('', true), -5);
                                if ($resulty->num_rows > 0) {
                                  while($row = $resulty->fetch_assoc()) {
                                        $order = $row["delivery_order_id"];
                                        $order2 = $row["delivery_id"];
                                  }
                                  $counter1 = $order2+1; 
                                  ?>
                                  <input type="text" class="form-control" id="DelID" name="DelID" value="<?php echo 'D'.$date.'-'.$counter1; ?>" style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1; border-bottom: 1px solid black;" >
                                  <?php }else{ ?>
                                  <input type="text" class="form-control" id="DelID" name="DelID" value="<?php echo 'D'.$date.'-'.$counter; ?>" style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1; border-bottom: 1px solid black;" >
                                  <?php } ?>
                                                      
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="col-md-1">
                                                </div>                       
                                  
                                              <?php
                            if($per_quantityDelivered != ''){
                            ?>
                                                <div class="col-md-5">
                                <div class="form-group">
                                    <label for="txtstatus">Status</label>
                                     <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-toggle-on"></i>
                                                      </div>
                                        <input type="text" class="form-control" id="txtstatus" name="txtstatus" value="<?php echo $per_purchOrderStatus;?>" readonly style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;">
                                      </div>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            

                            </div>
                                                                           <?php
                        $sql="SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join supplies on description = supply_description join suppliers on supplier = company_name where purchase_order_uniq_id='$per_po_uniq_id' AND purchase_order_id='$id' AND order_quantity != 0 GROUP BY supply_description";
                        //SELECT * FROM supplies join suppliers on supplies.suppliers_id = suppliers.supplier_id join purchase_orders on purchase_orders.supplier = suppliers.company_name join purchase_order_bm USING(purchase_order_uniq_id)
                        //SELECT * FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join suppliers on purchase_orders.supplier = suppliers.company_name join supplies on supplies.supply_description = purchase_orders.description where purchase_order_uniq_id='$per_po_uniq_id' AND purchase_order_id='$id' AND order_quantity != 0
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
                        $arrayLot = '';
                        $arrayRem = '';
                        $arraySupName = '';
                        $arrayCat = '';
                        $zero = 0;
                      ?>

                                          <div class="row">
                                        <div class="table-responsive">
                                          <span id="error"></span>
                                          <table class="table table-bordered" id="item_table" style="width:990px">
                                            <tr>
                                                <th class="hidden">ID</th>
                                                
                                               <th width="8%">Lot No.</th>
                                               <?php if ($pobmremarks == 'Partial' ) {?>
                                                  <th width="5%">Quantity Remaining</th>
                                               <?php } else {?>
                                                  <th width="5%">Qty Ordered</th>
                                               <?php } ?>
                                               <th width="5%">Qty Delivered</th>
                                               <th width="20%">Supply Description</th>
                                               <th width="8%">Brand</th>
                                               <th width="8%">Unit Price &#8369; </th>
                                               <th width="8%">Expiration Date</th>
            

                                              </tr>
                                              <?php if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { 
                                                  $arrayPoId .= $row['po_id'].', ';
                                                  $arrayDesc .= $row['description'].', ';
                                                  $arrayUnit .= $row['unit'].', ';
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
                                                  $arrayLot .=  $row['lot_no'].', ';
                                                  $arrayRem .=  $row['quantity_remaining'].', ';
                                                  $arraySupName .=  $row['item_name'].', ';
                                                  $arrayCat .=  $row['category'].', ';
                                                  
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
                                                  $lot = explode(", ", $arrayLot);
                                                  $rem = explode(", ", $arrayRem);
                                                  $supname = explode(", ", $arraySupName);
                                                  $cat = explode(", ", $arrayCat);
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
                                             
                                              <td>
                                               <input class="form-control" id="txtlot<?php echo $x; ?>" name="txtlot<?php echo $x; ?>" value="<?php print_r($lot[$zero]);?>"  style="border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                              </td>

                                              <?php if ($pobmremarks == 'Partial' ) {?>
                                               <td width="100px"><input type="text" class="form-control" id="txtquantity<?php echo $x; ?>" name="txtquantity<?php echo $x; ?>" value="<?php print_r($rem[$zero]); ?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>  </td>

                                               <td width="100px"><input type="number" class="form-control" id="txtquantitydelivered<?php echo $x; ?>" name="txtquantitydelivered<?php echo $x; ?>" value="<?php print_r($quantityDelivered[$zero]); ?>" min="1" max="<?php print_r($rem[$zero]); ?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">  </td>

                                               <td width="200px"><input class="form-control" id="txtdesc<?php echo $x; ?>" name="txtdesc<?php echo $x; ?>" value="<?php print_r($desc[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                              </td>

                                              <td width="175px"><input type="text" class="form-control" id="txtbrand<?php echo $x; ?>" name="txtbrand<?php echo $x; ?>" value="<?php echo($brand[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                              </td>

                                            <td width="100px"><input type="text" id="unit_price<?php echo $x; ?>" name="unit_price<?php echo $x; ?>" class="form-control " value="<?php print_r($unitPrice[$zero]); ?>" min="0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"> 
                                            </td>
                                            <?php 
                                            date_default_timezone_set("Asia/Manila");
                                            $date = date('Y-m-d');
                                            $effectiveDate = date('Y-m-d', strtotime("+3 months")); ?>
                                              <td width="100px"><input type="text" class="form-control datepicker"  name="txtexpiration<?php echo $x; ?>" id="txtexpiration<?php echo $x; ?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" value="" placeholder="<?php print_r($expired[$zero]); ?>" readonly>
                                              </td>
                                               
                                               <?php }elseif ($per_itemDeliveryRemarks == '') {?>
                                               <td width="100px"><input type="text" class="form-control" id="txtquantity<?php echo $x; ?>" name="txtquantity<?php echo $x; ?>" value="<?php print_r($quantity[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>  </td>

                                                <td width="100px"><input type="number" class="form-control" id="txtquantitydelivered<?php echo $x; ?>" name="txtquantitydelivered<?php echo $x; ?>" value="<?php print_r($quantityDelivered[$zero]); ?>" min="1" max="<?php print_r($quantity[$zero]);?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >  </td>

                                                <td width="200px"><input class="form-control" id="txtdesc<?php echo $x; ?>" name="txtdesc<?php echo $x; ?>" value="<?php print_r($desc[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                              </td>

                                              <td width="175px"><input type="text" class="form-control" id="txtbrand<?php echo $x; ?>" name="txtbrand<?php echo $x; ?>" value="<?php echo($brand[$zero]);?>"  style="width: 100%; border: 0; outline: 0;  background: transparent; background-color: #f1f1f1;" readonly>
                                              </td>

                                            <td width="100px"><input type="text" id="unit_price<?php echo $x; ?>" name="unit_price<?php echo $x; ?>" class="form-control " value="<?php print_r($unitPrice[$zero]); ?>" min="0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"> 
                                            </td>

                                            <?php 
                                            date_default_timezone_set("Asia/Manila");
                                            $date = date('Y-m-d');
                                            $effectiveDate = date('Y-m-d', strtotime("+3 months")); ?>
                                            <!-- date('Y-m-d', strtotime("+3 months")) -->
                                              <td width="100px"><input type="text" class="form-control datepicker"  name="txtexpiration<?php echo $x; ?>" id="txtexpiration<?php echo $x; ?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" value="" readonly>
                                              </td>
                                              <?php
                                               } ?>
                                               <script>
                                              jQuery(function() {
                                                var datepicker = $('input.datepicker');
                                                var dateToday = new Date();
                                                var effectiveDate = <?php echo(json_encode($effectiveDate)); ?>;
                                                if (datepicker.length > 0) {
                                                  datepicker.datepicker({
                                                    format: "yyyy-mm-dd",
                                                    startDate: effectiveDate,
                                                    minDate: effectiveDate
                                                  });
                                                }
                                              });
                                              </script>

                                               <td class="hidden"><input type="text" class="form-control" id="txtiname<?php echo $x; ?>" name="txtiname<?php echo $x; ?>" value="<?php print_r($supname[$zero]); ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                               <td class="hidden"><input type="text" class="form-control" id="txttype<?php echo $x; ?>" name="txttype<?php echo $x; ?>" value="<?php print_r($type[$zero]); ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                              <td class="hidden"><input type="text" class="form-control" id="txtcat<?php echo $x; ?>" name="txtcat<?php echo $x; ?>" value="<?php print_r($cat[$zero]); ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>


                                               <td class="hidden"><input type="text" class="form-control" id="txtunit<?php echo $x; ?>" name="txtunit<?php echo $x; ?>" value="<?php print_r($unit[$zero]); ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                              </td>

                                              <td class="hidden"><input type="text" class="form-control" id="txtexpire<?php echo $x; ?>" name="txtexpire<?php echo $x; ?>" value="<?php print_r($expired[$zero]); ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
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
    </div>
            <!-- end of Items FORM -->
              </form>
              <?php
}//end if

?>
<script>
// date and time
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true
    })
      
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<script>
 // date and time 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#txtexpiration0').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
    //Date picker
    $('#txtexpiration0').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
    //Timepicker
   /* $('.timepicker').timepicker({
      showInputs: false,
      format    : '%h:%i:%s %p'
    }) */
  }) 
</script>