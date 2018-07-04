  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());

if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from supplies WHERE supply_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
      //  $per_supplierName=$row[1];
        $per_supplyDescription=$row[24];
        $per_brandName=$row[3];
        $per_supplyUnit=$row[4];
        $per_supplyQuantityInStock=$row[5];
        $per_supplyUnitPrice=$row[6];
        $per_supplyReorderLevel=$row[8];
        $per_supplyGoodCondition=$row[10];
        $per_supplyDamaged=$row[11];
        $per_itemName = $row[2];
        $per_category = $row[22];
        $per_deptName = $row[20];
        $per_lotNo = $row[23];

    }//end while
?>
<div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
    <form class="form-horizontal" method="post" action ="" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                        <!-- end of modal header -->
                                        <div class="modal-body">
                                        <div class="box-header">
                                          <div class="margin">
                                              <center><h4><b>Update Supply Details</b></h4></center>
                                            </div>
                                        </div>
                <form class="form-horizontal" method="post">
                    <table style="float:right;">
                    <tr>
                    <div class="box-body">
                        
                             <div class="form-group" style="display:none;">
                            <label for="txtid">Supply ID</label>
                                <input class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                            </div>
                        
                                 <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Lot Number</label>
                                                    <input type="text" class="form-control" id="txtlotNo"  maxlength="12" name="txtlotNo" value="<?php echo $per_lotNo;?>" readonly>
                                                </div>
                                              </div>
                                                
                                                    <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Brand Name</label>
                                                      <input type="text" class="form-control" id="txtbrandName" name="txtbrandName" value="<?php echo $per_brandName;?>" >
                                                
                                              </div>
                                              </div>
                                            </div>
                        
                              <div class="form-group" >
                            <label for="txtItemName">Item Name</label>
                                <input type="text" class="form-control" id="txtItemName" name="txtItemName" value="<?php echo $per_itemName;?>" >
                            </div>
                        
                          <div class="form-group">
                            <label for="txtsupplyDescription">Item Description</label>
                                <input type="text" class="form-control" id="txtsupplyDescription" name="txtsupplyDescription" value="<?php echo $per_supplyDescription;?>" >
                            </div>

                                            <div class="row">
                                              <div class="col-md-6">
                                               <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Unit</label><br>
                                                       <select id="OPT" name="txtUnit" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_supplyUnit;?></option>
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT unit FROM supplies ORDER BY unit ASC";
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $txtUnit) { 
                                                        ?>

                                                        <option value="<?php echo $txtUnit["unit"]; ?>" name="txtUnit"><?php echo $txtUnit["unit"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                     </div>
                                                   </div> 
                                                   <div class="col-md-6">
                                                        <div class="form-group" >
                                                  <label for="exampleInputEmail1">Add new 'Unit'</label>
                                                  <input class="form-control" type="text" id="newOPT"/><input type="button" value="Add Unit" id="addOPT" style="float: right;" />
                                                </div>
                                                </div>
                                              </div>
              
                                        <div class="row"> 
                                        <div class="col-md-6">
                                               <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Category</label><br>
                                                       <select id="CAT" name="txtCategory" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_category;?></option>
                                                        <?php
                                                          $conn = mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT category FROM supplies WHERE category IS NOT NULL  ORDER BY category ASC";
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $txtCategory) { 
                                                        ?>

                                                        <option value="<?php echo $txtCategory["category"]; ?>" name="txtCategory"><?php echo $txtCategory["category"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                     </div>
                                                   </div> 
                                                   <div class="col-md-6">
                                                        <div class="form-group" >
                                                  <label for="exampleInputEmail1">Add new 'Category' </label>
                                                  <input class="form-control" type="text" id="newCAT"/><input type="button" value="Add Category" id="addCAT" style="float: right;" />
                                                </div>
                                                </div> 
                                                </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group" style="width:100%;">
                            <label for="txtAddQuantity">Current Quantity In Stock</label>
                                <input type="number" class="form-control"id="addQty" min="1" pattern="^[0-9]$" name="addQty" value="<?php echo $per_supplyQuantityInStock;?>" readonly>
                        </div>
                        </div>

                            <div class="col-md-6">
                            <div class="form-group" >
                            <label for="txtAddQuantity">Update Quantity</label>
                                <input type="number" class="form-control" id="addQty" min="1" pattern="^[0-9]$" name="addQty" value="<?php echo $per_supplyQuantityInStock;?>" >
                        </div>
                        </div>
                        </div>

                            <div class="row">
                                <div class="col-md-6">
                            <div class="form-group" style="width:100%;">
                            <label for="unitPrice">Current Unit Price</label>
                                <input type="number" class="form-control" id="unitPrice" name="unitPrice" value="<?php echo $per_supplyUnitPrice;?>" readonly>
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group" >
                            <label for="unitPrice">Unit Price</label>
                                <input type="number" class="form-control" id="unitPrice" name="unitPrice" step=".01" min="1" value="<?php echo $per_supplyUnitPrice;?>">
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group" style="width:100%;">
                            <label for="txtReorderLevel">Reorder Level</label>
                                <input type="number" class="form-control" id="txtReorderLevel" name="txtReorderLevel" value="<?php echo $per_supplyReorderLevel;?>" readonly>
                        </div>
                        </div>
                 
                        </div>
                        
          
                        
                        </tr>
                        </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="offEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>
            
        
<!-- bootstrap datepicker -->
<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
            $(function () {
                $('#addOPT').click(function () {
                    var newOPT = $('#newOPT').val();
                    if (newOPT == '') {
                        alert('Please enter something!');
                        return;
                    }
 
                    //check if the option value is already in the select box
                    $('#OPT option').each(function (index) {
                        if ($(this).val() == newOPT) {
                            alert('Duplicate option, Please enter new!');
                        }
                    })
 
                    //add the new option to the select box
                    $('#OPT').append('<option value=' + newOPT + '>' + newOPT + '</option>');
 
                    //select the new option (particular value)
                    $('#OPT option[value="' + newOPT + '"]').prop('selected', true);
                });
            });
        </script>
        
               <script>
            $(function () {
                $('#addCAT').click(function () {
                    var newCAT = $('#newCAT').val();
                    if (newCAT == '') {
                        alert('Please enter something!');
                        return;
                    }
 
                    //check if the option value is already in the select box
                    $('#CAT option').each(function (index) {
                        if ($(this).val() == newCAT) {
                            alert('Duplicate option, Please enter new!');
                        }
                    })
 
                    //add the new option to the select box
                    $('#CAT').append('<option value=' + newCAT + '>' + newCAT + '</option>');
 
                    //select the new option (particular value)
                    $('#CAT option[value="' + newCAT + '"]').prop('selected', true);
                });
            });
        </script>
<script>
 // date and time 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
  }) 
</script>
        