<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AMDC IMS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css" type="text/css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css"  type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css" type="text/css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css" type="text/css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
</head>
<body>

  <style type="text/css">
    body {
   background-image: url('assets/dist/img/Background.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
    }
  </style>


<div class="login-box" style="float: left; margin-left: 100px; margin-top: 150px;">

  <!-- /.login-logo -->
  <div>

   <br>
      <div class="login-logo">
       <center><img src="assets/dist/img/AMDC.png" alt="User Image" style="width:310px;height:110px;"></center>
  </div>
   <br>


    <p class="login-box-msg">Sign in to start your session</p>

    <form name="form1" method="post" action="<?php echo site_url('login/checklogin') ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username/Email" required/>
        <span class="glyphicon glyphicon-user form-control-feedback"> &nbsp;</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" onmouseover="mouseoverPass2();" onmouseout="mouseoutPass2();" required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <script>
        function mouseoverPass2(obj) {
          var obj = document.getElementById('password');
          obj.type = "text";
        }
        function mouseoutPass2(obj) {
          var obj = document.getElementById('password');
          obj.type = "password";
        }
      </script>

      <div class="row" style="display: flex; align-items: center; justify-content: center;color: red">
      <?php
        $info = $this->session->flashdata('info');
        if(!empty($info)){
          echo $info;
        }
      ?>

      </div>                                                   
<br>
      <div class="row" style="display: flex; align-items: center; justify-content: center;">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-success btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <center><a data-toggle="modal" data-target="#forgotpass" style="color:green;">Forgot password</a></center>
      <form name="form2" method="post"  action="login/passforget">
                        <div class="modal fade" id="forgotpass">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <div class="margin">
                                            <h3>Forgot Password</h3>
                                          </div>
                                      </div>
                                        <!-- end of modal header -->
                                      <div class="modal-body">
                                        <div class="box-body">
                                           <div class="form-group">
                                              <label for="exampleInputEmail1">Username</label>
                                              <input type="text" class="form-control" name="username" id="username" required />
                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
<!--
                                          <script>
                                          function myFunction() {
                                                var x = document.getElementById("resetbutton");
                                                var y = document.getElementById("nextbutton");
                                                if (x.style.display === "none") {
                                                    x.style.display = "block";
                                                    y.style.display = "none";
                                                } else {
                                                    x.style.display = "none";
                                                }
                                            }
                                          </script>
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <a style="display:block;width:60px;float:right;" id="nextbutton" class="btn btn-success" onclick="myFunction()">Next</a>
-->                                       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                          <div style="display:block;" id="resetbutton">
                                          <button type="submit" class="btn btn-danger" name="passforget">Reset</button>
                                          </div>
                                        
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                   </form>
                                  <!-- /.modal-dialog -->
                                  <?php 
                                    $con=mysqli_connect('localhost','root','','itproject'); 
                                  if(isset($_GET['user'])){
                                      $username=$_GET['user'];
                                      $sql="select * from users WHERE username=$username";
                                      $run_sql=mysqli_query($con,$sql);
                                      while($row=mysqli_fetch_array($run_sql)){
                                          $per_userId=$row[0];
                                          $per_userName=$row[3];
                                          $per_password=$row[4];
                                          $per_type=$row[2];
                                          //$per_reqId=$row[3];
                                          //$per_userId=$row[5];
                                          //$per_suppId=$row[4];
                                          //$per_suppId=$row[3];

                                      }//end while
                                      if($per_type == 'BusinessManager'){
                                  ?>
                                </div>
                                    <div class="modal fade" id="modal-warning">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <h4>New Password Saved!</h4>
                                  </div>  
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <?php
                                }  
                              }
                              ?> 
                                
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>


<div class="modal fade" id="forg" role="dialog">
            <div class="modal-dialog">
                <div id="forg-data"></div>
            </div>
        </div>


<script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_userName=$(this).data('username');
            //alert(per_id);
            $('#forg-data').html('');
            $.ajax({
                url:'forget/editPass',
                type:'POST',
                data:'username='+per_userName,
                dataType:'html'
            }).done(function(data){
                $('#forg-data').html('');
                $('#forg-data').html(data);
            }).final(function(){
                $('#forg-data').html('<p>Error</p>');
            });
        });
    </script>

</body>
</html>

<script>
        $(document).on('click','#getAdd',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'login/passforget',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).final(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
    </script>

<?php 
$con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
if(isset($_POST['change'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $new_password=mysqli_real_escape_string($con,$_POST['pwd']);
    $new_username=mysqli_real_escape_string($con,$_POST['txtusername']);

    $sqlupdate="UPDATE users SET password='$new_password' WHERE username='$new_username' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        echo '<script>window.location.href="login"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}

?>