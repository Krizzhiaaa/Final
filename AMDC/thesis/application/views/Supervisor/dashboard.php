<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['first_run'])){
    $_SESSION['first_run'] = 1;
        $datetoday = date('Y\-m\-d\ H:i:s A');
        $conn =mysqli_connect("localhost","root","");
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','".$this->session->userdata('type')." ".$this->session->userdata('fname')." ".$this->session->userdata('lname')." has logged in','".$this->session->userdata('username')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Supervisor | Dashboard</title>
	
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <script src="../assets/jquery/jquery-1.12.4.js"></script>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/bower_components/chart.js/chart.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <script src="../assets/jquery/jquery-1.12.4.js"></script>
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!-- datatable lib -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

   <!-- DataTables -->
  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="assets/dist/css/w3css.css">
  <script src="https://cdnjs.cloudfare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
  <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="https://cdnjs.cloudfare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script>
    history.forward();
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
$_SESSION['current_page'] = $_SERVER['REQUEST_URI']; 
      if(isset($_SESSION['logged_in']))  
      {  
           //echo 'dashboard';
      }  
      else if(!isset($_SESSION['logged_in'])) 
      {?>  
           <script>window.location.href = "Supervisor/lockscreen"</script>
           <?php    
      }  
      ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo 'dashboard' ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>MDC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="assets/dist/img/amdc2.png" alt="User Image" style="width:160px;height:50px;"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="user user-menu">
                <a class="dropdown-toggle">
                    <span class="hidden-xs" id="demo"></span>
                    <script>
                        var d = new Date().toString();
                        d=d.split(' ').slice(0, 6).join(' ');
                        document.getElementById("demo").innerHTML = d;
                    </script>
                </a>
            </li>
			
			
			<!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                $dtoday = date('Y\-m\-d\ H:i:s A');
                $date_select = date('Y\-m\-d\ H:i:s A', strtotime('-3 days') ) ;//minus three days
                $sql6 = "SELECT COUNT(*) AS total from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND log_description like '%order%' AND (user like '%".$this->session->userdata('fname')."%' OR (log_description like '%accepted%' OR log_description like '%declined%'))";
                $result6 = $conn->query($sql6);
                ?>
                <?php if ($result6->num_rows > 0) {
                while($row = $result6->fetch_assoc()) { ?>
                <span class="label label-warning"><?php echo $row["total"]; 
                    $counted = $row["total"];
                    ?></span>
                <?php 
                      }
                    }
                ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><i class="fa fa-warning text-yellow"></i> You have <?php echo $counted; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">  
                <table id="notify" class="table table-bordered table-striped">
                    <?php
                    $conn =mysqli_connect("localhost","root","");
                    mysqli_select_db($conn, "itproject");
                    $sql7 = "select log_id,log_date,log_description,user from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND log_description like '%order%' AND (user like '%".$this->session->userdata('fname')."%' OR (log_description like '%accepted%' OR log_description like '%declined%')) order by log_id DESC";
                    $result7 = $conn->query($sql7);
                    $datetoday = date("Y-m-d");
                    $datetodayval = date('Y\-m\-d\ h:i:s A');
                    $dateyesterday = date("Y-m-d",strtotime('-1 days'));
                    $dateyesterdayval = date('Y\-m\-d\ h:i:s A',strtotime('-1 days'));
                    $dateyesterday2 = date("Y-m-d",strtotime('-2 days'));
                    $dateyesterday2val = date('Y\-m\-d\ h:i:s A',strtotime('-2 days'));
                    ?>
                    <?php 
                      if ($result7->num_rows > 0) {
                       while($row = $result7->fetch_assoc()) {
                        $logvalue = $row["log_description"];
                        $dateds = $row["log_date"];
                        $dateds2 = explode(' ',$dateds);
                        $dated = $dateds2[0];
                    ?>
                      <tr>
                        <?php
                        if(strpos($logvalue, 'order') !== false) { 
                        if($dated == $datetoday) { 
                        ?>
                        <td>
                            <center><small><p><?php echo $datetodayval ?></p></small></center>
                        </td>
                        <?php
                        }else if($dated == $dateyesterday) {
                        ?>
                        <td>
                        <center><small><p><?php echo $dateyesterday ?></p></small></center>
                        </td>
                        <?php
                        }else if($dated == $dateyesterday2) {
                        ?>
                        <td>
                        <center><small><p><?php echo $dateyesterday2val ?></p></small></center>
                        </td> 
                        <?php
                        }
                        ?>
                            <td><small><a display="block" style="color:black" href="<?php echo 'Supervisor/order' ?>"><?php echo $row["log_description"];?></a></small></td>
                        <?php
                        }else{
                        ?>
                            <td><small><?php echo $row["log_description"];?></small></td>
                        <?php
                        }  
                        ?>
                        <td class="notif-delete">
                        <form action="Supervisor/delete" method="post">
                        <input type="hidden" name="log_id" value="<?php echo $row['log_id']; ?>">
                        <input type="hidden" name="log_description" value="<?php echo $row['log_description']; ?>">
                        <button class="btn-danger" type="submit" name="submit"><i class="glyphicon glyphicon-trash danger"></i></button>
                        </form>
                        </td>
                      </tr>
                    <?php 
                      }
                    }
                    ?>
                </table>
                </ul>
              </li>
              <li>
              <center>
              <form action="Supervisor/deleteall" method="post">
                        <button class="btn-danger" type="submit" name="submit"><i class="glyphicon glyphicon-trash"></i> Delete all Logs</button>
              </form>
              </center>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='user-image' height='100' src='upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='user-image' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>
				<span class="hidden-xs"><?php echo ( $this->session->userdata('fname'));?>  <?php echo ( $this->session->userdata('lname'));?></span>
              
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='img-circle' height='100' src='upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                                echo "<br>";
                        }
                ?>
				<p>
                 <?php echo ( $this->session->userdata('fname'));?>  <?php echo ( $this->session->userdata('lname'));?>
                 <small><?php echo ( $this->session->userdata('dept_name'));?> </small>
                 <small>Supervisor</small>
                </p>
              </li>
              <!-- Menu Body -->
        
              <!-- Menu Footer-->
              <li class="user-footer">
        
                <div class="pull-right">
                  <a href="<?php echo 'logout' ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i>Sign out</a>
                </div>
                <div class="pull-left">
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editprof"> <i class="fa fa-edit"></i> Edit Profile</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
    <?php $identity =  $this->session->userdata('fname');?>
 
