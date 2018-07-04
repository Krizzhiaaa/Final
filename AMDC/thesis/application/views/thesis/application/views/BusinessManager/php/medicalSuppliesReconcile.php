<?php
$con=mysqli_connect('localhost','root','','itproject')
    or die("connection failed".mysqli_errno());
$connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

function remarks_desc($connect)
{ 
 $output = '';
 $query = "SELECT * FROM remarks WHERE category='Reconciliation'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
    $output .= '<option value="'.$row["remarks"].'">'.$row["remarks"].'</option>';
 }
 return $output;
}
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from supplies WHERE supply_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
      //  $per_supplierName=$row[1];
        $per_supplyDescription=$row[2];
        $per_supplyQuantityInStock=$row[5];
        $per_supplyRemarks=$row[11];


    }//end while
?>
       <div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
    <form class="form-horizontal" method="post" action ="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="col-md-2">
                                                <img src="../assets/dist/img/user3-128x128.png" alt="User Image" style="width:80px;height:80px;">
                                            </div>
                                            <div class="col-md-8">
                                                
                                                <div class="margin">
                                                    <center><h5>Assumption Medical Diagnostic Center </h5></center>
                                                    <center><h6>10 Assumption Rd., Baguio City</h6></center>
                                                    <center><h6>Philippines</h6></center>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of modal header -->
                                        <div class="modal-body">
                                        <div class="box-header">
                                          <div class="margin">
                                              <center><h4><b>Inventory Reconciliation</b></h4></center>
                                            </div>
                <form class="form-horizontal" method="post">
                      <table style="float:right;">
                    <tr>
                    <div class="box-body">
                        
                        <div class="form-group">
                             <div class="form-group">
                            <label hidden="true" class="col-sm-4 control-label" for="txtid">Supply ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="txtsupplyDescription">Description</label>
                                <input type="text" class="form-control" id="txtsupplyDescription" name="txtsupplyDescription" value="<?php echo $per_supplyDescription;?>" readonly/>
                            </div>

                            <div class="row">
                          <div class="col-sm-6">
                             <div class="form-group" style="width:100%">
                            <label for="txtQuantityInStock">Logical Count</label>
                                <input type="number" class="form-control" id="txtLogicalCount" name="txtLogicalCount" value="<?php echo $per_supplyQuantityInStock;?>" readonly>
                            </div>
                        </div>
                        
                          <div class="col-sm-6">
                             <div class="form-group">
                            <label for="txtQuantityInStock">Physical Count</label>
                                <input type="number" class="form-control" id="txtPhysicalCount" name="txtPhysicalCount" min="0">
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-12">
                             <div class="form-group" >
                                <label for="txtRemarks">Remarks</label>
                            <select class="form-control select2" id="remarks" name="remarks" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  <option value=""></option>
                                                  <?php echo remarks_desc($connect);?>
                                                </select>
                            </div>
                        </div>
                        </div>
                    </tr>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-info" name="medRecon"><i class="glyphicon glyphicon-adjust"></i> Reconcile</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>