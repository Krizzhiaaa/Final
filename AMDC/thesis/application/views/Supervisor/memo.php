<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Supervisor | Memo</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <script src="../assets/jquery/jquery-1.12.4.js"></script>
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">
  <!-- datatable lib -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
   <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
</head>
<body>
    <body class="hold-transition skin-blue sidebar-mini">
      <?php  
      $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
      if(isset($_SESSION['logged_in']))  
      {  
           //echo 'dashboard';
      }  
      else if(!isset($_SESSION['logged_in'])) 
      {?>  
           <script>window.location.href = "lockscreen"</script>
           <?php    
      }  
      ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo '../dashboard' ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>MDC</span>
      <!-- logo for regular state and mobile devices -->
     <span class="logo-lg"><img src="../assets/dist/img/amdc2.png" alt="User Image" style="width:160px;height:49px;"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <li class= "user user-menu">
                    <a class = "dropdown-toggle">
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
                            <td><small><a display="block" style="color:black" href="<?php echo 'order' ?>"><?php echo $row["log_description"];?></a></small></td>
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
              <form action="deleteall" method="post">
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
                                        echo "<img width='100' class='user-image' height='100' src='../upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='user-image' src='../upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>
              <span class="hidden-xs"><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?></span>
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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='../upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>

               <p><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?>
                  <small><?php echo ( $this->session->userdata('dept_name'));?> </small>
        <small> Supervisor</small>
        </p>
                </li>
                
              <!-- Menu Footer-->
              <li class="user-footer">
        
                <div class="pull-right">
                  <a href="<?php echo '../logout' ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
                <div class="pull-left">
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editprof"><i class="fa fa-edit"></i> Edit Profile</button>
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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='../upload/".$row['image']."' alt='Profile Pic'>";
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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default3.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='../upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>
        </div>
        <div class="pull-left info">
          <p><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Inventory Management System</li>
    <!---------------------------------------------------- DASHBOARD MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo '../dashboard' ?>">
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
              <li><a href="<?php echo 'medicalSupplies' ?>"><i class="fa fa-medkit"></i>Medical Supplies</a></li>
              <li class="treeview">
                <li><a href="<?php echo 'officeSupplies' ?>"><i class="fa fa-pencil-square"></i>Office Supplies</a></li>
              </li>
            </ul>
          </li>
          <li><a href="<?php echo 'issuedSupplies' ?>"><i class="fa fa-retweet"></i>Issued Supplies</a></li>
          <li><a href="<?php echo 'order' ?>"><i class="fa fa-shopping-cart"></i><span>Orders</span></a></li>

        </li>
		
	    <!---------------------------------------------------- CALENDAR MENU -------------------------------------------------------------->
        <li class="active">
          <a href="<?php echo 'memo'?>">
            <i class="fa fa-tasks"></i> <span>Memo</span>
          </a>
        </li>
          <!---------------------------------------------------- LOCKSCREEN MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'lockscreen' ?>">
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
       <i class="fa fa-tasks"></i> <b>Memo</b>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><i class="fa fa-tasks"></i> Memo</li>
      </ol>
    </section>

     <!-- Main content -->
     
