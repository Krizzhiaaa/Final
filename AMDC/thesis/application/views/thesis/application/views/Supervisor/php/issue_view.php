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
        $per_issueDate=$row[7];
        $per_issueTo=$row[8];
        $per_supplyName=$row[10];
        $per_supplyUnit=$row[11];
        $per_supplyQuantity=$row[12];

    }//end while
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
<div id="printThis">
    <form class="form-horizontal" method="post">
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
                        <center><h4><b>View Issued Supplies</b></h4></center>
                    </div>
                </div>
                <div class="box-body">                                      
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Supervisor Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $per_name ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Request Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_date;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Issued To</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                <input type="text" class="form-control" id="txtissue" name="txtissue" value="<?php echo $per_issueTo;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Issued Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo $per_issueDate;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </div>
                        </div>
                    </div>
                      <?php
                        $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supply_description=supply_name WHERE inventory_order_id=$id AND (quantity_issued !=0 OR quantity_issued IS NOT NULL)";
                        $result = $con->query($sql);    
                      ?>
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <tr>
                                 <th width="15%">Quantity Ordered</th>
                                 <th width="13%">Quantity Issued</th>
                                 <th width="16%">Unit</th>
                                <th width="52.5%">Item Description</th>
                               
                            </tr>
                            <?php if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['quantity'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </td>

                                <td width="30%"><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['quantity_issued'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">  
                                </td>

                               <td><input type="text" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo $row['unit'];?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">  
                                </td>

                                <td width="70%"><input class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $row['supply_name'];?>" readonly style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                </td>
                               
                            </tr>
                            <?php 
                            }
                        }?>
                        </table>
                </div>   
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <!-- <button type="submit" class="btn btn-primary" name="">Save</button> -->
            </div>
            </div> <!-- BOX-BODY -->
        </div>
    </form>
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








