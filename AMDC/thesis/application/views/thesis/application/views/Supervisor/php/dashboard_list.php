<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status != 'Fully Issued' AND inventory_order_status != '' AND quantity != 0 AND inventory_order_id = $id GROUP BY inventory_order_id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[1];
        $per_date=$row[2];
        $per_supplyName=$row[10];
        $per_supplyQuantity=$row[12];
        $per_qtyIssued=$row[13];
        $per_status=$row[5];
        $per_remarks=$row[6];

    }//end while
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <form name="plus_name" id="plus_name">
          <div class="box-header">
            <div class="modal-content">
              <div class="modal-header">
                <div class="col-md-2">
                  <img src="assets/dist/img/user3-128x128.png" alt="User Image" style="width:80px;height:80px;">
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
                    <center><h4><b>View Order List</b></h4></center>
                  </div>
                </div> 
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="txtid">Order ID</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-id-badge"></i>
                          </div>
                          <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Order Date</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" id="orDate" name="orDate" value="<?php echo $per_date ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    $sql="SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status != 'Fully Issued' AND inventory_order_status != '' AND quantity != 0 AND inventory_order_id = $id";
                    $result = $con->query($sql);
                  ?>

                  <div class="row">
                    <div class="table-responsive">
                      <span id="error"></span>
                      <table class="table table-bordered" id="dynamic_field">
                        <tr>
                          <th width="15%"> Qty Ordered </th>
                          <th width="52.5%"> Item Name </th>
                          <th width="16.5%"> Unit </th>
                          <th width="16%"> Qty Issued </th>
                        </tr>

                        <?php 
                          if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>

                          <td>
                            <input type="number" class="form-control" id="qty[]" name="qty[]" value ="<?php echo $row["quantity"];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                          </td>

                          <td>
                            <input type="text" class="form-control" id="supplyDesc[]" name="supplyDesc[]" value ="<?php echo $row["supply_name"];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                          </td>
                                                    
                          <td>
                            <input type="text" class="form-control" id="unitName[]" name="unitName[]" value ="<?php echo $row["unit_name"];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly> 
                          </td>

                          <td>
                            <input type="number" class="form-control" id="qtyIssued[]" name="qtyIssued[]" value ="<?php echo $row["quantity_issued"];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly >
                          </td>

                          <td class="hidden">
                            <input type="hidden" class="form-control hidden" id="remarks[]" name="remarks[]" value ="<?php echo $row["inventory_order_remarks"];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" hidden readonly> 
                          </td>
                        </tr>
                        <?php 
                            }
                          }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
              </div>
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