<section class="content">
       <div class="row">
          <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Office Supplies</h3> -->
                <table style="float:right;">
                    <tr>
                      <th><button type="submit" class="btn btn-primary btn-block btn-success" data-toggle="modal" data-target="#modal-info"><i class="glyphicon glyphicon-plus"></i> Add New Memo</button>
                        
                        <form name="form1" id="user_form" method="post" action="memo/addMemo">
                        <div class="modal fade" id="modal-info">
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
                                              <center><h4><b>Add New Memo</b></h4></center>
                                            </div>
                                      </div>
                                        <!-- end of modal header -->
                                        <div class="box-body">
                                                                     <div class="form-group" hidden>
                                                  <label for="exampleInputEmail1">User Name</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>
                                                  <input type="text" class="form-control" id="memo_user" name="memo_user" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </div>
                                              </div>

                                                  <div class="form-group">
                                                    <label>Date & Time Created</label>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <?php
                                                        date_default_timezone_set('Asia/Manila');
                                                       $date = date('Y-m-d H:i:s'); 
                                                       ?>
                                                      <input type="text" class="form-control pull-right" id="memo_date" name="memo_date" value="<?php echo $date; ?>" readonly>
                                                    </div>
                                                    <!-- /.input group -->
                                                  </div>
                                    
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1">Memo Title (Limit to 20 Characters)</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-pencil-square"></i>
                                                      </div>
                                                  <input type="text" class="form-control" id="memo_title" name="memo_title" maxlength="20" required>
                                              </div>
                                              </div>


                                                <div class="form-group">
                                                    
                                                  <label for="exampleInputEmail1">Description</label>
                                               
                                                  <textarea type="name" class="form-control" name="memo_description" id="memo_description" rows="15" cols="83" required /> </textarea>

                                                </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> <i class="fa fa-times-circle"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" name="addMemo"><i class="fa fa-plus"> </i> Add</button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>


                                </form>
                            </th> 
                    </tr>
                </table> 
            </div>
            <!-- /.box-header -->
               <span id="alert_action"></span>
              <div class="box-body">
              <table id="example"  class="table table-bordered table-striped" >
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT * FROM memo WHERE soft_deleted = 'N' AND memo_user='".$this->session->userdata('fname')." ".$this->session->userdata('lname')."'";
                  $result = $conn->query($sql);    
                ?>
                <thead>
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>Date & Time Created</th>
                        <th>Memo Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <?php
                        $status = '';
                          if($row["memo_status"] == 'Finished')
                          {
                              $status = '<span class="label label-success">Finished</span>';
                          }
                          else
                          {
                              $status = '<span class="label label-danger">Pending</span>';
                          }
                      ?>
                      <td style="display: none;"><?php echo $row["memo_id"];?></td>
                      <td><?php echo $row["memo_date"]; ?></td>
                      <td><?php echo $row["memo_title"]; ?></td>
                      <td><?php echo $status; ?></td>
                      <td>
                        <?php if($row['memo_status'] == 'Pending'){ ?>
                        <div class="btn-group">
                          <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["memo_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["memo_id"]; ?>"><i class="fa fa-edit"></i> Update</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" name="update" id="getUpdate" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalUpdate" data-id="<?php echo $row["memo_id"]; ?>"><i class="fa fa-flag-checkered"></i> Mark Finish</button>
                        </div>
                        <div class="btn-group">
                          <button type="button" id="getDelete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete" data-id="<?php echo $row["memo_id"]; ?>"><i class="glyphicon glyphicon-trash"></i> Archive</button>
                        </div>
                      <?php }elseif($row['memo_status'] == 'Finished'){ ?>
                        <div class="btn-group">
                         <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["memo_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                       </div>
                        
                        <div class="btn-group">
                          <button type="button" id="getDelete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete" data-id="<?php echo $row["memo_id"]; ?>"><i class="glyphicon glyphicon-trash"></i> Archive</button>
                        </div>
                      <?php }?>
                      </td>
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
                  <tfoot>
                   <th style="display: none;">ID</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                </tfoot>
              </table>
            </table>

            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
          <div class="row no-print">
        <div class="col-xs-1" style="float:left">
            <a href="memoRecover" style="color:white;">
              <button type="button" class="btn btn-danger pull-left" style="margin-right: 1px;"><i class="fa fa-trash"></i> Archived Memo </button>
            </a>
      </div>
      </div>    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; AMDC INVENTORY MANAGEMENT SYSTEM </strong> All rights
    reserved.
  </footer>
<style>

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 24px;
}

.slider.round:before {
  border-radius: 50%;
}    
</style>
        

        
<!-- jQuery 3 -->
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- Select2 -->
<script src="../assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- bootstrap datepicker -->
<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
    <!-- bootstrap time picker -->
<script src="../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- page script -->

<script>
setTimeout(onUserInactivity, 1000 * 1800)
function onUserInactivity() {
  <?php unset($_SESSION['logged_in']);
  if(!isset($_SESSION['logged_in'])) { ?>
    window.location.href = "lockscreen"
   <?php } ?>
}
</script>
 
<script>
      $(function () {
        $('#example').DataTable({
          order : [[ 0, 'desc' ]],
          "lengthMenu": [[10, 20, 30, 40, 50, 60, 70, 80, 90, 100, -1], [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, "All"]]
        })
      })
    </script>

<script>
 // date and time
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true
    })
      
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

        <!--create modal dialog for display detail info for edit on button cell click-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>

        <div class="modal fade" id="modalUpdate" role="dialog">
            <div class="modal-dialog">
                <div id="data-content"></div>
            </div>
        </div>

        <div class="modal fade" id="modalDelete" role="dialog">
            <div class="modal-dialog">
                <div id="delete-content"></div>
            </div>
        </div>


   <!-- <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"memo/getMemo",
                    type:"post"
                }
            });
        });
    </script>

     <!--script js for get edit data-->
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'memo/editMemo',
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

    <script>
        $(document).on('click','#getUpdate',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#data-content').html('');
            
              $.ajax({
                  url:'memo/getChange',
                  type:'POST',
                  data:'id='+per_id,
                  dataType:'html'
              }).done(function(data){
                  $('#data-content').html('');
                  $('#data-content').html(data);
              }).final(function(){
                  $('#data-content').html('<p>Error</p>');
              });
            
        });
    </script>

    <script>
        $(document).on('click','#getDelete',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#delete-content').html('');
            
              $.ajax({
                  url:'memo/deleteMemo',
                  type:'POST',
                  data:'id='+per_id,
                  dataType:'html'
              }).done(function(data){
                  $('#delete-content').html('');
                  $('#delete-content').html(data);
              }).final(function(){
                  $('#delete-content').html('<p>Error</p>');
              });
            
        });
    </script>

 </body>
</html>

<?php
$con=mysqli_connect('localhost','root','','itproject');
if(isset($_POST['btnEdit'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $new_memodate=mysqli_real_escape_string($con,$_POST['txtmemodate']);
    $new_memodescription=mysqli_real_escape_string($con,$_POST['txtmemodescription']);

    $new_memotitle=mysqli_real_escape_string($con,$_POST['txtmemotitle']);


    $sqlupdate="UPDATE memo SET memo_date ='$new_memodate',memo_description='$new_memodescription', memo_title='$new_memotitle' WHERE memo_id='$new_id' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A memo has been edited','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="memo"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}


if(isset($_POST['btnUpdate'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $new_memostatus=mysqli_real_escape_string($con,$_POST['txtmemostatus']);

    if($new_memostatus == 'Finished'){
      $new_memostatus = 'Pending';
    }elseif($new_memostatus == 'Pending'){
      $new_memostatus = 'Finished';
    }else{
      $new_memostatus = 'Finished';
    }

    $sqlupdate="UPDATE memo SET memo_status='$new_memostatus' WHERE memo_id='$new_id' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A memo status has been changed to ".$new_memostatus."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="memo"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}


if(isset($_POST['memDelete'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);

    $sqlupdate="UPDATE memo SET soft_deleted='Y' WHERE memo_id='$new_id' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A memo has been archived','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="memo"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}

?>

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
                url:'memo/viewMemo',
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
