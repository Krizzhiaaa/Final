<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','itproject'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * from suppliers WHERE supplier_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_supplierName=$row[1];
        $per_supplierContact=$row[2];
        $per_supplierAddress=$row[3];
        $per_supplierProduct=$row[5];
        $per_supplierStatus=$row[4];
        $per_supplierRemarks=$row[6];
        $per_soleProprietor=$row[7];

    }//end while
?>
       <div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
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
                                        <!-- end of modal header -->
                                        <div class="modal-body">
                                        <div class="box-header">
                                          <div class="margin">
                                              <center><h4><b>Update Supplier Details</b></h4></center>
                                            </div>
                                        </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="form-group">
                            <label hidden="true" for="txtid">Suppliers ID</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Proprietor</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user-o"></i>
                              </div>
                              <input type="text" class="form-control" id="txtsoleproprietor" name="txtsoleproprietor" value="<?php echo $per_soleProprietor;?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group" style="width:100%;">
                            <label for="txtsuppliername">Company Name</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-building-o"></i>
                              </div>
                              <input type="text" class="form-control" id="txtsuppliername" name="txtsuppliername" value="<?php echo $per_supplierName;?>" >
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="txtcontactno">Contact Number</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone-square"></i>
                                </div>
                                <input type="text" class="form-control" id="txtcontactno" name="txtcontactno" value="<?php echo $per_supplierContact;?>" data-inputmask='"mask":"(9999) 999-9999"' data-mask required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group" style="width:100%;">
                            <label for="txtaddress">Address</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-address-book-o"></i>
                              </div>
                              <input type="text" class="form-control" id="txtaddress" name="txtaddress" value="<?php echo $per_supplierAddress;?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="txtprodtype">Product Type</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-product-hunt"></i>
                              </div>
                              <select id="txtprodtype" name="txtprodtype" class="form-control" >
                                <option value="Office" <?php echo ($per_supplierProduct =='Office')?'selected':'' ?>>Office</option>
                                <option value="Medical" <?php echo ($per_supplierProduct =='Medical')?'selected':'' ?>>Medical</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="col-sm-13">
                        <div class="form-group">
                            <label for="txtremarks">Remarks</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-commenting-o"></i>
                              </div>
                              <input type="text" class="form-control" id="txtremarks" name="txtremarks" value="<?php echo $per_supplierRemarks;?>" >
                            </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="btnEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </div>
    </form>

<?php
}//end if
?>


<!-- InputMask -->
<script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>



<script>
  $(function(){
    $('[data-mask]').inputmask()
  })
</script>



