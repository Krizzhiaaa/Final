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
        $per_uniq_id=$row[0];
        $per_date=$row[2];
        $per_name=$row[3]; 
        $per_department=$row[4];
        $per_status=$row[5];
        $per_remarks=$row[6];
        $per_orderID=$row[9];

    }//end while
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box" style="overflow-y: scroll; max-height:85%;">
            <div class="box-header">
<div class="box-header">
        <div class="modal-content">
            <div id="printThis">
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
                                              <center><h4><b>View Order Details</b></h4></center>
                                            </div>
                                        </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="width: 100%">
                                    <label for="exampleInputEmail1">Ordered By</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $per_name; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $per_department; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtid">Order ID</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-id-badge"></i>
                                        </div>
                                        <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_orderID;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">
                                    </div>
                                </div>
                        
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date & Time</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="orDate" name="orDate" value="<?php echo $per_date ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                        </div>
                        <?php
                        $sql="SELECT * FROM inventory_order io JOIN inventory_order_supplies ios USING(inventory_order_uniq_id) JOIN supplies s ON s.supply_description=ios.supply_name WHERE inventory_order_id=$id AND quantity !=0";
                        $result = $con->query($sql);    
                      ?>
                      <div class="row">
                    <div class="table-responsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <tr>
                                <th width="15%"> Qty Ordered</th>
                                <?php if($per_status == 'Partially Issued'){ ?>
                                    <th width="15%"> Remaining Balance</th>
                                <?php } ?>
                                <th width="18%"> Unit </th>
                                <th width="30%"> Item Name </th>
                                <th width="17%"> Item Type </th>
                                <?php if($per_status == 'Partially Issued' || $per_status == 'Fully Issued'){ ?>
                                    <th width="16%"> Qty Issued </th>
                                <?php } ?>
                            </tr>
                            <?php if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['quantity'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">
                                </td>

                                <?php if($per_status == 'Partially Issued'){ ?>
                                <td>
                                    <input class="form-control" id="txtrem" name="txtrem" value="<?php echo $row['quantity_remaining'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">
                                </td>
                                <?php } ?>
                                            
                                <td><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['unit'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">  
                                </td>

                                <td><input class="form-control" id="txtunit" name="txtunit" value="<?php echo $row['supply_name'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">
                                </td>

                                <td><input type="text" class="form-control" id="txttype" name="txttype" value="<?php echo $row['supply_type'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">  
                                </td>
                                <?php if($per_status == 'Partially Issued' || $per_status == 'Fully Issued'){ ?>
                                <td>
                                    <input class="form-control" id="txtissued" name="txtissued" value="<?php echo $row['quantity_issued'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;  background-color: #f1f1f1;">
                                </td>
                                <?php } ?>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <!-- <button type="submit" class="btn btn-primary" name="">Save</button> -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
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








