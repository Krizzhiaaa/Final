<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Bootstrap 3.3.7 -->
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Select2 -->
<script src="../assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<?php
$con=mysqli_connect('localhost','root','','itproject');
$connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

function remarks_desc($connect)
{ 
 $output = '';
 $query = "SELECT * FROM remarks WHERE category='ReorderLevel'";
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
    $sql="SELECT * FROM supplies WHERE supply_id IN ($id)";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_supplyDescription=$row[2];
        $per_supplyQuantityInStock=$row[5];
        $per_supplyReorderLevel=$row[8];
        $per_supplyExpirationDate=$row[9];
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
                                              <center><h4><b>Update Supply Details</b></h4></center>
                                            </div>
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                          <div class="form-group">
                            <div class="form-group">
                                <label hidden="true" class="col-sm-4 control-label" for="txtid">Supply ID</label>
									<input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
								</div>
							</div>
						</div>

                        <div class="box-body">
                          <div class="form-group">
                            <div class="form-group">
                                <label hidden class="col-sm-4 control-label" for="user">user</label>
                                    <input type="hidden" class="form-control" id="user" name="user" value="<?php echo ($this->session->userdata('fname')); echo ' '; echo ($this->session->userdata('lname'))?>" readonly>
                                </div>
                            </div>
                        </div>
                              <div class="col-sm-12">
                            <div class="form-group">
                                <label for="desc">Item Name</label>
                                    <input type="text" class="form-control" id="txtdesc" name="txtdesc" value="<?php echo $per_supplyDescription;?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtReorderLevel">Old Reorder Level</label>
                                <input type="number" class="form-control" id="oldLevel" name="oldLevel" value="<?php echo $per_supplyReorderLevel;?>" readonly>
                            </div>
						</div>
                        <div class="form-group">
                             <div class="col-sm-6">
                            <label for="txtReorderLevel">New Reorder Level</label>
                                <input type="number" class="form-control" id="newLevel" name="newLevel">
                            </div>
                    </div>
                     <div class="col-sm-12">
                            <div class="form-group">
                                <label for="desc">Remarks</label>
                                <select class="form-control select2" id="remarks" name="remarks" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  <option value=""></option>
                                                  <?php echo remarks_desc($connect);?>
                                                </select>
                                </div>
                            </div>

					</div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
				<button type="submit" class="btn btn-primary" name="medTQEdit"><i class="fa fa-edit"></i> Update</button>
			</div>
        </div>
        </div>
    </form>
<?php
}//end if
?>