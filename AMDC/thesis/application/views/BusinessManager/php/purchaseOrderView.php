
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
        $per_purch_id=$row[12];
        $per_qtyDelivered=$row[13];
        $per_delRemarks=$row[14];
        $per_notes=$row[15];
        $per_id=$row[16];
        $per_createdDate=$row[17];
        $per_orderName=$row[18];  
        $per_status=$row[19]; 
        $per_purchRemarks=$row[20];
        $per_gtotal=$row[21];
        $per_key=$row[22];
        $per_itemdelRemarks=$row[23];
        $per_soft_deleted=$row[24];
        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d H:i:s");

    }//end while
?>
<div id="printThis">
<form class="form-horizontal" method="post">
    <div class="modal-dialog">
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
                                          <div class="margin">
                                              <center><h4><b>View Purchase Order Details</b></h4></center>
                                            </div>
                                        <!-- end of modal header -->
                                          
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
                                                  <div class="form-group" style="width: 100%">
                                                      <label for="exampleInputEmail1">Purchase Order No.</label>
                                                      <div class="input-group">
                                                        <div class="input-group-addon">
                                                          <i class="fa fa-hashtag"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="orderNum" name="orderNum" value="<?php echo $per_createdDate; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                            <div class="row">
                                              <div class="col-md-6">
                                              <div class="form-group" style="width: 100%;">
                                                <label for="exampleInputEmail1">Supplier</label>
                                                <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-group"></i>
                                                      </div>
                                             
                                        <input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo $per_supplier;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;">
                                            </div>
                                              </div>
                                              </div>
                                                
                                                <div class="col-md-6">
                                              <div class="form-group" style="width: 100%;">
                                                  <label>Purchase Order Date</label>
                                                <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                  
                                                      <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_orderDate;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            

                          </div>
                        
                        <?php
                        $sql="select * from purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) join supplies on description = supply_description where purchase_order_id = $id AND order_quantity != 0 GROUP BY lot_no";
                        $result = $con->query($sql);    
                      ?>
                                        <div class="table-responsive">
                                          <span id="error"></span>
                                          <table class="table table-bordered" id="item_table">
                                            <tr>
                                               <th width="15%"> Qty </th>
                                              <th width="18%"> Unit </th>
                                              <th width="50%"> Item Desciption </th>
                                              </tr>
                                              <?php if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                
                                              <td width="100px"><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['order_quantity'];?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>  </td>
                                                
                                              <td width="100px"><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['unit'];?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>  </td>
                                                
                                              <td width="200px"><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['description'];?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                              </td>
                                            
                                            
                                            </tr>

                                            <?php 
                              }
                            }
                          ?>


                                          </table>
                                          </div>
                                        </div> <!-- BOX-BODY -->
                  <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <!-- <button type="submit" class="btn btn-primary" name="">Save</button> -->
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