<div class="modal fade" id="editprof">
<form name="form1" id="user_form" method="post" action="dashboard/addUser" enctype="multipart/form-data">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <div class="col-md-2">
                        <img src="assets/dist/img/user3-128x128.png" alt="User Image" style="width:80px;height:80px;">
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
                                              <center><h4><b>Update Profile</b></h4></center>
                                            </div>
                                      </div>
                 <div class="box-body">
                                  <center>
                                  <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='img-circle' height='100' src='upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                                echo "<br>";
                        }
                ?>
                <br />
                <input type="file" name="file">
                   <br /></center>
                        <?php
                          $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                          $date = date("Y/m/d");
                          $sql = "Select * from users where user_id = ".$this->session->userdata('id')."";
                          $result = $conn->query($sql);    
                        ?>
                        <?php if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) { ?>
                            
                            <div class="form-group">
                          <label hidden="true" for="exampleInputEmail1">id</label>
                          <input type="text" class="hidden" name="prevname" id="prevname" value="<?php echo $identity; ?>" />
                        </div>
                    
                       <div class="col-md-13">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Username</label>
                          <input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'] ?>" required />
                        </div>
                      </div>

                        <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="name" class="form-control" name="fname" id="fname" value="<?php echo $row['fname'] ?>" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input type="name" class="form-control" name="lname" id="lname" value="<?php echo $row['lname'] ?>" required />
                        </div>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                      <div class="form-group" style="width:100%">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $row['user_email'] ?>" required />
                        </div>
                      </div>
                
                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label>Contact Number</label>

                                                <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                  </div>
                                                  <input type="text" class="form-control" name="user_contact" id="user_contact"data-inputmask='"mask":"(9999) 999-9999"' value=" <?php echo $row['user_contact'] ?>" data-mask required>
                                                </div>
                                                <script>
                                                    $(function(){
                                                      $('[data-mask]').inputmask()
                                                    })
                                                  </script>
                                              </div>
                                               </div>
                    </div>

                    <?php $passp = $row['password'] ?>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" name="password" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" id="password" value="<?php echo $passp ?>" required />

                        <script>
                        function mouseoverPass(obj) {
                          var obj = document.getElementById('password');
                          obj.type = "text";
                        }
                        function mouseoutPass(obj) {
                          var obj = document.getElementById('password');
                          obj.type = "password";
                        }
                        </script>
                            
                        </div>
                          <?php 
                              }
                            }
                          ?>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" class="form-control" name="password2" onmouseover="mouseoverPass2();" onmouseout="mouseoutPass2();" id="password2" value="<?php echo $passp ?>" required />
                  <span id="messageConf"></span>
                    
                    <script>
                        function mouseoverPass2(obj) {
                          var obj = document.getElementById('password2');
                          obj.type = "text";
                        }
                        function mouseoutPass2(obj) {
                          var obj = document.getElementById('password2');
                          obj.type = "password";
                        }
                    </script>
                </div>
              </div>
              </div>
              <script>
                $(function () {
                    $('#password2').on('input', function () {
                      //Store the password field objects into variables ...
                      var pass1 = document.getElementById('password');
                      var pass2 = document.getElementById('password2');
                      //Store the Confimation Message Object ...
                      var message = document.getElementById('messageConf');
                      //Set the colors we will be using ...
                      var goodColor = "#66cc66";
                      var badColor = "#ff6666";
                      //Compare the values in the password field 
                      //and the confirmation field
                      if(pass1.value == pass2.value){
                          //The passwords match. 
                          //Set the color to the good color and inform
                          //the user that they have entered the correct password 
                          pass2.style.backgroundColor = goodColor;
                          message.style.color = goodColor;
                          message.innerHTML = "Passwords Match!"
                      }else{
                          //The passwords do not match.
                          //Set the color to the bad color and
                          //notify the user.
                          pass2.style.backgroundColor = badColor;
                          message.style.color = badColor;
                          message.innerHTML = "Passwords Do Not Match!"
                      }
                    });
                }); 
              </script>

              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="addUser"><i class="fa fa-edit"></i> Update</button>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </form> 
        </div>          
            
                            
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='img-circle' height='100' src='upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                                echo "<br>";
                        }
                ?>
        </div>
        <div class="pull-left info">
          <p><?php echo ( $this->session->userdata('fname'));?>  <?php echo ( $this->session->userdata('lname'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Active</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Inventory Management System</li>
	<!---------------------------------------------------- DASHBOARD MENU -------------------------------------------------------------->
        <li class= "active">
          <a href="<?php echo 'dashboard' ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
         
		<!---------------------------------------------------- SUPPLIES MENU -------------------------------------------------------------->
        <li class="treeview">
          <li class="treeview">
            <a href="#"><i class="fa fa-briefcase"></i> Supplies
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo 'Supervisor/medicalSupplies' ?>"><i class="fa fa-medkit"></i>Medical Supplies</a></li>
              <li class="treeview">
                <li><a href="<?php echo 'Supervisor/officeSupplies' ?>"><i class="fa fa-pencil-square"></i>Office Supplies</a></li>
              </li>
            </ul>
          </li>
          <li><a href="<?php echo 'Supervisor/issuedSupplies' ?>"><i class="fa fa-retweet"></i>Issued Supplies</a></li>
          <li><a href="<?php echo 'Supervisor/order' ?>"><i class="fa fa-shopping-cart"></i><span>Orders</span></a></li>

        </li>


		  <!---------------------------------------------------- CALENDAR MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'Supervisor/memo'?>">
            <i class="fa fa-tasks"></i> <span>Memo</span>
          </a>
        </li>
          <!---------------------------------------------------- LOCKSCREEN MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'Supervisor/lockscreen' ?>">
            <i class="fa fa-lock"></i> <span>Lockscreen</span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <i class="fa fa-dashboard"></i> <b>Dashboard</b>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li> 
      </ol>
    </section>

 <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT COUNT(*) AS total FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Fully Issued' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Completed Orders</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT COUNT(*) AS total FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Accepted' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result = $conn->query($sql);    
                ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Approved Orders</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-thumbs-up"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT COUNT(*) AS total FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Pending' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Pending Orders</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-spinner fa-spin"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        </div>

        <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT COUNT(*) AS total FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Partially Issued' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Partially Issued Orders</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-star-half-o"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
          
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT COUNT(*) AS total FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Declined' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result = $conn->query($sql);    
                ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Disapproved Orders</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-thumbs-down"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql1 = "SELECT COUNT(*) AS total1 FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_status = 'Fully Issued' AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result1 = $conn->query($sql1);
                  $sql2 = "SELECT COUNT(*) AS total2 FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE (inventory_order_status = 'Pending' OR inventory_order_status = 'Accepted' OR inventory_order_status LIKE '%Issue%') AND inventory_order.inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND supply_name != ''";
                  $result2 = $conn->query($sql2);    
                ?>
                <?php 
                  if ($result1->num_rows > 0) {
                    while($row = $result1->fetch_assoc()) { ?>
                      <h3><?php echo $row["total1"]; ?> /
                  <?php 
                      }
                    }
                    if ($result->num_rows > 0){
                      while($rows = $result2->fetch_assoc()){ ?>
                          <?php echo $rows["total2"] ?> </h3>
                  <?php
                      }
                    }
                  ?>

              <p>Orders Completed</p>
            </div>
            <div class="icon" style="margin-top: 15px; margin-right: 50px">
              <i class="fa fa-percent"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        </div>
        

        <section class="content">
          <div class="row">
            
          <div class="col-md-12">
            
            <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">List of Orders / Requests</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                 <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                    $today=date("Y/m/d");
                    $sql = "SELECT CONCAT(supply_name, IF((COUNT(supply_name)-1) = 0, '', CONCAT(' and ',COUNT(supply_name)-1,' other item/s.'))) AS 'Description', inventory_order_uniq_id, inventory_order_supplies_id, supply_name, unit_name, quantity, quantity_issued, inventory_order_id, inventory_order_created_date, inventory_order_name, inventory_order_dept, inventory_order_status, inventory_order_remarks, issued_date, issued_to FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) WHERE inventory_order_name LIKE CONCAT('".$this->session->userdata('fname')."', ' ' ,'".$this->session->userdata('lname')."') AND inventory_order_status != 'Fully Issued' AND inventory_order_status != '' AND quantity != 0 GROUP BY inventory_order_uniq_id";
                    $result = $conn->query($sql); 

                    // $arrayName = '';  
                    // $arrayStatus = '';
                    // $zero = 0; 
                  ?>
                  
                 <thead>
                        <tr>
                            <!-- <th>Order ID</th> -->
                            <th>Order Date & Time</th>
                            <th>Item Name/s</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                 </thead>
                    <tbody>
                      	<?php if ($result->num_rows > 0) {
                        	while($row = $result->fetch_assoc()) {
                      	?>

                        <tr>
                          <td><?php echo $row["inventory_order_created_date"];?></td>
                          <td><?php echo $row["Description"];?></td>
                          <td><?php echo $row["inventory_order_status"]; ?></td>
                          <td><?php echo $row["inventory_order_remarks"]?></td>
                          <td>
                            <div class="btn-group">
                                  <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["inventory_order_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                                </div>
                          </td>
                        </tr>
                      <?php 
                          }
                        } ?>
                    </tbody>
                    <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                   </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
        
        
          <!-- BAR CHART -->
          <div class="box box-danger">
            
            <div class="box-header with-border">
              <h3 class="box-title">Expenses of <?php echo $_SESSION['dept_name']; ?></h3>
                
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $query="SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE inventory_order.inventory_order_dept = (select dept_name from users where fname = '".$this->session->userdata('fname')."' AND lname = '".$this->session->userdata('lname')."') GROUP BY inventory_order_dept LIMIT 1";
                  $query_result=$conn->query($query);

                  $sql = "SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE supply_type = 'Medical' AND inventory_order.inventory_order_dept = (select dept_name from users where fname = '".$this->session->userdata('fname')."' AND lname = '".$this->session->userdata('lname')."') GROUP BY inventory_order_dept LIMIT 1";
                  $result = $conn->query($sql);

                  $sql2 = "SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE supply_type = 'Office' AND inventory_order.inventory_order_dept = (select dept_name from users where fname = '".$this->session->userdata('fname')."' AND lname = '".$this->session->userdata('lname')."') GROUP BY inventory_order_dept LIMIT 1";
                  $result2 = $conn->query($sql2);
                  
                  $sql3 = "select * from users join departments on users.dept_name = departments.department_name where fname = '".$this->session->userdata('fname')."' and lname = '".$this->session->userdata('lname')."' LIMIT 1";
                  $result3 = $conn->query($sql3);
                  
                  $dept = '';
                  $location = '';
                  while ($row = mysqli_fetch_array($query_result)) {
                    $location .= '"'.$row["Department"].'", ';
                  }
                  
                  while ($row = mysqli_fetch_array($result3)) {
                    $dept .= '"'.$row["dept_name"].'", ';
                  }

                  $total_data1 = '';
                  $type_data1 = '';
                  $location_data1 = '';
                  while($row = mysqli_fetch_array($result)){
                    $total_data1 .= '"'.$row["Total Expense"].'", ';
                    $type_data1 .= '"'.$row["Type"].'", ';
                    $location_data1 .= '"'.$row["Department"].'", ';
                  }
                  $total_data2 = '';
                  $type_data2 = '';
                  $location_data2 = '';
                  while($row = mysqli_fetch_array($result2)){
                    $total_data2 .= '"'.$row["Total Expense"].'", ';
                    $type_data2 .= '"'.$row["Type"].'", ';
                    $location_data2 .= '"'.$row["Department"].'", ';
                  }
                  
                  if($location == $dept){
                  $chart_data1 = $location;
                  $chart_data2 = $total_data1;
                  $chart_data3 = $total_data2;
                  }else{
                  $chart_data1 = $dept;
                  $chart_data2 = $total_data1;
                  $chart_data3 = $total_data2;
                  }
                ?>
                <canvas id="barChart" style="height:300px"></canvas>
                Legend: <i class="fa fa-square text-red"></i> Medical Supplies
                <i class="fa fa-square text-blue"></i> Office Supplies
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Top Used Supplies</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                 <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                    $sql = "SELECT supply_name, SUM(quantity), supply_type FROM users JOIN inventory_order ON CONCAT(fname, ' ',lname) = inventory_order_name JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON inventory_order_supplies.supply_name = supplies.supply_description WHERE inventory_order_status='Fully Issued' AND inventory_order_name LIKE '".$_SESSION['fname']."%' AND fname LIKE '".$_SESSION['fname']."%' GROUP BY supply_name ORDER BY SUM(quantity) DESC LIMIT 5;";
                    $result = $conn->query($sql);    
                  ?>
                 <thead>
                        <tr>
                            <th>Description</th>
                            <th>Total Qty Used</th>
                            <th>Supply Type</th>
                        </tr>
                 </thead>
                    <tbody>
                      <?php if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) { ?>
                        <tr>
                        <td><?php echo $row["supply_name"]; ?></td>
                        <td><?php echo $row["SUM(quantity)"]; ?></td>
                        <td><?php echo $row["supply_type"]; ?></td>
                        </tr>
                      <?php 
                          }
                        }
                      ?>
                    </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.col (LEFT) -->
        </div>
        <!-- /.col (RIGHT) -->
    </section>
    <!-- /.content -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
      
      <!--Main Content -->
      <!-- BAR CHARTS -->
      
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; AMDC INVENTORY MANAGEMENT SYSTEM </strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="assets/bower_components/raphael/raphael.min.js"></script>
<script src="assets/bower_components/chart.js/chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/bower_components/moment/min/moment.min.js"></script>
<script src="assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
<!-- ITO ANG LEGIT NA JAVASCRIPT NG CHARTS -->
<!-- ChartJS -->
<script src="assets/bower_components/Chart.js/Chart.js"></script>

<!-- page script -->

<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog">
        <div id="view-data"></div>
    </div>
</div>

<script>
        $(document).on('click','#getView',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#view-data').html('');
            $.ajax({
                url:'dashboard/viewList',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#view-data').html('');
                $('#view-data').html(data);
            }).final(function(){
                $('#view-data').html('<p>Error</p>');
            });
        });
    </script>

