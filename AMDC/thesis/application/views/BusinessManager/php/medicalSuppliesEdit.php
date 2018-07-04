<!-- daterange picker -->
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
        $per_supplyExpirationDate=$row[9];
        $per_supplyGoodCondition=$row[10];
        $per_supplyDamaged=$row[11];
        $per_itemName = $row[2];
        $per_category = $row[22];
        $per_lotNo = $row[23];
        $per_supplier = $row[15];
        $per_dep = $row[20];

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
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-hashtag"></i>
                                                  </div>
                                                    <input type="text" class="form-control" id="txtlotNo"  maxlength="12" name="txtlotNo" value="<?php echo $per_lotNo;?>" readonly>
                                                </div>
                                              </div>
                                            </div>
                                                
                                                    <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Brand Name</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-tags"></i>
                                                  </div>
                                                      <input type="text" class="form-control" id="txtbrandName" name="txtbrandName" value="<?php echo $per_brandName;?>" >
                                                </div>
                                              </div>
                                              </div>
                                            </div>
                        
                              <div class="form-group" >
                            <label for="txtItemName">Item Name</label>
                            <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-shopping-bag"></i>
                                                  </div>
                                <input type="text" class="form-control" id="txtItemName" name="txtItemName" value="<?php echo $per_itemName;?>" >
                            </div>
                          </div>
                        
                          <div class="form-group">
                            <label for="txtsupplyDescription">Item Description</label>
                            <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-shopping-bag"></i>
                                                  </div>
                                <input type="text" class="form-control" id="txtsupplyDescription" name="txtsupplyDescription" value="<?php echo $per_supplyDescription;?>" >
                            </div>
                          </div>

                                            <div class="row">
                                             <div class="col-md-6">
                                                        <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Add new 'Unit'  </label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-cubes"></i>
                                                  </div>
                                                  <input class="form-control" type="text" id="newOpt"/>
                                                </div>
                                                  <button class="btn btn-default btn-md pull-right" type="button" id="addOpt" >Add Unit</button>
                                                </div>
                                                </div>

                                        <div class="col-md-6">
                                               <div class="form-group" >
                                                  <label for="exampleInputEmail1">Unit</label><br>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-cubes"></i>
                                                  </div>
                                                       <select id="opt" name="txtUnit" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_supplyUnit;?></option>
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT unit FROM supplies WHERE unit NOT LIKE '%$per_supplyUnit%' ORDER BY unit ASC";
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
                                                  </div>
                                                </div>
                        
              
                                        <div class="row">
                                              <div class="col-md-6">
                                                        <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Add new 'Category'  </label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-th-large"></i>
                                                  </div>
                                                  <input class="form-control" type="text" id="newCat"/>
                                                </div>
                                                  <button class="btn btn-default btn-md pull-right" type="button" id="addCat" >Add Category</button>
                                                </div>
                                                </div>

                                        <div class="col-md-6">
                                               <div class="form-group" >
                                                  <label for="exampleInputEmail1">Category</label><br>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-th-large"></i>
                                                  </div>
                                                       <select id="cat" name="txtCategory" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_category;?></option>
                                                        <?php
                                                          $conn = mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT category FROM supplies WHERE category IS NOT NULL AND category NOT LIKE '%$per_category%' GROUP BY category ORDER BY category ASC";
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
                                                 </div>
     
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <span class="pull-left" id="message"></span>
                                                    </div>
                                                  </div>
                                                </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group" style="width:100%;">
                            <label for="txtAddQuantity">Current Quantity In Stock</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-plus-square"></i>
                                                  </div>
                                <input type="number" class="form-control" id="addQty" min="1" pattern="^[0-9]$" name="addQty" value="<?php echo $per_supplyQuantityInStock;?>" readonly>
                        </div>
                        </div>
                      </div>

                            <div class="col-md-6">
                            <div class="form-group" >
                            <label for="txtAddQuantity">Update Quantity</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-plus-square"></i>
                                                  </div>
                                <input type="number" class="form-control" id="addQty" min="1" pattern="^[0-9]$" name="addQty" value="<?php echo $per_supplyQuantityInStock;?>" >
                        </div>
                        </div>
                        </div>
                      </div>

                            <div class="row">
                                <div class="col-md-6">
                            <div class="form-group" style="width:100%;">
                            <label for="unitPrice">Current Unit Price</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-money"></i>
                                                  </div>
                                <input type="number" class="form-control" id="oldUnitPrice" name="oldUnitPrice" value="<?php echo $per_supplyUnitPrice;?>" readonly>
                            </div>
                            </div>
                          </div>

                            <div class="col-md-6">
                            <div class="form-group" >
                            <label for="unitPrice">Unit Price</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-money"></i>
                                                  </div>
                                <input type="number" class="form-control" id="unitPrice" name="unitPrice" step=".01" min="1" value="<?php echo $per_supplyUnitPrice;?>">
                        </div>
                        </div>
                        </div>
                      </div>

                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group" style="width:100%;">
                            <label for="txtReorderLevel">Reorder Level</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-reorder"></i>
                                                  </div>
                                <input type="number" class="form-control" id="txtReorderLevel" name="txtReorderLevel" value="<?php echo $per_supplyReorderLevel;?>" readonly>
                        </div>
                        </div>
                      </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="txtExpirationDate">Expiration Date</label>
                             <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                <input type="text" class="form-control" id="datepicker" name="txtExpirationDate" placeholder="yyyy-mm-dd" value="<?php echo $per_supplyExpirationDate; ?>">
                              </div>
                        </div>
                        </div>
                        </div>
                        
                            <div class="row">
                              <div class="col-md-6">
                                               <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Supplier</label><br>
                                                   <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                  </div>
                                                       <select name="txtSupplier" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_supplier;?></option>
                                                   
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT company_name FROM suppliers WHERE product = 'Medical' ORDER BY company_name ASC";
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $txtSupplier) { 
                                                        ?>

                                                        <option value="<?php echo $txtSupplier["company_name"]; ?>" name="txtSupplier"><?php echo $txtSupplier["company_name"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                     </div>
                                                   </div>  
                                                 </div>
                                             
                                            
                                        <div class="col-md-6">
                                               <div class="form-group" style="width:100%">
                                                  <label for="exampleInputEmail1">Department</label><br>
                                                   <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-building"></i>
                                                  </div>
                                                       <select name="txtDep" class="form-control select2" style="width: 100%;">
                                                       <option><?php echo $per_dep;?></option>
                                                      
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                             $sql = "SELECT DISTINCT department_name FROM departments WHERE department_name NOT LIKE '%$per_dep%' ORDER BY department_name ASC";
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $txtDep) { 
                                                        ?>

                                                        <option value="<?php echo $txtDep["department_name"]; ?>" name="txtDep"><?php echo $txtDep["department_name"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                     </div>
                                                   </div>  
                                                 </div>
                                                </div>
                        </tr>
                        </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="medEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>

<!-- bootstrap datepicker -->
<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

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
    
        <script>
  var message = document.getElementById('message');
        var badColor = "#ff6666";
            $(function () {
                $('#addOpt').click(function () {
                    var newOpt = $('#newOpt').val();
                    if (newOpt == '') {
                      message.style.color = badColor;
                        message.innerHTML = "Please enter a value";
                        return;
                    }
 
                    //check if the option value is already in the select box
                    $('#opt option').each(function (index) {
                        if ($(this).val() == newOpt) {
                            message.style.color = badColor;
                          message.innerHTML = "The unit already exists, please enter another value";
                        }
                    })
 
                    //add the new option to the select box
                    $('#opt').append('<option value=' + newOpt + '>' + newOpt + '</option>');
 
                    //select the new option (particular value)
                    $('#opt option[value="' + newOpt + '"]').prop('selected', true);
                });
            });
        </script>
        
               <script>
                var message = document.getElementById('message');
        var badColor = "#ff6666";
            $(function () {
                $('#addCat').click(function () {
                    var newCat = $('#newCat').val();
                    if (newCat == '') {
                        message.style.color = badColor;
                        message.innerHTML = "Please enter a value";
                        return;
                    }
 
                    //check if the option value is already in the select box
                    $('#cat option').each(function (index) {
                        if ($(this).val() == newCat) {
                            message.style.color = badColor;
                          message.innerHTML = "The category already exists, please enter another value";
                        }
                    })
 
                    //add the new option to the select box
                    $('#cat').append('<option value=' + newCat + '>' + newCat + '</option>');
 
                    //select the new option (particular value)
                    $('#cat option[value="' + newCat + '"]').prop('selected', true);
                });
            });
        </script>