
 <?php 
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
 function supply_dropdown($connect)
{ 
 $output = '';
 $query = "SELECT * FROM supplies WHERE soft_deleted= 'N' AND supply_description != '' AND (dep_name = '".$_SESSION['dept_name']."' OR dep_name = '') ORDER BY supply_description ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
    $output .= '<option value="'.$row["supply_description"].'">'.$row["supply_description"].'</option>';
 }
 return $output;
}
?>
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
<div class="row" >
    <div class="col-xs-12">
        <div class="box" style="overflow-y: scroll; max-height:85%;">
            <div class="box-header">
<form name="plus_name" id="plus_name" method="post" action="order/updateItem">
<div class="box-header">
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
                                              <center><h4><b>Update Order Details</b></h4></center>
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
                                        <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_orderID;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;">
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
                                    <input type="text" class="form-control" id="orDate" name="orDate" value="<?php echo $per_date ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                                <div class="form-group">
                                    <label hidden>Order UNIQ ID</label>
                                    <div class="input-group">
                                        <input  type="hidden" class="form-control" id="uniq_ID" name="uniq_ID" value="<?php echo $per_uniq_id;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                        
                            </div>
                        </div>
                        

                        
                        <?php
                        $sql="SELECT * FROM inventory_order io JOIN inventory_order_supplies ios USING(inventory_order_uniq_id) JOIN supplies s ON s.supply_description=ios.supply_name WHERE inventory_order_id=$id AND quantity !=0";
                        $result = $con->query($sql);    

                        $arrayOrdId = '';
                        $arrayQuantity = '';
                        $arrayName = '';
                        $arrayUnit = '';
                        $arrayType = '';
                        $arrayRemarks = '';
                        $zero = 0;
                      ?>

                      <div class="row">
                    <div class="table-responsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <th style="display: none;">ID</th>
                                <th width="15%"> Qty </th>
                                <th width="18%"> Unit </th>
                                <th width="50%"> Item Name </th>
                                <th width="17%"> Item Type </th>
                            </tr>

                            <?php if($result->num_rows > 0) {
                                    while($row =$result->fetch_assoc()) {
                                      $arrayOrdId .= $row['inventory_order_supplies_id'].', ';
                                      $arrayQuantity .= $row['quantity'].', ';
                                      $arrayUnit .= $row['unit'].', ';
                                      $arrayName .= $row['supply_name'].', ';
                                      $arrayType .= $row['supply_type'].', ';
                                      $arrayRemarks.= $row['supply_remarks'].', ';


                                      $order_id = explode(", ", $arrayOrdId);
                                      $quantity = explode(", ", $arrayQuantity);
                                      $unit = explode(", ", $arrayUnit);
                                      $item_name = explode(", ", $arrayName);
                                      $item_type = explode(", ", $arrayType);
                                      $remarks = explode(", ", $arrayRemarks);
                                    }
                            ?>
                            <tr>
                              <?php 
                                        $count = count($order_id)-1;
                                        for ($x=0; $x < $count; $x++) { 
                                    ?>
                                <td style="display: none;"><input class="form-control" id="ID[]" name="ID[]" value="<?php print_r($order_id[$zero]);?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                </td>

                                <td><input type="number" class="form-control" id="qty[]" name="qty[]" value ="<?php print_r($quantity[$zero]);?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$">
                                </td>

                                <td>
                                  <input type="text" class="form-control" id="unitName[]" name="unitName[]" value ="<?php print_r($unit[$zero]);?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly> 
                                </td>

                                 <td>
                                    <select class="form-control filter" id="supplyDesc[]" name="supplyDesc[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  <option><?php print_r($item_name[$zero]);?></option>
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                </td>

                                <td>
                                  <input type="text" class="form-control" id="type[]" name="type[]" value ="<?php print_r($item_type[$zero]);?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly> 
                                </td>

                                <td class="hidden">
                                  <input type="hidden" class="form-control hidden" id="remarks[]" name="remarks[]" value ="<?php print_r($remarks[$zero++]);?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" hidden readonly> 
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                        </table>

                    </div>
                </div>
                      <?php
                        $sql="SELECT * FROM inventory_order io JOIN inventory_order_supplies ios USING(inventory_order_uniq_id) JOIN supplies s ON s.supply_description=ios.supply_name WHERE inventory_order_id=$id AND quantity !=0";
                        $result = $con->query($sql); 
                        $arrayOrdId = '';   

                        if($result->num_rows > 0) {
                          while($row =$result->fetch_assoc()) {
                            $arrayOrdId .= $row['inventory_order_supplies_id'].', ';
                            $order_id = explode(", ", $arrayOrdId);
                          }
                          $count = count($order_id)-1;

                          if($count == 9){ ?>

                          <?php }else{ ?>
                            <div class="row">
                              <button type="button" name="plus" id="plus" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Row</button>
                            </div>
                            <div class="row">
                              <div class="table-responsive">
                                  <span id="error"></span>
                                  <table class="table table-bordered" id="dynamic">
                                    <tr>
                                      <th width="15%">  </th>
                                      <th width="18%">  </th>
                                      <th width="50%">  </th>
                                      <th width="17%">  </th>
                                    </tr>
                                  </table>
                              </div>
                          </div>
                          <?php } 
                        }?>

                  
              </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary" name="update" id="update"><i class="fa fa-edit"></i> Update</button>
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


<script>
$(document).ready(function(){
  var postURL = "order/updateItem";
  var i=0;
  var supplyDrop = <?php echo(json_encode(supply_dropdown($connect))); ?>;
  var limit = <?php echo(json_encode($count)); ?>;
  // var unitDrop = <?php // echo(json_encode(unit_measure($connect))); ?>;
  $('#plus').click(function(){
    if (i < (10-limit) && limit != 10){

      i++;
      // document.getElementById('row'+i+'').setAttribute("class", " ");
      $('#dynamic').append('<tr id="row'+i+'"> <td width="15%"><input class="form-control" type="number" name="number[]" id="number[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" required /></td><td width="16%"><input class="form-control" type="text" name="unit" id="unit[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;background-color: #f1f1f1;" readonly></td><td width="52.5%"><select class="form-control filter" name="neym[]" id="neym[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"><option value=""></option> '+supplyDrop+' </select></td><td width="16.5%"><input class="form-control" type="text" name="type" id="type[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black; background-color: #f1f1f1;" readonly></td></tr>');

      $("select.filter").change(function () {
    $("select.filter option[value='" + $(this).data('index') + "']").prop('hidden', false);
    $(this).data('index', this.value);
    $("select.filter option[value='" + this.value + "']:not([value=''])").prop('hidden', true);
    $(this).find("option[value='" + this.value + "']:not([value=''])").prop('hidden', false);
  });
    }

  });


  
  // $(document).on('click', '.btn_remove', function(){
  //   var button_id = $(this).attr("id"); 
  //   document.getElementById('row'+button_id+'').setAttribute("class", "hidden");
  //   i--;
  //   // $('#row'+button_id+'').remove();
  // });

  $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });

  // $('#update').click(function(){    
  //   $.ajax({
  //     url: postURL,
  //     method:"POST",
  //     data:$('#plus_name').serialize(),
  //     type: 'json',
  //     success:function(data)
  //     {
  //         i=1;
  //                 $('.dynamic-added').remove();
  //                 $('#plus_name')[0].reset();
  //           alert('Record Inserted Successfully.');
  //           location.reload();
  //     }
  //   });
  // });
  
  
  
});
</script>

<script>
  $("select.filter").change(function () {
    $("select.filter option[value='" + $(this).data('index') + "']").prop('hidden', false);
    $(this).data('index', this.value);
    $("select.filter option[value='" + this.value + "']:not([value=''])").prop('hidden', true);
    $(this).find("option[value='" + this.value + "']:not([value=''])").prop('hidden', false);
  }
</script>