<script>
setTimeout(onUserInactivity, 1000 * 1800)
function onUserInactivity() {
  <?php unset($_SESSION['logged_in']);
  if(!isset($_SESSION['logged_in'])) { ?>
    window.location.href = "Supervisor/lockscreen"
   <?php } ?>
}
</script>

<!-- <script type="text/javascript">
setTimeout(onUserInactivity, 1000 * 120)
function onUserInactivity() {
   window.location.href = "<?php //echo 'BusinessManager/lockscreen'?>"
}
</script> -->
<!-- <?php
//$time = $_SESSION['Time'];
//$time_check=$time-120;
//if($time<$time_check) {
//  $_SESSION['login'] = 'False';
//  if($_SESSION['login'] == 'False'){
//    echo '<script>window.location.href="<?php echo "BusinessManager/lockscreen" ?>"</script>';
  }
}
  ?> -->
<!-- <script type="text/javascript">
inactivityTimeout = False
resetTimeout()
function onUserInactivity() {
   window.location.href = "lockscreen"
}
function resetTimeout() {
   clearTimeout(inactivityTimeout)
   inactivityTimeout = setTimeout(onUserInactivity, 1000 * 120)
}
window.onmousemove = resetTimeout
</script> -->
<!--- CHARTS -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var barChart       = new Chart(barChartCanvas);
    var param1 = [<?php echo $chart_data1; ?>];
    var param2 = [<?php echo $chart_data2; ?>];
    var param3 = [<?php echo $chart_data3; ?>];

    var barChartData = {
      labels  : param1,
      datasets: [
        {
          label               : 'Medical Supplies',
          fillColor           : 'rgb(242, 65, 65)',
          strokeColor         : 'rgb(242, 65, 65)',
          pointColor          : 'rgb(242, 65, 65)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : param2
        },
        {
          label               : 'Office Supplies',
          fillColor           : 'rgb(65, 65, 242)',
          strokeColor         : 'rgb(65, 65, 242)',
          pointColor          : 'rgb(65, 65, 242)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : param3
        }
      ]
      
    }

    var barChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
    <!-- InputMask -->
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- DATA TABLES -->
<script>
  $(function () {
    $('#example1').DataTable({
    	order : [[ 0, 'desc' ]]
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
        $(document).on('click','#getAdd',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'dashboard/addUser',
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
</body>
</html>
