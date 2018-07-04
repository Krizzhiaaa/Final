<?php

$con=mysqli_connect('localhost','root','','itproject'); 


if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM users WHERE user_id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
       
        $per_username=$row[2];
        $per_lname=$row[4];
         $per_id=$row[0];
        $per_fname=$row[5];
        $per_usercontact=$row[6];
        $per_email=$row[7];
         $per_status=$row[8];
         $per_deptname=$row[9];
         $per_type=$row[1];
          $per_branch=$row[11];

    }//end while
?>
       <div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
    <form class="form-horizontal" method="post">
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
                                              <center><h4><b>Update User Details</b></h4></center>
                                            </div>
                                        </div>
                    <div class="box-body">
                        <div class="form-group">
                                    <label hidden="true" class="col-sm-4 control-label" for="txtid">UserID</label>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $per_id;?>" readonly>
                                </div>
                             </div>

                             <div class="col-sm-13">
                             <div class="form-group">
                                     <label for="txtusername">Username</label>
                                     <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-address-card-o"></i>
                                                  </div>
                                    <input type="text" minlength=6 class="form-control" id="txtusername" name="txtusername" value="<?php echo $per_username;?>" readonly>
                                </div>
                            </div>
                          </div>

                            <div class="row">
                           <div class="col-sm-6">
                             <div class="form-group" style="width:100%">
                                    <label for="txtlname">Last Name</label>
                                    <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-user-circle"></i>
                                                  </div>
                                    <input type="text" class="form-control" id="txtlname" name="txtlname" value="<?php echo $per_lname;?>" readonly>
                                </div>
                            </div>
                          </div>

                            <div class="col-sm-6">
                            <div class="form-group">
                                     <label for="txtfname">First Name</label>
                                     <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-user-circle"></i>
                                                  </div>
                                    <input type="text" class="form-control" id="txtfname" name="txtfname" value="<?php echo $per_fname;?>" readonly>
                                </div>
                            </div>
                          </div>

                                  <div class="col-sm-6">
                                                <div class="form-group" style="width:100%">
                                                  <label>Contact Number</label>

                                                <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                  </div>
                                                  <input type="text" class="form-control" name="txtuser_contact" id="txtuser_contact"data-inputmask='"mask":"(9999) 999-9999"' value="<?php echo $per_usercontact;?>" data-mask required>
                                                </div>
                                                <script>
                                                  $(function(){
                                                    $('[data-mask]').inputmask()
                                                  })
                                                </script>
                                              </div>
                                               </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="txtemail">Email</label>
                                      <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                  </div>
                                    <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="email@email.com" value="<?php echo $per_email;?>" readonly>
                                </div>
                            </div>
                        </div>
                                    
                                     <div class="col-md-6">
                                    <div class="form-group" style="width:100%">
                                    
                                      <?php if($per_type != 'Assistant'){ ?>

                                                      <label for="txtdeptname">Department</label>
                                                        <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-building"></i>
                                                  </div>
                                                       <select name = "txtdeptname" id="txtdeptname" class="form-control" value="<?php echo $per_deptname;?>">
                                                       <option><?php echo $per_deptname; ?></option>
                                                                            <option></option>
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                            $sql = "SELECT DISTINCT department_name AS 'DeptBranch' FROM departments WHERE department_name != 'Managing Department'";
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $dept_name) { 
                                                        ?>
                                                        <option value="<?php echo $dept_name["DeptBranch"]; ?>" name="dept_name"><?php echo $dept_name["DeptBranch"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                      <?php } else { ?>
                                                      
                                                      <label for="txtdeptname">Department</label>
                                                      <input type="text" name="txtdeptname" id="txtdeptname" class="form-control" value="<?php echo $per_deptname;?>" readonly>
                                                      
                                                       
                                                      <?php } ?>
                                        </div>
                                        </div>
                                      </div>
                              <div class="col-md-6">
                                        <div class="form-group" >
                                                      <label for="txtrole">Role</label>
                                                        <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-user-o"></i>
                                                  </div>
                                                       <select name="txtrole" id="txtrole" class="form-control">
                                                        <option><?php echo $per_type;?></option>
                                                        <option></option>
                                                        <?php
                                                          $conn =mysqli_connect("localhost","root","");
                                                           mysqli_select_db($conn, "itproject");
                                                            $sql = "SELECT DISTINCT role_type FROM role 
                                                            WHERE role_type NOT LIKE '%$per_type%' GROUP BY role_type" ;
                                                            $results = mysqli_query($conn, $sql);

                                                            foreach($results as $role) { 
                                                        ?>
                                                        <option value="<?php echo $role["role_type"]; ?>"><?php echo $role["role_type"]; ?></option>
                                                         <?php 
                                                            }
                                                          ?>
                                                      </select>
                                                     </div>
                                                   </div>
                                </div>
                        </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"> </i> Cancel</button>
                    <button type="submit" class="btn btn-primary" name="btnEdit"><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </form>
<?php
}//end if
?>