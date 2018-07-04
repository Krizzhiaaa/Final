 <link rel="stylesheet" href="../assets/orderedit/bootstrap.min.css" />
<?php
/**
 for display full info. and edit data
 */
// start again
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

function supply_dropdown($connect)
{ 
 $output = '';
 $query = "SELECT * FROM supplies ORDER BY supply_description ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["supply_description"].'">'.$row["supply_description"].'</option>';
 }
 return $output;
}

function unit_measure($connect)
{ 
 $output = '';
 $query = "SELECT * FROM unit_of_measure ORDER BY unit_name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"].'</option>';
 }
 return $output;
}
 function dept($connect) {
  $sql = "SELECT department_name FROM departments JOIN users ON users.dept_ID=departments.department_id WHERE users.fname='".$this->session->userdata('fname')."' AND users.lname='".$this->session->userdata('lname')."' ";
$results = mysqli_query($conn, $sql);
}


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
        $per_createdDate_=$row[17];
        $per_orderName=$row[18];  
        $per_status=$row[19];
        $per_purchRemarks=$row[20];
        $per_gtotal=$row[21];
        $per_key=$row[22];
        $per_itemdelRemarks=$row[23];
        $per_soft_deleted=$row[24];
        $date = date("Y-m-d");


    }//end while
?>
<form id="plus_name" name="plus_name" method="post">
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
            <!-- end of modal header -->
             <div class="modal-body">
                 <div class="box-header">
                    <div class="margin">
                        <center><h4><b>Update Purchase Order Details</b></h4></center>
                    </div>
              <div class="box-body">                   
                <div class="form-group" style="width:100%">
                  <label class="hidden" for="txtid">Purchase ID</label>
                    <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                </div>
                <div class="form-group" style="width:100%">
                  <label class="hidden" for="txtuniqid">Purchase Unique ID</label>
                    <input type="hidden" class="form-control" id="txtuniqid" name="txtuniqid" value="<?php echo $per_key;?>" readonly>
                </div>       
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                          </div>
                            <input type="text" class="form-control" id="custName" name="custName" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly margin="0px auto">
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
                            <input type="text" class="form-control" id="txtsupplier" name="txtsupplier" value="<?php echo $per_supplier;?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
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
                           <input type="text" class="form-control" id="orDate" name="orDate" value="<?php echo $per_orderDate;?>"  style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1"></div>
                      <div class="col-md-5">
                        <div class="form-group">
                            <label for="txtstatus">Status</label>
                          <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-toggle-on"></i>
                          </div>
                            <input type="text" class="form-control" id="txtstatus" name="txtstatus" value="<?php echo $per_status;?>" readonly style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                $sql="SELECT * FROM purchase_orders JOIN purchase_order_bm USING(purchase_order_uniq_id) WHERE purchase_order_id = $id AND order_quantity != 0";
                $result = $con->query($sql);
                ?>
                  <div class="row">                 
                <div class="table-responsive">
                  <span id="error"></span>
                    <table class="table table-bordered" id="dynamic">
                    <tr>
                      <th>ID</th>
                      <th>Item Description</th>
                      <th>Quantity</th>
                     </tr>
                     <?php if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) { 
                          ?>
                     <tr>
                        <td width="15pxc">
                          <input class="form-control" id="txtpoid[]" name="txtpoid[]" value="<?php echo $row["po_id"]; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                         </td>

                        <td width="200">
                          <select class="form-control select2" id="neym[]" name="neym[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                            <option><?php echo $row["description"]; ?></option>
                            <?php echo supply_dropdown($connect);?>
                          </select>
                        </td>

                        <td width="100"><input type="number" class="form-control" id="number[]" name="number[]" value="<?php echo $row["order_quantity"]; ?>" min="0"  style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" ></td>
                      </tr>

                   <?php } 
                       }       
                      ?>
                     </table>
                   </div>                          
                  </div>
                  <div class="modal-footer">
                   <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                   <button type="submit" class="btn btn-primary" name="purchEdit" id="purchEdit"><i class="fa fa-edit"></i> Update</button>
                </div>
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

<!-- <script>
$(document).ready(function(){
  var postURL = "purchases/editPurchases";
  // $('#dynamic');
  // var supplyDrop = <?php // echo(json_encode(supply_dropdown($connect))); ?>;
  // // var unitDrop = <?php // echo(json_encode(unit_measure($connect))); ?>;
  // $('#plus').click(function(){
  //   if (i < 10){
  //     i++;
  //     // document.getElementById('row'+i+'').setAttribute("class", " ");
  //     $('#dynamic').append('<tr id="row'+i+'"></td> <td><select class="form-control select2" name="neym[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"><option value=""></option> '+supplyDrop+' </select></td><td><input type="text" name="number[]" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">x</button></td></tr>');
  //   }

  });
  
  // $(document).on('click', '.btn_remove', function(){
  //   var button_id = $(this).attr("id"); 
  //   document.getElementById('row'+button_id+'').setAttribute("class", "hidden");
  //   i--;
  //   // $('#row'+button_id+'').remove();
  // });

  // $(document).on('click', '.btn_remove', function(){
  //       var button_id = $(this).attr("id"); 
  //       $('#row'+button_id+'').remove();
  //   });
  
  $('#submit').click(function(){    
    $.ajax({
      url: postURL,
      method:"POST",
      data:$('#plus_name').serialize(),
      type: 'json',
      success:function(data)
      {
          i=1;
                  $('.dynamic-added').remove();
                  $('#plus_name')[0].reset();
            alert('Record Inserted Successfully.');
      }
    });
  });
  
});
</script> -->