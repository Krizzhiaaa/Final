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
<div class="row">
<div class="col-1200">
<div class="box">
<div class="box-header">

<div id="printThis">
<form class="form-horizontal" method="post">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-lg" style="width: 900px">
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
                                              <center><h4><b>View Deliveries</b></h4></center>
                                            </div>
                                      </div>
                                        <div class="box-body">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="hidden" class="col-sm-4 control-label" for="txtid">Purchase Order ID</label>
                                                <div class="col-sm-6">
                                                    <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_po_key;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
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


                                              </div>
                                               <?php
                        $sql="select * from purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) where purchase_order_id = $id AND order_quantity != 0";
                        $result = $con->query($sql);    
                      ?>

                                          <div class="row">
                                        <div class="table-responsive">
                                          <span id="error"></span>
                                          <table class="table table-bordered" id="item_table">
                                            <tr>
                                               <th>Item Name</th>
                                               <th>Quantity Ordered</th>
                                               <th>Quantity Delivered</th>
                                               <th>Unit Price</th>
                                               <th>Total Amount</th>
                                              </tr>
                                              <?php if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>
                                            <tr>

                                              <td width="250"><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['description'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            
                                            <td width="50"><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['order_quantity'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>

                                            <td width="50"><input type="text" class="form-control" id="txtquantitydelivered" name="txtquantitydelivered" value="<?php echo $row['quantity_delivered']; ?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>  </td>

                                            <td width="50"><input type="text" name="unit_price" class="form-control " value="&#8369 <?php echo $row['unit_price']; ?>" min="0" style="width: 75px; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly /> </td>

                                            <td width="100"><input type="text" name="total" class="form-control " min="0" style="width: 100px; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"  value="&#8369 <?php echo $row['total'] ?>" readonly/> </td>
                                            

                                            <?php 
                              }
                            }
                          ?>


                                          </table>
                                       <div class="row" >
                                       <div class="col-md-7">
                                       </div>
                                               <div class="col-md-4">
                                              <div class="form-group">
                                                    <label>Grand Total</label>
                                                      <input type="text" class="form-control pull-right" id="poid" name="poid" value="&#8369 <?php echo $per_gtotal ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; "  readonly />
                                                    <!-- /.input group -->
                                                  </div>
                                                </div>
                                          </div>

                                        </div>
                                      

                                          </div>
                                        </div> <!-- BOX-BODY -->
                                        <div class="modal-footer">
                                            <button id="btnPrint" type="button" class="btn btn-success" style="float:left;"><i class="glyphicon glyphicon-print"></i>&nbsp;Print</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <!-- <button type="submit" class="btn btn-primary" name="">Save</button> -->
            </div>
                                      <div>
                                    </div>
                                    <!-- /.modal-content -->
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