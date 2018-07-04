<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Business Manager | Deliveries</title>
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

  <?php
  $_SESSION['logged_in'] = 'True';
    $logged_in = $_SESSION['logged_in'];
    if($logged_in = 'False'){
  ?>
  <script>
    history.forward();
  </script>
  <?php }elseif ($logged_in = 'True') {
  ?>
    <script>
    history.back();
  </script>
  <?php
  } ?>
  
    
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
        <span class="logo-lg"><img src="../assets/dist/img/amdc2.png" alt="User Image" style="width:160px;height:50px;"></span>
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
          <!--        BELL START-->
         <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                $dtoday = date('Y\-m\-d\ H:i:s A');
                $date_select = date('Y\-m\-d\ H:i:s A', strtotime('-3 days') ) ;//minus three days
                $sql6 = "SELECT COUNT(*) AS total from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND (log_description like '%order%' OR log_description like '%profile%') <> (log_description like '%accepted%' OR log_description like '%declined%')";
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
                    $sql7 = "select log_id,log_date,log_description from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND (log_description like '%order%' OR log_description like '%profile%') <> (log_description like '%accepted%' OR log_description like '%declined%')";
                    $result7 = $conn->query($sql7);
                    ?>
                    <?php 
                      if ($result7->num_rows > 0) {
                       while($row = $result7->fetch_assoc()) {
                        $logvalue = $row["log_description"];
                    ?>
                      <tr>
                        <?php
                        if(strpos($logvalue, 'order') !== false) { ?>
                            <td><small><a display="block" style="color:black" href="<?php echo 'departmentsOrder' ?>"><?php echo $row["log_description"];?></a></small></td>
                        <?php
                        }else if(strpos($logvalue, 'profile') !== false){
                        ?>
                            <td><small><a display="block" style="color:black" href="<?php echo 'BusinessManager/userAccounts' ?>"><?php echo $row["log_description"];?></a></small></td>
                        <?php
                        }else{
                        ?>
                            <td><small><?php echo $row["log_description"];?></small></td>
                        <?php
                        }  
                        ?>
                        <td class="notif-delete">
                        <form action="delete" method="post">
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
              <li class="footer"><a href="<?php echo 'logs' ?>">View all Logs</a></li>
              <li>
              <center>
              <form action="deleteall" method="post">
                        <button class="btn-danger" type="submit" name="submit"><i class="glyphicon glyphicon-trash"></i> Delete all Logs</button>
              </form>
              </center>
              </li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!--            FLAG START-->
                    <?php
                        $conn =mysqli_connect("localhost","root","");
                        mysqli_select_db($conn, "itproject");
                        $sql32 = "SELECT value2 from defaults where attribute = 'expirerange' LIMIT 1";
                        $result32 = $conn->query($sql32);
                          if ($result32->num_rows > 0) {
                            while($row = $result32->fetch_assoc()) {
                                $daysvalue = strtotime($row['value2']);
                                $num1 = 0;
                            }
                          }
                    ?>
                  <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                $dtoday = date("Y/m/d");
                $date_futr = date("Y-m-d", strtotime('+30 days') ) ;
                $date_past = date("Y-m-d", strtotime('-1 year') ) ;
                $date_select = date("Y-m-d", strtotime('-3 days') ) ;//minus three days
                $sql5 = "SELECT COUNT(*) AS total from supplies where accounted_for = 'N' group by supply_description having SUM(quantity_in_stock) < MAX(reorder_level) order by SUM(quantity_in_stock)/MAX(reorder_level)";
                $number1 = $conn->query($sql5);
                if ($number1->num_rows > 0) {
                        while($row = $number1->fetch_assoc()) {
                            $num1 = $row["total"];
                        }
                }
                $sqlfive = "SELECT COUNT(*) AS total from supplies where (expiration_date BETWEEN '".$dtoday."' AND '".$date_futr."')";
                $number2 = $conn->query($sqlfive);
                if ($number2->num_rows > 0) {
                        while($row = $number2->fetch_assoc()) {
                            $num2 = $row["total"];
                        }
                }
                $sqlV = "SELECT COUNT(*) AS total from supplies where (expiration_date BETWEEN '".$date_past."' AND '".$dtoday."') AND soft_deleted = 'N'";
                $number3 = $conn->query($sqlV);
                if ($number3->num_rows > 0) {
                        while($row = $number3->fetch_assoc()) {
                            $num3 = $row["total"];
                        }
                }
                $flagtotal = $num1 + $num2 + $num3;
                ?>
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"><?php echo $flagtotal ?></span>
            </a>
            <ul class="dropdown-menu">
               <?php
                    $conn =mysqli_connect("localhost","root","");
                    mysqli_select_db($conn, "itproject");
                        $sql2 = "select supply_description,SUM(quantity_in_stock) as `totalstock`,MAX(reorder_level) as `maximumreorder`,accounted_for as `expired` from supplies where accounted_for = 'N' group by supply_description having SUM(quantity_in_stock) < MAX(reorder_level) order by SUM(quantity_in_stock)/MAX(reorder_level)";
                    $result2 = $conn->query($sql2);
                  ?>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!-- Task item reorder levels-->
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <h5 style="padding:3px;margin:3px;">Items below reorder level</h5>
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <li>
                    <?php 
                      if ($result2->num_rows > 0) {
                        while($row = $result2->fetch_assoc()) { ?>
                          <?php echo $row["supply_description"]; 
                                $newvalue = $row["totalstock"] * 100;
                                $percentage = $newvalue / $row["maximumreorder"];
                          ?>
                        <!--Reorder level meter-->
                      <?php
                      if($percentage < 25){
                      ?>
                      <small class="pull-right"><?php echo number_format($percentage) ?>%</small>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: <?php echo $percentage ?>%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <?php
                      }else if($percentage < 50){?>
                      <small class="pull-right"><?php echo number_format($percentage) ?>%</small>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: <?php echo $percentage ?>%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <?php
                      }else if($percentage < 100){?>
                      <small class="pull-right"><?php echo number_format($percentage) ?>%</small>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: <?php echo $percentage ?>%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                    <?php
                      }
                    }
                    }else{
                    ?>
                    <div>
                    <center><h5 style="color:B11C1C">No items to display</h5></center>
                    </div>
                    <?php    
                    }
                    ?>
                  </li>
                  <!-- end task item expiration notification-->
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <h5 style="padding:3px;margin:3px;">Items nearing expiration</h5>
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <?php
                        $conn =mysqli_connect("localhost","root","");
                        mysqli_select_db($conn, "itproject");
                        $sql3 = "SELECT supply_description,expiration_date from supplies where expiration_date > 0 order by expiration_date";
                        $result3 = $conn->query($sql3);
                        $strdatetoday = strtotime(date("Y/m/d"));
                        $strdatefuture = $strdatetoday + $daysvalue;//today + 30 days
                    ?>
                    <table id="exp" class="table table-bordered table-striped">
                    <small>
                            <?php 
                              if ($result3->num_rows > 0) {
                                while($row = $result3->fetch_assoc()) {
                                    $expdate = strtotime($row["expiration_date"]);
                                    $expvalue = abs((($expdate - $strdatetoday) / $daysvalue)*100);
                                if(($expdate >= $strdatetoday) && ($expdate <= $strdatefuture)) {
                            ?>
                                  <tr>
                                  <td><?php echo $row["supply_description"]; ?></td>
                                  <td><?php echo $row["expiration_date"]; ?></td>
                                  </tr>
                                    <!--Expiration meter-->
                                    <?php
                                      if($expvalue < 25){
                                    ?>
                                    <tr>
                                    <td><small class="pull-left"><?php echo number_format($expvalue) . "% to Exp"?></small></td>
                                    <td><div class="progress xs">
                                      <div class="progress-bar progress-bar-red" style="width: <?php echo $expvalue ?>%" role="progressbar"
                                           aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                    </div></td>
                                    </tr>
                                    <?php
                                      }else if($expvalue < 50){?>
                                    <tr>
                                    <td><small class="pull-left"><?php echo number_format($expvalue) . "% to Exp"?></small></td>
                                    <td><div class="progress xs">
                                      <div class="progress-bar progress-bar-yellow" style="width: <?php echo $expvalue ?>%" role="progressbar"
                                           aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                    </div></td>
                                    </tr>  
                                    <?php
                                      }else if($expvalue < 100){?>
                                    <tr>
                                    <td><small class="pull-left"><?php echo number_format($expvalue) . "% to Exp"?></small></td>
                                    <td><div class="progress xs">
                                      <div class="progress-bar progress-bar-green" style="width: <?php echo $expvalue ?>%" role="progressbar"
                                           aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                    </div></td>
                                    </tr>
                                    <?php
                                    }
                                    }
                                }
                              }else{
                            ?>
                                <div>
                                <center><h5 style="color:B11C1C">No items to display</h5></center>
                                </div>
                            <?php      
                              }
                            ?>
                    </small>
                    </table>
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <h5 style="padding:3px;margin:3px;">Expired Items</h5>
                    <hr style="padding:0;margin:0;border-width:4px;border-color:black;">
                    <?php
                        $conn =mysqli_connect("localhost","root","");
                        mysqli_select_db($conn, "itproject");
                        $sql4 = "SELECT supply_description,expiration_date from supplies where expiration_date > 0 AND soft_deleted = 'N'";
                        $result4 = $conn->query($sql4);
                        $strdatetoday = strtotime(date("Y/m/d"));
                    ?>
                    <table id="expdue" class="table table-bordered table-striped">
                    <small>
                            <?php 
                              if ($result4->num_rows > 0) {
                                while($row = $result4->fetch_assoc()) {
                                    $expdate = strtotime($row["expiration_date"]);
                                if($expdate < $strdatetoday){
                            ?>
                                  <tr class="danger">
                                  <td><?php echo $row["supply_description"]; ?></td>
                                  <td><?php echo $row["expiration_date"]; ?></td>
                                  </tr>
                            <?php
                                }
                              }
                            }else{
                            ?>
                            <div>
                            <center><h5 style="color:B11C1C">No items to display</h5></center>
                            </div>
                            <?php
                            }
                            ?>
                    </small>
                    </table>
                </ul>
              </li>
            </ul>
          </li>
<!--          FLAG END-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/dist/img/user2-128x128.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/dist/img/user2-128x128.png" class="img-circle" alt="User Image">

                <p><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?>
                  <small><?php echo ( $this->session->userdata('dept_name'));?> </small>
        <small> Business Manager</small>
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
<form name="form1" id="user_form" method="post" action="dashboard/addUser">
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
                          <label for="exampleInputEmail1">Contact Number</label>
                          <input type="text" class="form-control" name="user_contact" id="user_contact" value="<?php echo $row['user_contact'] ?>" pattern="^[0-9]{11}$" required />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" name="password" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" id="password" value="<?php echo $row['password'] ?>" required />

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
              </div>
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
          <img src="../assets/dist/img/user2-128x128.png" class="img-circle" alt="User Image">
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
  <!---------------------------------------------------- USER ACCOUNTS MENU -------------------------------------------------------------->
        <li>
              <a href="<?php echo 'userAccounts' ?>">
                  <i class="fa fa-group"></i><span>Manage Accounts</span>  
              </a>
          </li>
  
    <!---------------------------------------------------- SUPPLIES MENU -------------------------------------------------------------->
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
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
            <li><a href="<?php echo 'inventoryReconciliation' ?>"><i class="glyphicon glyphicon-adjust"></i>Inventory Reconciliation</a></li>
            <li><a href="<?php echo 'issuedSupplies' ?>"><i class="fa fa-retweet"></i>Issued Supplies</a></li>
      <li><a href="<?php echo 'departmentsOrder' ?>"><i class="fa fa-list"></i>Deparments Order</a></li>
      <li><a href="<?php echo 'purchases' ?>"><i class="fa fa-shopping-cart"></i>Purchase Orders</a></li>
      <li class="active"><a href="<?php echo 'deliveries' ?>"><i class="fa fa-truck"></i>Deliveries</a></li>
          </ul>
        </li>
    <!---------------------------------------------------- SUPPLIERS MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'suppliers' ?>">
            <i class="fa fa-user"></i> <span>Suppliers</span>
          </a>
        </li>
    <!---------------------------------------------------- DEPARTMENTS MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'departments' ?>">
            <i class="fa fa-building"></i> <span>Departments</span>
          </a>
        </li>
    <!---------------------------------------------------- CALENDAR MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'memo' ?>">
            <i class="fa fa-tasks"></i> <span>Memo</span>
          </a>
        </li>

        <!---------------------------------------------------- INVOICE MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'logs' ?>">
            <i class="fa fa-list-alt"></i> <span>Logs</span>
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
        <i class="fa fa-truck"></i> <b>Deliveries</b>
        <!-- <small>advanced tables</small> -->
      </h1>
        
     <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-truck"></i> Deliveries</li>
      </ol>
    </section>
    <!-- Main content -->
      <section class="content">
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <span id="alert_action"></span>
              <div class="box-body w3-hide">
              <table id="example1"  class="table table-bordered table-striped" >
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT * FROM purchase_orders JOIN purchase_order_bm USING(purchase_order_uniq_id) WHERE soft_deleted='N' GROUP BY purchase_order_uniq_id";
                  $result = $conn->query($sql);    
                ?>
                <thead>
                  <tr>
                        <th>Purchase ID</th>
                        <th>Item name/s</th>
                        <th>Supplier</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $row["purchase_order_uniq_id"]; ?></td>
                      <td><?php echo $row["description"]?></td>
                      <td><?php echo $row["supplier"]; ?></td>
                      <td><?php echo $row["order_date"]; ?></td>
                      <td><?php echo $row["delivery_date"]; ?></td>
                      <td><?php echo $row["po_remarks"]; ?></td>
                      <td><?php echo $row["item_delivery_remarks"]; ?></td>
                      <td>
                        <?php if ($row["item_delivery_remarks"] == 'Full' ) {?>
                        <div class="btn-group">
                            <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-search"></i> View</button>
                        </div>
                        <div class="btn-group">
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-undo"></i> Return</button>
                          </div>
                        <?php }elseif ($row["item_delivery_remarks"] == 'Partial'){ ?>
                        <!-- <div class="btn-group">
                              <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-plus-circle"></i> Add New Delivery</button>
                          </div>

                          </div> -->
                          <div class="btn-group">
                              <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-search"></i> View</button>
                          </div>
                          <div class="btn-group">
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-undo"></i> Return</button>
                          </div>
                        <?php }else{?>
                          <!-- <div class="btn-group">
                              <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-check"></i> Check</button>
                          </div> -->
                          <div class="btn-group">
                              <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-search"></i> View</button>
                          </div>
                          <div class="btn-group">
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-undo"></i> Return</button>
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
                  <tr>
                        <th style="display: none;">ID</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                  </tr>
                </tfoot>
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
        <div class="col-xs-1" style="float:right">
          <!-- <a href="#" id="print" onclick="javascript:printlayer('example')" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <button  type="submit" class="btn btn-default btn-flat pull-right" data-toggle="modal" data-target="#printrep"><i class="fa fa-print"></i> Generate Report</button>
        </div>

      </div>
      <div>
          <!-- <button  type="submit" class="btn btn-default btn-flat pull-right" data-toggle="modal" data-target="#printrep"><i class="fa fa-print"></i> Generate Report</button> -->
        </div>
      <script>
        $('#print').click(function(){
          var printme = document.getElementById('example1');
          var wme = window.open("","","width=900,height=700");
          wme.document.write(printme.outerHTML);
          wme.document.close();
          wme.focus();
          wme.print();
          wme.close();
        })
      </script>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="modal fade" id="printrep">
<form name="form42" id="user_form" method="post" action="deliveries/generated">
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
                                              <center><h4><b>Generate Deliveries Report</b></h4></center>
                                            </div>
                                      </div>
                        <div class="box-body">
                
                        <div class="row">
                          <h4><b>Include dates within:</b></h4>
                          <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <?php
                            $datetoday = date('Y\-m\-d', strtotime('-30 days') );
                            ?>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" class="form-control pull-right datepicker2" name="date1" id="date1" value="">
<!--
                                <script>
                                jQuery(function() {
                                  var datepicker = $('input.datepicker2');

                                  if (datepicker.length > 0) {
                                    datepicker.datepicker({
                                      format: "yyyy-mm-dd",
                                      startDate: new Date()
                                    });
                                  }
                                });
                                </script>
-->
                            </div>
                          </div>
                          </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <?php
                                $deyto = date("Y/m/d");
                              ?>
                              <input type="text" class="form-control pull-right datepicker"  name="date2" id="date2" value="<?php echo $deyto?>">
                            </div>
                          </div>
                          </div>
                    <div class="col-md-6">
                    <h4><b>Include:</b></h4>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="order_date" checked>Purchase Date
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="purchase_order_status" checked>Status
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="description" checked>Description
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="order_quantity" checked>Quantity Ordered
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="quantity_delivered" checked>Quantity Delivered
                        </div>
                      </div>
                    </div>
                     </div>   
    
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT * FROM purchase_orders po join purchase_order_bm pob USING(purchase_order_uniq_id) where po.description != '' AND po_remarks = 'Delivered'";
                  $result = $conn->query($sql);    
                ?>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="generated"><i class="fa fa-clone"></i> Generate</button>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
    </div>
          <!-- /.modal-dialog -->
        </form> 
        </div>
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
<!-- date and time -->
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

    <script>
      $(function () {
        $('#example1').DataTable({
          'order' : [[ 0, 'desc' ]],
        })
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'info'        : true,
          'autoWidth'   : false
        })


      })
    </script>
<script>
//date and time 
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
            <div class="modal-dialog" style="position: absolute;margin-left: 15%;">
                <div id="content-data"></div>
            </div>
        </div>
        <div class="modal fade" id="viewModal" role="dialog">
            <div class="modal-dialog" style="position: absolute;margin-left: 20%;">
                <div id="view-data"></div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog">
                <div id="delete-data"></div>
            </div>
        </div>
        <div class="modal fade" id="returnModal" role="dialog">
            <div class="modal-dialog" style="position: absolute;margin-left: 20%;">
                <div id="return-data"></div>
            </div>
        </div>   
    <!--<script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"purchases/getPurchases",
                    type:"post"
                }
            });
        });
    </script>-->

    <!--script js for get edit data-->
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'deliveries/editDelivery',
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
        $(document).on('click','#getView',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#view-data').html('');
            $.ajax({
                url:'deliveries/viewDelivery',
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
        $(document).on('click','#getDelete',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#delete-data').html('');
            $.ajax({
                url:'deliveries/deleteDelivery',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#delete-data').html('');
                $('#delete-data').html(data);
            }).final(function(){
                $('#delete-data').html('<p>Error</p>');
            });
        });
    </script>

    <script>
        $(document).on('click','#getReturn',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#return-data').html('');
            $.ajax({
                url:'deliveries/returnDelivery',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#return-data').html('');
                $('#return-data').html(data);
            }).final(function(){
                $('#return-data').html('<p>Error</p>');
            });
        });
    </script>

</body>
</html>

<?php
$con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
if(isset($_POST['btnEdit'])){
    $new_purchaseID=mysqli_real_escape_string($con,$_POST['txtid']);
    $delBy=mysqli_real_escape_string($con,$_POST['txtdelBy']);
    $ordrNo=mysqli_real_escape_string($con,$_POST['txtordr']);

    $new_id=mysqli_real_escape_string($con,$_POST['txtpoid0']);
    $new_status=mysqli_real_escape_string($con,$_POST['txtstatus0']);
    $new_quantity=mysqli_real_escape_string($con,$_POST['txtquantity0']);
    $new_quantityDelivered=mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $new_notes=mysqli_real_escape_string($con,$_POST['txtnotes0']);
    $quantity_returned = mysqli_real_escape_string($con,$_POST['txtquantity0']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $amount= mysqli_real_escape_string($con,$_POST['unit_price0']);
    $total = $quantity_returned*$amount;
    $supplierid=mysqli_real_escape_string($con,$_POST['txtsupplierid0']);
    $suppliesid=mysqli_real_escape_string($con,$_POST['txtsuppliesid0']);
    $addstock=mysqli_real_escape_string($con,$_POST['txtstock0']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $new_supid=mysqli_real_escape_string($con,$_POST['txtsupid0']);
    $new_pokey=mysqli_real_escape_string($con,$_POST['txtpokey0']);
    $new_inputExp=mysqli_real_escape_string($con,$_POST['txtexpiration0']);
    $new_OrigExp=mysqli_real_escape_string($con,$_POST['txtexpire0']);
    $description=mysqli_real_escape_string($con,$_POST['txtdesc0']);
    $brand=mysqli_real_escape_string($con,$_POST['txtbrand0']);
    $unit=mysqli_real_escape_string($con,$_POST['txtunit0']);
    $stock=mysqli_real_escape_string($con,$_POST['txtstock0']);
    $date = date("Y-m-d"); 


    // if for index 0
    if($new_quantity == $new_quantityDelivered){
      $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);

      $sqldeliveries="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes."', '".$new_id."', '".$supplierid."', '".$new_pokey."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery=mysqli_query($con,$sqldeliveries);

      if($new_inputExp == $new_OrigExp){
         $sqladd="UPDATE supplies SET quantity_in_stock='$addstock' WHERE supply_id='$new_supid' ";
      $result_add=mysqli_query($con,$sqladd);
      }else{
        $sqlexp="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description, $brand, $unit, $stock, $amount, $new_inputExp, $new_purchaseID, $supplierid)";
        $resultexp=mysqli_query($con,$sqlexp);
      }
    }else {
      $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);

      $sqldeliveries="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key) VALUES (CURDATE(), 'Partial', '".$new_notes."', '".$new_id."', '".$supplierid."', '".$new_pokey."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery=mysqli_query($con,$sqldeliveries);
      
      if($new_inputExp == $new_OrigExp){
        $sqladd="UPDATE supplies SET quantity_in_stock='$addstock' WHERE supply_id='$new_supid' ";
        $result_add=mysqli_query($con,$sqladd);
      }else{
        $sqlexp="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description, $brand, $unit, $stock, $amount, $new_inputExp, $new_purchaseID, $supplierid)";
        $resultexp=mysqli_query($con,$sqlexp);
      }

    }

    $new_id1=mysqli_real_escape_string($con,$_POST['txtpoid1']);
    $new_status1=mysqli_real_escape_string($con,$_POST['txtstatus1']);
    $new_quantity1=mysqli_real_escape_string($con,$_POST['txtquantity1']);
    $new_quantityDelivered1=mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $new_notes1=mysqli_real_escape_string($con,$_POST['txtnotes1']);
    $quantity_returned1 = mysqli_real_escape_string($con,$_POST['txtquantity1']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $amount1= mysqli_real_escape_string($con,$_POST['unit_price1']);
    $total1 = $quantity_returned1*$amount1;
    $supplierid1=mysqli_real_escape_string($con,$_POST['txtsupplierid1']);
    $suppliesid1=mysqli_real_escape_string($con,$_POST['txtsuppliesid1']);
    $addstock1=mysqli_real_escape_string($con,$_POST['txtstock1']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $new_supid1=mysqli_real_escape_string($con,$_POST['txtsupid1']);
    $new_pokey1=mysqli_real_escape_string($con,$_POST['txtpokey1']);
    $new_inputExp1=mysqli_real_escape_string($con,$_POST['txtexpiration1']);
    $new_OrigExp1=mysqli_real_escape_string($con,$_POST['txtexpire1']);
    $description1=mysqli_real_escape_string($con,$_POST['txtdesc1']);
    $brand1=mysqli_real_escape_string($con,$_POST['txtbrand1']);
    $unit1=mysqli_real_escape_string($con,$_POST['txtunit1']);
    $stock1=mysqli_real_escape_string($con,$_POST['txtstock1']);
    
    // if for index 1
    if($new_quantity1 == $new_quantityDelivered1){
      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1' WHERE po_id='$new_id1' ";
      $result_update1=mysqli_query($con,$sqlupdate1);

      $sqldeliveries1="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key) VALUES (CURDATE(), 'Full', '".$new_notes1."', '".$new_id1."', '".$supplierid1."', '".$new_pokey1."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery1=mysqli_query($con,$sqldeliveries1);

      if($new_inputExp1 == $new_OrigExp1){
         $sqladd1="UPDATE supplies SET quantity_in_stock='$addstock1' WHERE supply_id='$new_supid1' ";
      $result_add1=mysqli_query($con,$sqladd1);
      }else{
        $sqlexp1="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description1, $brand1, $unit1, $stock1, $amount1, $new_inputExp1, $new_purchaseID, $supplierid1)";
        $resultexp1=mysqli_query($con,$sqlexp1);
      }
    }else {
      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1' WHERE po_id='$new_id1' ";
      $result_update1=mysqli_query($con,$sqlupdate1);

      $sqldeliveries1="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes1."', '".$new_id1."', '".$supplierid1."', '".$new_pokey1."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery1=mysqli_query($con,$sqldeliveries1);

      if($new_inputExp1 == $new_OrigExp1){
         $sqladd1="UPDATE supplies SET quantity_in_stock='$addstock1' WHERE supply_id='$new_supid1' ";
      $result_add1=mysqli_query($con,$sqladd1);
      }else{
        $sqlexp1="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description1, $brand1, $unit1, $stock1, $amount1, $new_inputExp1, $new_purchaseID, $supplierid1)";
        $resultexp1=mysqli_query($con,$sqlexp1);
      }

    }

    $new_id2=mysqli_real_escape_string($con,$_POST['txtpoid2']);
    $new_status2=mysqli_real_escape_string($con,$_POST['txtstatus2']);
    $new_quantity2=mysqli_real_escape_string($con,$_POST['txtquantity2']);
    $new_quantityDelivered2=mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $new_notes2=mysqli_real_escape_string($con,$_POST['txtnotes2']);
    $quantity_returned2 = mysqli_real_escape_string($con,$_POST['txtquantity2']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $amount2= mysqli_real_escape_string($con,$_POST['unit_price2']);
    $total2 = $quantity_returned2*$amount2;
    $supplierid2=mysqli_real_escape_string($con,$_POST['txtsupplierid2']);
    $suppliesid2=mysqli_real_escape_string($con,$_POST['txtsuppliesid2']);
    $addstock2=mysqli_real_escape_string($con,$_POST['txtstock2']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $new_supid2=mysqli_real_escape_string($con,$_POST['txtsupid2']);
    $new_pokey2=mysqli_real_escape_string($con,$_POST['txtpokey2']);
    $new_inputExp2=mysqli_real_escape_string($con,$_POST['txtexpiration2']);
    $new_OrigExp2=mysqli_real_escape_string($con,$_POST['txtexpire2']);
    $description2=mysqli_real_escape_string($con,$_POST['txtdesc2']);
    $brand2=mysqli_real_escape_string($con,$_POST['txtbrand2']);
    $unit2=mysqli_real_escape_string($con,$_POST['txtunit2']);
    $stock2=mysqli_real_escape_string($con,$_POST['txtstock2']);
    
    // if for index 2
    if($new_quantity2 == $new_quantityDelivered2){
      $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2' WHERE po_id='$new_id2' ";
      $result_update2=mysqli_query($con,$sqlupdate2);

      $sqldeliveries2="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes2."', '".$new_id2."', '".$supplierid2."', '".$new_pokey2."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery2=mysqli_query($con,$sqldeliveries2);

      
      if($new_inputExp2 == $new_OrigExp2){
        $sqladd2="UPDATE supplies SET quantity_in_stock='$addstock2' WHERE supply_id='$new_supid2' ";
      $result_add2=mysqli_query($con,$sqladd2);
      }else{
        $sqlexp2="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description2, $brand2, $unit2, $stock2, $amount2, $new_inputExp2, $new_purchaseID, $supplierid2)";
        $resultexp2=mysqli_query($con,$sqlexp2);
      }
    }else {
      $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2' WHERE po_id='$new_id2' ";
      $result_update2=mysqli_query($con,$sqlupdate2);

      $sqldeliveries2="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes2."', '".$new_id2."', '".$supplierid2."', '".$new_pokey2."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery2=mysqli_query($con,$sqldeliveries2);

      if($new_inputExp2 == $new_OrigExp2){
        $sqladd2="UPDATE supplies SET quantity_in_stock='$addstock2' WHERE supply_id='$new_supid2' ";
      $result_add2=mysqli_query($con,$sqladd2);
      }else{
        $sqlexp2="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description2, $brand2, $unit2, $stock2, $amount2, $new_inputExp2, $new_purchaseID, $supplierid2)";
        $resultexp2=mysqli_query($con,$sqlexp2);
      }

    }

    $new_id3=mysqli_real_escape_string($con,$_POST['txtpoid3']);
    $new_status3=mysqli_real_escape_string($con,$_POST['txtstatus3']);
    $new_quantity3=mysqli_real_escape_string($con,$_POST['txtquantity3']);
    $new_quantityDelivered3=mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $new_notes3=mysqli_real_escape_string($con,$_POST['txtnotes3']);
    $quantity_returned3 = mysqli_real_escape_string($con,$_POST['txtquantity3']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $amount3= mysqli_real_escape_string($con,$_POST['unit_price3']);
    $total3 = $quantity_returned3*$amount3;
    $supplierid3=mysqli_real_escape_string($con,$_POST['txtsupplierid3']);
    $suppliesid3=mysqli_real_escape_string($con,$_POST['txtsuppliesid3']);
    $addstock3=mysqli_real_escape_string($con,$_POST['txtstock3']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $new_supid3=mysqli_real_escape_string($con,$_POST['txtsupid3']);
    $new_pokey3=mysqli_real_escape_string($con,$_POST['txtpokey3']);
    $new_inputExp3=mysqli_real_escape_string($con,$_POST['txtexpiration3']);
    $new_OrigExp3=mysqli_real_escape_string($con,$_POST['txtexpire3']);
    $description3=mysqli_real_escape_string($con,$_POST['txtdesc3']);
    $brand3=mysqli_real_escape_string($con,$_POST['txtbrand3']);
    $unit3=mysqli_real_escape_string($con,$_POST['txtunit3']);
    $stock3=mysqli_real_escape_string($con,$_POST['txtstock3']);
    
    // if for index 3
    if($new_quantity3 == $new_quantityDelivered3){
      $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3' WHERE po_id='$new_id3' ";
      $result_update3=mysqli_query($con,$sqlupdate3);

      $sqldeliveries3="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes3."', '".$new_id3."', '".$supplierid3."', '".$new_pokey3."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery3=mysqli_query($con,$sqldeliveries3);
      
      if($new_inputExp3 == $new_OrigExp3){
        $sqladd3="UPDATE supplies SET quantity_in_stock='$addstock3' WHERE supply_id='$new_supid3' ";
      $result_add3=mysqli_query($con,$sqladd3);
      }else{
        $sqlexp3="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description3, $brand3, $unit3, $stock3, $amount3, $new_inputExp3, $new_purchaseID, $supplierid3)";
        $resultexp3=mysqli_query($con,$sqlexp3);
      }
    }else {
      $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3' WHERE po_id='$new_id3' ";
      $result_update3=mysqli_query($con,$sqlupdate3);

      $sqldeliveries3="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes3."', '".$new_id3."', '".$supplierid3."', '".$new_pokey3."', '".$delBy."', '".$ordrNo."')";

      if($new_inputExp3 == $new_OrigExp3){
        $sqladd3="UPDATE supplies SET quantity_in_stock='$addstock3' WHERE supply_id='$new_supid3' ";
      $result_add3=mysqli_query($con,$sqladd3);
      }else{
        $sqlexp3="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description3, $brand3, $unit3, $stock3, $amount3, $new_inputExp3, $new_purchaseID, $supplierid3)";
        $resultexp3=mysqli_query($con,$sqlexp3);
      }

    }

    $new_id4=mysqli_real_escape_string($con,$_POST['txtpoid4']);
    $new_status4=mysqli_real_escape_string($con,$_POST['txtstatus4']);
    $new_quantity4=mysqli_real_escape_string($con,$_POST['txtquantity4']);
    $new_quantityDelivered4=mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $new_notes4=mysqli_real_escape_string($con,$_POST['txtnotes4']);
    $quantity_returned4 = mysqli_real_escape_string($con,$_POST['txtquantity4']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $amount4= mysqli_real_escape_string($con,$_POST['unit_price4']);
    $total4 = $quantity_returned4*$amount4;
    $supplierid4=mysqli_real_escape_string($con,$_POST['txtsupplierid4']);
    $suppliesid4=mysqli_real_escape_string($con,$_POST['txtsuppliesid4']);
    $addstock4=mysqli_real_escape_string($con,$_POST['txtstock4']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $new_supid4=mysqli_real_escape_string($con,$_POST['txtsupid4']);
    $new_pokey4=mysqli_real_escape_string($con,$_POST['txtpokey4']);
    $new_inputExp4=mysqli_real_escape_string($con,$_POST['txtexpiration4']);
    $new_OrigExp4=mysqli_real_escape_string($con,$_POST['txtexpire4']);
    $description4=mysqli_real_escape_string($con,$_POST['txtdesc4']);
    $brand4=mysqli_real_escape_string($con,$_POST['txtbrand4']);
    $unit4=mysqli_real_escape_string($con,$_POST['txtunit4']);
    $stock4=mysqli_real_escape_string($con,$_POST['txtstock4']);
    
    // if for index 4
    if($new_quantity4 == $new_quantityDelivered4){
      $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4' WHERE po_id='$new_id4' ";
      $result_update4=mysqli_query($con,$sqlupdate4);

      $sqldeliveries4="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes4."', '".$new_id4."', '".$supplierid4."', '".$new_pokey4."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery4=mysqli_query($con,$sqldeliveries4);
      
      if($new_inputExp4 == $new_OrigExp4){
        $sqladd4="UPDATE supplies SET quantity_in_stock='$addstock4' WHERE supply_id='$new_supid4' ";
      $result_add4=mysqli_query($con,$sqladd4);
      }else{
        $sqlexp4="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description4, $brand4, $unit4, $stock4, $amount4, $new_inputExp4, $new_purchaseID, $supplierid4)";
        $resultexp4=mysqli_query($con,$sqlexp4);
      }
    }else {
      $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4' WHERE po_id='$new_id4' ";
      $result_update4=mysqli_query($con,$sqlupdate4);

      $sqldeliveries4="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes4."', '".$new_id4."', '".$supplierid4."', '".$new_pokey4."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery4=mysqli_query($con,$sqldeliveries4);

      if($new_inputExp4 == $new_OrigExp4){
        $sqladd4="UPDATE supplies SET quantity_in_stock='$addstock4' WHERE supply_id='$new_supid4' ";
      $result_add4=mysqli_query($con,$sqladd4);
      }else{
        $sqlexp4="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description4, $brand4, $unit4, $stock4, $amount4, $new_inputExp4, $new_purchaseID, $supplierid4)";
        $resultexp4=mysqli_query($con,$sqlexp4);
      }

    }

    $new_id5=mysqli_real_escape_string($con,$_POST['txtpoid5']);
    $new_status5=mysqli_real_escape_string($con,$_POST['txtstatus5']);
    $new_quantity5=mysqli_real_escape_string($con,$_POST['txtquantity5']);
    $new_quantityDelivered5=mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $new_notes5=mysqli_real_escape_string($con,$_POST['txtnotes5']);
    $quantity_returned5 = mysqli_real_escape_string($con,$_POST['txtquantity5']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $amount5= mysqli_real_escape_string($con,$_POST['unit_price5']);
    $total5 = $quantity_returned5*$amount5;
    $supplierid5=mysqli_real_escape_string($con,$_POST['txtsupplierid5']);
    $suppliesid5=mysqli_real_escape_string($con,$_POST['txtsuppliesid5']);
    $addstock5=mysqli_real_escape_string($con,$_POST['txtstock5']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $new_supid5=mysqli_real_escape_string($con,$_POST['txtsupid5']);
    $new_pokey5=mysqli_real_escape_string($con,$_POST['txtpokey5']);
    $new_inputExp5=mysqli_real_escape_string($con,$_POST['txtexpiration5']);
    $new_OrigExp5=mysqli_real_escape_string($con,$_POST['txtexpire5']);
    $description5=mysqli_real_escape_string($con,$_POST['txtdesc5']);
    $brand5=mysqli_real_escape_string($con,$_POST['txtbrand5']);
    $unit5=mysqli_real_escape_string($con,$_POST['txtunit5']);
    $stock5=mysqli_real_escape_string($con,$_POST['txtstock5']);
    // if for index 5
    if($new_quantity5 == $new_quantityDelivered5){
      $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5' WHERE po_id='$new_id5' ";
      $result_update5=mysqli_query($con,$sqlupdate5);

      $sqldeliveries5="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes5."', '".$new_id5."', '".$supplierid5."', '".$new_pokey5."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery5=mysqli_query($con,$sqldeliveries5);
      
      if($new_inputExp5 == $new_OrigExp5){
        $sqladd5="UPDATE supplies SET quantity_in_stock='$addstock5' WHERE supply_id='$new_supid5' ";
      $result_add5=mysqli_query($con,$sqladd5);
      }else{
        $sqlexp5="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description5, $brand5, $unit5, $stock5, $amount5, $new_inputExp5, $new_purchaseID, $supplierid5)";
        $resultexp5=mysqli_query($con,$sqlexp5);
      }
    }else {
      $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5' WHERE po_id='$new_id5' ";
      $result_update5=mysqli_query($con,$sqlupdate5);

       $sqldeliveries5="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes5."', '".$new_id5."', '".$supplierid5."', '".$new_pokey5."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery5=mysqli_query($con,$sqldeliveries5);

      if($new_inputExp5 == $new_OrigExp5){
        $sqladd5="UPDATE supplies SET quantity_in_stock='$addstock5' WHERE supply_id='$new_supid5' ";
      $result_add5=mysqli_query($con,$sqladd5);
      }else{
        $sqlexp5="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description5, $brand5, $unit5, $stock5, $amount5, $new_inputExp5, $new_purchaseID, $supplierid5)";
        $resultexp5=mysqli_query($con,$sqlexp5);
      }

    }

    $new_id6=mysqli_real_escape_string($con,$_POST['txtpoid6']);
    $new_status6=mysqli_real_escape_string($con,$_POST['txtstatus6']);
    $new_quantity6=mysqli_real_escape_string($con,$_POST['txtquantity6']);
    $new_quantityDelivered6=mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $new_notes6=mysqli_real_escape_string($con,$_POST['txtnotes6']);
    $quantity_returned6 = mysqli_real_escape_string($con,$_POST['txtquantity6']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $amount6= mysqli_real_escape_string($con,$_POST['unit_price6']);
    $total6 = $quantity_returned6*$amount6;
    $supplierid6=mysqli_real_escape_string($con,$_POST['txtsupplierid6']);
    $suppliesid6=mysqli_real_escape_string($con,$_POST['txtsuppliesid6']);
    $addstock6=mysqli_real_escape_string($con,$_POST['txtstock6']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $new_supid6=mysqli_real_escape_string($con,$_POST['txtsupid6']);
    $new_pokey6=mysqli_real_escape_string($con,$_POST['txtpokey6']);
    $new_inputExp6=mysqli_real_escape_string($con,$_POST['txtexpiration6']);
    $new_OrigExp6=mysqli_real_escape_string($con,$_POST['txtexpire6']);
    $description6=mysqli_real_escape_string($con,$_POST['txtdesc6']);
    $brand6=mysqli_real_escape_string($con,$_POST['txtbrand6']);
    $unit6=mysqli_real_escape_string($con,$_POST['txtunit6']);
    $stock6=mysqli_real_escape_string($con,$_POST['txtstock6']);
    
    // if for index 6
    if($new_quantity6 == $new_quantityDelivered6){
      $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6' WHERE po_id='$new_id6' ";
      $result_update6=mysqli_query($con,$sqlupdate6);

      $sqldeliveries6="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes6."', '".$new_id6."', '".$supplierid6."', '".$new_pokey6."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery6=mysqli_query($con,$sqldeliveries6);
      
      if($new_inputExp6 == $new_OrigExp6){
        $sqladd6="UPDATE supplies SET quantity_in_stock='$addstock6' WHERE supply_id='$new_supid6' ";
      $result_add6=mysqli_query($con,$sqladd6);
      }else{
        $sqlexp6="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description6, $brand6, $unit6, $stock6, $amount6, $new_inputExp6, $new_purchaseID, $supplierid6)";
        $resultexp6=mysqli_query($con,$sqlexp6);
      }
    }else {
      $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6' WHERE po_id='$new_id6' ";
      $result_update6=mysqli_query($con,$sqlupdate6);

      $sqldeliveries6="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes6."', '".$new_id6."', '".$supplierid6."', '".$new_pokey6."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery6=mysqli_query($con,$sqldeliveries6);

      if($new_inputExp6 == $new_OrigExp6){
        $sqladd6="UPDATE supplies SET quantity_in_stock='$addstock6' WHERE supply_id='$new_supid6' ";
      $result_add6=mysqli_query($con,$sqladd6);
      }else{
        $sqlexp6="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description6, $brand6, $unit6, $stock6, $amount6, $new_inputExp6, $new_purchaseID, $supplierid6)";
        $resultexp6=mysqli_query($con,$sqlexp6);
      }

    }

    $new_id7=mysqli_real_escape_string($con,$_POST['txtpoid7']);
    $new_status7=mysqli_real_escape_string($con,$_POST['txtstatus7']);
    $new_quantity7=mysqli_real_escape_string($con,$_POST['txtquantity7']);
    $new_quantityDelivered7=mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $new_notes7=mysqli_real_escape_string($con,$_POST['txtnotes7']);
    $quantity_returned7 = mysqli_real_escape_string($con,$_POST['txtquantity7']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $amount7= mysqli_real_escape_string($con,$_POST['unit_price7']);
    $total7 = $quantity_returned7*$amount7;
    $supplierid7=mysqli_real_escape_string($con,$_POST['txtsupplierid7']);
    $suppliesid7=mysqli_real_escape_string($con,$_POST['txtsuppliesid7']);
    $addstock7=mysqli_real_escape_string($con,$_POST['txtstock7']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $new_supid7=mysqli_real_escape_string($con,$_POST['txtsupid7']);
    $new_pokey7=mysqli_real_escape_string($con,$_POST['txtpokey7']);
    $new_inputExp7=mysqli_real_escape_string($con,$_POST['txtexpiration7']);
    $new_OrigExp7=mysqli_real_escape_string($con,$_POST['txtexpire7']);
    $description7=mysqli_real_escape_string($con,$_POST['txtdesc7']);
    $brand7=mysqli_real_escape_string($con,$_POST['txtbrand7']);
    $unit7=mysqli_real_escape_string($con,$_POST['txtunit7']);
    $stock7=mysqli_real_escape_string($con,$_POST['txtstock7']);
    
    // if for index 7
    if($new_quantity7 == $new_quantityDelivered7){
      $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7' WHERE po_id='$new_id7' ";
      $result_update7=mysqli_query($con,$sqlupdate7);

      $sqldeliveries7="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes7."', '".$new_id7."', '".$supplierid7."', '".$new_pokey7."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery7=mysqli_query($con,$sqldeliveries7);
      
      if($new_inputExp7 == $new_OrigExp7){
        $sqladd7="UPDATE supplies SET quantity_in_stock='$addstock7' WHERE supply_id='$new_supid7' ";
      $result_add7=mysqli_query($con,$sqladd7);
      }else{
        $sqlexp7="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description7, $brand7, $unit7, $stock7, $amount7, $new_inputExp7, $new_purchaseID, $supplierid7)";
        $resultexp7=mysqli_query($con,$sqlexp7);
      }
    }else {
      $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7' WHERE po_id='$new_id7' ";
      $result_update7=mysqli_query($con,$sqlupdate7);

      $sqldeliveries7="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes7."', '".$new_id7."', '".$supplierid7."', '".$new_pokey7."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery7=mysqli_query($con,$sqldeliveries7);

      if($new_inputExp7 == $new_OrigExp7){
        $sqladd7="UPDATE supplies SET quantity_in_stock='$addstock7' WHERE supply_id='$new_supid7' ";
      $result_add7=mysqli_query($con,$sqladd7);
      }else{
        $sqlexp7="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description7, $brand7, $unit7, $stock7, $amount7, $new_inputExp7, $new_purchaseID, $supplierid7)";
        $resultexp7=mysqli_query($con,$sqlexp7);
      }

    }

    $new_id8=mysqli_real_escape_string($con,$_POST['txtpoid8']);
    $new_status8=mysqli_real_escape_string($con,$_POST['txtstatus8']);
    $new_quantity8=mysqli_real_escape_string($con,$_POST['txtquantity8']);
    $new_quantityDelivered8=mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $new_notes8=mysqli_real_escape_string($con,$_POST['txtnotes8']);
    $quantity_returned8 = mysqli_real_escape_string($con,$_POST['txtquantity8']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $amount8= mysqli_real_escape_string($con,$_POST['unit_price8']);
    $total8 = $quantity_returned8*$amount8;
    $supplierid8=mysqli_real_escape_string($con,$_POST['txtsupplierid8']);
    $suppliesid8=mysqli_real_escape_string($con,$_POST['txtsuppliesid8']);
    $addstock8=mysqli_real_escape_string($con,$_POST['txtstock8']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $new_supid8=mysqli_real_escape_string($con,$_POST['txtsupid8']);
    $new_pokey8=mysqli_real_escape_string($con,$_POST['txtpokey8']);
    $new_inputExp8=mysqli_real_escape_string($con,$_POST['txtexpiration8']);
    $new_OrigExp8=mysqli_real_escape_string($con,$_POST['txtexpire8']);
    $description8=mysqli_real_escape_string($con,$_POST['txtdesc8']);
    $brand8=mysqli_real_escape_string($con,$_POST['txtbrand8']);
    $unit8=mysqli_real_escape_string($con,$_POST['txtunit8']);
    $stock8=mysqli_real_escape_string($con,$_POST['txtstock8']);
    
    // if for index 8
    if($new_quantity8 == $new_quantityDelivered8){
      $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered8', notes='$new_notes8' WHERE po_id='$new_id8' ";
      $result_update8=mysqli_query($con,$sqlupdate8);

      $sqldeliveries8="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes8."', '".$new_id8."', '".$supplierid8."', '".$new_pokey8."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery8=mysqli_query($con,$sqldeliveries8);
      
      if($new_inputExp8 == $new_OrigExp8){
        $sqladd8="UPDATE supplies SET quantity_in_stock='$addstock8' WHERE supply_id='$new_supid8' ";
      $result_add8=mysqli_query($con,$sqladd8);
      }else{
        $sqlexp8="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description8, $brand8, $unit8, $stock8, $amount8, $new_inputExp8, $new_purchaseID, $supplierid8)";
        $resultexp8=mysqli_query($con,$sqlexp8);
      }
    }else {
      $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered8', notes='$new_notes' WHERE po_id='$new_id8' ";
      $result_update8=mysqli_query($con,$sqlupdate8);

      $sqldeliveries8="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes8."', '".$new_id8."', '".$supplierid8."', '".$new_pokey8."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery8=mysqli_query($con,$sqldeliveries8);

      if($new_inputExp8 == $new_OrigExp8){
        $sqladd8="UPDATE supplies SET quantity_in_stock='$addstock8' WHERE supply_id='$new_supid8' ";
      $result_add8=mysqli_query($con,$sqladd8);
      }else{
        $sqlexp8="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description8, $brand8, $unit8, $stock8, $amount8, $new_inputExp8, $new_purchaseID, $supplierid8)";
        $resultexp8=mysqli_query($con,$sqlexp8);
      }

    }

    $new_id9=mysqli_real_escape_string($con,$_POST['txtpoid9']);
    $new_status9=mysqli_real_escape_string($con,$_POST['txtstatus9']);
    $new_quantity9=mysqli_real_escape_string($con,$_POST['txtquantity9']);
    $new_quantityDelivered9=mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $new_notes9=mysqli_real_escape_string($con,$_POST['txtnotes9']);
    $quantity_returned9 = mysqli_real_escape_string($con,$_POST['txtquantity9']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $amount9= mysqli_real_escape_string($con,$_POST['unit_price9']);
    $total9 = $quantity_returned9*$amount9;
    $supplierid9=mysqli_real_escape_string($con,$_POST['txtsupplierid9']);
    $suppliesid9=mysqli_real_escape_string($con,$_POST['txtsuppliesid9']);
    $addstock9=mysqli_real_escape_string($con,$_POST['txtstock9']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $new_supid9=mysqli_real_escape_string($con,$_POST['txtsupid9']);
    $new_pokey9=mysqli_real_escape_string($con,$_POST['txtpokey9']);
    $new_inputExp9=mysqli_real_escape_string($con,$_POST['txtexpiration9']);
    $new_OrigExp9=mysqli_real_escape_string($con,$_POST['txtexpire9']);
    $description9=mysqli_real_escape_string($con,$_POST['txtdesc9']);
    $brand9=mysqli_real_escape_string($con,$_POST['txtbrand9']);
    $unit9=mysqli_real_escape_string($con,$_POST['txtunit9']);
    $stock9=mysqli_real_escape_string($con,$_POST['txtstock9']);
    
    // if for index 9
    if($new_quantity9 == $new_quantityDelivered9){
      $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9' WHERE po_id='$new_id9' ";
      $result_update9=mysqli_query($con,$sqlupdate9);

      $sqldeliveries9="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Full', '".$new_notes9."', '".$new_id9."', '".$supplierid9."', '".$new_pokey9."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery9=mysqli_query($con,$sqldeliveries9);
      
      if($new_inputExp9 == $new_OrigExp9){
        $sqladd9="UPDATE supplies SET quantity_in_stock='$addstock9' WHERE supply_id='$new_supid9' ";
      $result_add9=mysqli_query($con,$sqladd9);
      }else{
        $sqlexp9="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description9, $brand9, $unit9, $stock9, $amount9, $new_inputExp9, $new_purchaseID, $supplierid9)";
        $resultexp9=mysqli_query($con,$sqlexp9);
      }
    }else {
      $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9' WHERE po_id='$new_id9' ";
      $result_update9=mysqli_query($con,$sqlupdate9);

      $sqldeliveries9="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id) VALUES (CURDATE(), 'Partial', '".$new_notes9."', '".$new_id9."', '".$supplierid9."', '".$new_pokey9."', '".$delBy."', '".$ordrNo."')";
      $sqldelivery9=mysqli_query($con,$sqldeliveries9);

      if($new_inputExp9 == $new_OrigExp9){
        $sqladd9="UPDATE supplies SET quantity_in_stock='$addstock9' WHERE supply_id='$new_supid9' ";
      $result_add9=mysqli_query($con,$sqladd9);
      }else{
        $sqlexp9="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description9, $brand9, $unit9, $stock9, $amount9, $new_inputExp9, $new_purchaseID, $supplierid9)";
        $resultexp9=mysqli_query($con,$sqlexp9);
      }

    }


    
  
    if($new_quantity == $new_quantityDelivered && $new_quantity1 == $new_quantityDelivered1 && $new_quantity2 == $new_quantityDelivered2 && $new_quantity3 == $new_quantityDelivered3 && $new_quantity4 == $new_quantityDelivered4 && $new_quantity5 == $new_quantityDelivered5 && $new_quantity6 == $new_quantityDelivered6 && $new_quantity7 == $new_quantityDelivered7 && $new_quantity8 == $new_quantityDelivered8 && $new_quantity9 == $new_quantityDelivered9){

      $query="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE purchase_order_id='$new_purchaseID' ";
      $query_result=mysqli_query($con,$query);

      if($query_result){
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Full','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
          echo '<script>window.location.href="deliveries"</script>';
      }
      else{
          echo '<script>alert("Update if Failed")</script>';
      }
    }else{
      $query1="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE purchase_order_id='$new_purchaseID' ";
      $query_result1=mysqli_query($con,$query1);

      if($query_result1){
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Partial','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
          echo '<script>window.location.href="deliveries"</script>';
      }
      else{
          echo '<script>alert("Update else Failed")</script>';
      }
    }
    
}

//SOFT DELETED OFFICE SUPPLIES
if(isset($_POST['btnDelete'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $sqlupdate="UPDATE purchase_order_bm SET soft_deleted='Y' WHERE purchase_order_id='$new_id' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery record with id# ".$new_id." has been archived','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="deliveries"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF SOFT DELETE OFFICE SUPPLIES

if(isset($_POST['btnReturn'])){
    $new_purchaseID=mysqli_real_escape_string($con,$_POST['txtid']);

    $new_id=mysqli_real_escape_string($con,$_POST['txtpoid0']);
    $new_status=mysqli_real_escape_string($con,$_POST['txtstatus0']);
    $new_quantity=mysqli_real_escape_string($con,$_POST['txtquantity0']);
    $new_quantityDelivered=mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $new_notes=mysqli_real_escape_string($con,$_POST['txtnotes0']);
    $quantity_returned = mysqli_real_escape_string($con,$_POST['txtquantity0']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $amount= mysqli_real_escape_string($con,$_POST['unit_price0']);
    $total = $quantity_returned*$amount;
    $supplierid=mysqli_real_escape_string($con,$_POST['txtsupplierid0']);
    $suppliesid=mysqli_real_escape_string($con,$_POST['txtsuppliesid0']);
    $addstock=mysqli_real_escape_string($con,$_POST['txtstock0']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
    $new_supid=mysqli_real_escape_string($con,$_POST['txtsupid0']);
    $new_pokey=mysqli_real_escape_string($con,$_POST['txtpokey0']);
    $description=mysqli_real_escape_string($con,$_POST['txtdesc0']);
    $stock=mysqli_real_escape_string($con,$_POST['txtstock0']);
    $returned=mysqli_real_escape_string($con,$_POST['txtreturn0']);

    // if for index 0
    if($returned != ''){

      $sqlreturn="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned."', '".$total."', '".$new_notes."', '".$new_purchaseID."', '".$supplierid."', '".$suppliesid."') ";
      $sqlreturned=mysqli_query($con,$sqlreturn);

      $sqlminus="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned') WHERE supply_description='$description'";
      $resultminus=mysqli_query($con,$sqlminus);

      $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);

      $sqlupdate="UPDATE purchase_order_bm SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);
    }

    $new_id1=mysqli_real_escape_string($con,$_POST['txtpoid1']);
    $new_status1=mysqli_real_escape_string($con,$_POST['txtstatus1']);
    $new_quantity1=mysqli_real_escape_string($con,$_POST['txtquantity1']);
    $new_quantityDelivered1=mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $new_notes1=mysqli_real_escape_string($con,$_POST['txtnotes1']);
    $quantity_returned1 = mysqli_real_escape_string($con,$_POST['txtquantity1']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $amount1= mysqli_real_escape_string($con,$_POST['unit_price1']);
    $total1 = $quantity_returned1*$amount1;
    $supplierid1=mysqli_real_escape_string($con,$_POST['txtsupplierid1']);
    $suppliesid1=mysqli_real_escape_string($con,$_POST['txtsuppliesid1']);
    $addstock1=mysqli_real_escape_string($con,$_POST['txtstock1']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
    $new_supid1=mysqli_real_escape_string($con,$_POST['txtsupid1']);
    $new_pokey1=mysqli_real_escape_string($con,$_POST['txtpokey1']);
    $description1=mysqli_real_escape_string($con,$_POST['txtdesc1']);
    $stock1=mysqli_real_escape_string($con,$_POST['txtstock1']);
    $returned1=mysqli_real_escape_string($con,$_POST['txtreturn1']);
    
    // if for index 1
    if($returned1 != ''){

      $sqlreturn1="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned1."', '".$total1."', '".$new_notes1."', '".$new_purchaseID."', '".$supplierid1."', '".$suppliesid1."') ";
      $sqlreturned1=mysqli_query($con,$sqlreturn1);

      $sqlminus1="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned1') WHERE supply_description='$description1'";
      $resultminus1=mysqli_query($con,$sqlminus1);

      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1' WHERE po_id='$new_id1' ";
      $result_update1=mysqli_query($con,$sqlupdate1);
    }

    $new_id2=mysqli_real_escape_string($con,$_POST['txtpoid2']);
    $new_status2=mysqli_real_escape_string($con,$_POST['txtstatus2']);
    $new_quantity2=mysqli_real_escape_string($con,$_POST['txtquantity2']);
    $new_quantityDelivered2=mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $new_notes2=mysqli_real_escape_string($con,$_POST['txtnotes2']);
    $quantity_returned2 = mysqli_real_escape_string($con,$_POST['txtquantity2']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $amount2= mysqli_real_escape_string($con,$_POST['unit_price2']);
    $total2 = $quantity_returned2*$amount2;
    $supplierid2=mysqli_real_escape_string($con,$_POST['txtsupplierid2']);
    $suppliesid2=mysqli_real_escape_string($con,$_POST['txtsuppliesid2']);
    $addstock2=mysqli_real_escape_string($con,$_POST['txtstock2']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
    $new_supid2=mysqli_real_escape_string($con,$_POST['txtsupid2']);
    $new_pokey2=mysqli_real_escape_string($con,$_POST['txtpokey2']);
    $description2=mysqli_real_escape_string($con,$_POST['txtdesc2']);
    $stock2=mysqli_real_escape_string($con,$_POST['txtstock2']);
    $returned2=mysqli_real_escape_string($con,$_POST['txtreturn2']);
    
    // if for index 2
    if($returned2 != ''){

      $sqlreturn2="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned2."', '".$total2."', '".$new_notes2."', '".$new_purchaseID."', '".$supplierid2."', '".$suppliesid2."') ";
      $sqlreturned2=mysqli_query($con,$sqlreturn2);

      $sqlminus2="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned2') WHERE supply_description='$description2'";
      $resultminus2=mysqli_query($con,$sqlminus2);

      $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2' WHERE po_id='$new_id2' ";
      $result_update2=mysqli_query($con,$sqlupdate2);
    }

    $new_id3=mysqli_real_escape_string($con,$_POST['txtpoid3']);
    $new_status3=mysqli_real_escape_string($con,$_POST['txtstatus3']);
    $new_quantity3=mysqli_real_escape_string($con,$_POST['txtquantity3']);
    $new_quantityDelivered3=mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $new_notes3=mysqli_real_escape_string($con,$_POST['txtnotes3']);
    $quantity_returned3 = mysqli_real_escape_string($con,$_POST['txtquantity3']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $amount3= mysqli_real_escape_string($con,$_POST['unit_price3']);
    $total3 = $quantity_returned3*$amount3;
    $supplierid3=mysqli_real_escape_string($con,$_POST['txtsupplierid3']);
    $suppliesid3=mysqli_real_escape_string($con,$_POST['txtsuppliesid3']);
    $addstock3=mysqli_real_escape_string($con,$_POST['txtstock3']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
    $new_supid3=mysqli_real_escape_string($con,$_POST['txtsupid3']);
    $new_pokey3=mysqli_real_escape_string($con,$_POST['txtpokey3']);
    $description3=mysqli_real_escape_string($con,$_POST['txtdesc3']);
    $stock3=mysqli_real_escape_string($con,$_POST['txtstock3']);
    $returned3=mysqli_real_escape_string($con,$_POST['txtreturn3']);
    
    // if for index 3
    if($returned3 != ''){

      $sqlreturn3="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned3."', '".$total3."', '".$new_notes3."', '".$new_purchaseID."', '".$supplierid3."', '".$suppliesid3."') ";
      $sqlreturned3=mysqli_query($con,$sqlreturn3);

      $sqlminus3="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned3') WHERE supply_description='$description3'";
      $resultminus3=mysqli_query($con,$sqlminus3);

      $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3' WHERE po_id='$new_id3' ";
      $result_update3=mysqli_query($con,$sqlupdate3);
    }

    $new_id4=mysqli_real_escape_string($con,$_POST['txtpoid4']);
    $new_status4=mysqli_real_escape_string($con,$_POST['txtstatus4']);
    $new_quantity4=mysqli_real_escape_string($con,$_POST['txtquantity4']);
    $new_quantityDelivered4=mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $new_notes4=mysqli_real_escape_string($con,$_POST['txtnotes4']);
    $quantity_returned4 = mysqli_real_escape_string($con,$_POST['txtquantity4']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $amount4= mysqli_real_escape_string($con,$_POST['unit_price4']);
    $total4 = $quantity_returned4*$amount4;
    $supplierid4=mysqli_real_escape_string($con,$_POST['txtsupplierid4']);
    $suppliesid4=mysqli_real_escape_string($con,$_POST['txtsuppliesid4']);
    $addstock4=mysqli_real_escape_string($con,$_POST['txtstock4']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
    $new_supid4=mysqli_real_escape_string($con,$_POST['txtsupid4']);
    $new_pokey4=mysqli_real_escape_string($con,$_POST['txtpokey4']);
    $description4=mysqli_real_escape_string($con,$_POST['txtdesc4']);
    $stock4=mysqli_real_escape_string($con,$_POST['txtstock4']);
    $returned4=mysqli_real_escape_string($con,$_POST['txtreturn4']);
    
    // if for index 4
    if($returned4 != ''){

      $sqlreturn4="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned4."', '".$total4."', '".$new_notes4."', '".$new_purchaseID."', '".$supplierid4."', '".$suppliesid4."') ";
      $sqlreturned4=mysqli_query($con,$sqlreturn4);

      $sqlminus4="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned4') WHERE supply_description='$description4'";
      $resultminus4=mysqli_query($con,$sqlminus4);

      $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4' WHERE po_id='$new_id4' ";
      $result_update4=mysqli_query($con,$sqlupdate4);
    }

    $new_id5=mysqli_real_escape_string($con,$_POST['txtpoid5']);
    $new_status5=mysqli_real_escape_string($con,$_POST['txtstatus5']);
    $new_quantity5=mysqli_real_escape_string($con,$_POST['txtquantity5']);
    $new_quantityDelivered5=mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $new_notes5=mysqli_real_escape_string($con,$_POST['txtnotes5']);
    $quantity_returned5 = mysqli_real_escape_string($con,$_POST['txtquantity5']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $amount5= mysqli_real_escape_string($con,$_POST['unit_price5']);
    $total5 = $quantity_returned5*$amount5;
    $supplierid5=mysqli_real_escape_string($con,$_POST['txtsupplierid5']);
    $suppliesid5=mysqli_real_escape_string($con,$_POST['txtsuppliesid5']);
    $addstock5=mysqli_real_escape_string($con,$_POST['txtstock5']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
    $new_supid5=mysqli_real_escape_string($con,$_POST['txtsupid5']);
    $new_pokey5=mysqli_real_escape_string($con,$_POST['txtpokey5']);
    $description5=mysqli_real_escape_string($con,$_POST['txtdesc5']);
    $stock5=mysqli_real_escape_string($con,$_POST['txtstock5']);
    $returned5=mysqli_real_escape_string($con,$_POST['txtreturn5']);
    
    // if for index 5
    if($returned5 != ''){

      $sqlreturn5="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned5."', '".$total5."', '".$new_notes5."', '".$new_purchaseID."', '".$supplierid5."', '".$suppliesid5."') ";
      $sqlreturned5=mysqli_query($con,$sqlreturn5);

      $sqlminus5="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned5') WHERE supply_description='$description5'";
      $resultminus5=mysqli_query($con,$sqlminus5);

      $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5' WHERE po_id='$new_id5' ";
      $result_update5=mysqli_query($con,$sqlupdate5);
    }

    $new_id6=mysqli_real_escape_string($con,$_POST['txtpoid6']);
    $new_status6=mysqli_real_escape_string($con,$_POST['txtstatus6']);
    $new_quantity6=mysqli_real_escape_string($con,$_POST['txtquantity6']);
    $new_quantityDelivered6=mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $new_notes6=mysqli_real_escape_string($con,$_POST['txtnotes6']);
    $quantity_returned6 = mysqli_real_escape_string($con,$_POST['txtquantity6']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $amount6= mysqli_real_escape_string($con,$_POST['unit_price6']);
    $total6 = $quantity_returned6*$amount6;
    $supplierid6=mysqli_real_escape_string($con,$_POST['txtsupplierid6']);
    $suppliesid6=mysqli_real_escape_string($con,$_POST['txtsuppliesid6']);
    $addstock6=mysqli_real_escape_string($con,$_POST['txtstock6']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
    $new_supid6=mysqli_real_escape_string($con,$_POST['txtsupid6']);
    $new_pokey6=mysqli_real_escape_string($con,$_POST['txtpokey6']);
    $description6=mysqli_real_escape_string($con,$_POST['txtdesc6']);
    $stock6=mysqli_real_escape_string($con,$_POST['txtstock6']);
    $returned6=mysqli_real_escape_string($con,$_POST['txtreturn6']);
    
    // if for index 6
    if($returned6 != ''){

      $sqlreturn6="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned6."', '".$total6."', '".$new_notes6."', '".$new_purchaseID."', '".$supplierid6."', '".$suppliesid6."') ";
      $sqlreturned6=mysqli_query($con,$sqlreturn6);

      $sqlminus6="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned6') WHERE supply_description='$description6'";
      $resultminus6=mysqli_query($con,$sqlminus6);

      $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6' WHERE po_id='$new_id6' ";
      $result_update6=mysqli_query($con,$sqlupdate6);
    }

    $new_id7=mysqli_real_escape_string($con,$_POST['txtpoid7']);
    $new_status7=mysqli_real_escape_string($con,$_POST['txtstatus7']);
    $new_quantity7=mysqli_real_escape_string($con,$_POST['txtquantity7']);
    $new_quantityDelivered7=mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $new_notes7=mysqli_real_escape_string($con,$_POST['txtnotes7']);
    $quantity_returned7 = mysqli_real_escape_string($con,$_POST['txtquantity7']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $amount7= mysqli_real_escape_string($con,$_POST['unit_price7']);
    $total7 = $quantity_returned7*$amount7;
    $supplierid7=mysqli_real_escape_string($con,$_POST['txtsupplierid7']);
    $suppliesid7=mysqli_real_escape_string($con,$_POST['txtsuppliesid7']);
    $addstock7=mysqli_real_escape_string($con,$_POST['txtstock7']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
    $new_supid7=mysqli_real_escape_string($con,$_POST['txtsupid7']);
    $new_pokey7=mysqli_real_escape_string($con,$_POST['txtpokey7']);
    $description7=mysqli_real_escape_string($con,$_POST['txtdesc7']);
    $stock7=mysqli_real_escape_string($con,$_POST['txtstock7']);
    $returned7=mysqli_real_escape_string($con,$_POST['txtreturn7']);

    // if for index 7
    if($returned7 != ''){

      $sqlreturn7="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned7."', '".$total7."', '".$new_notes7."', '".$new_purchaseID."', '".$supplierid7."', '".$suppliesid7."') ";
      $sqlreturned7=mysqli_query($con,$sqlreturn7);

      $sqlminus7="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned7') WHERE supply_description='$description7'";
      $resultminus7=mysqli_query($con,$sqlminus7);

      $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7' WHERE po_id='$new_id7' ";
      $result_update7=mysqli_query($con,$sqlupdate7);
    }

    $new_id8=mysqli_real_escape_string($con,$_POST['txtpoid8']);
    $new_status8=mysqli_real_escape_string($con,$_POST['txtstatus8']);
    $new_quantity8=mysqli_real_escape_string($con,$_POST['txtquantity8']);
    $new_quantityDelivered8=mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $new_notes8=mysqli_real_escape_string($con,$_POST['txtnotes8']);
    $quantity_returned8 = mysqli_real_escape_string($con,$_POST['txtquantity8']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $amount8= mysqli_real_escape_string($con,$_POST['unit_price8']);
    $total8 = $quantity_returned8*$amount8;
    $supplierid8=mysqli_real_escape_string($con,$_POST['txtsupplierid8']);
    $suppliesid8=mysqli_real_escape_string($con,$_POST['txtsuppliesid8']);
    $addstock8=mysqli_real_escape_string($con,$_POST['txtstock8']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
    $new_supid8=mysqli_real_escape_string($con,$_POST['txtsupid8']);
    $new_pokey8=mysqli_real_escape_string($con,$_POST['txtpokey8']);
    $description8=mysqli_real_escape_string($con,$_POST['txtdesc8']);
    $stock8=mysqli_real_escape_string($con,$_POST['txtstock8']);
    $returned8=mysqli_real_escape_string($con,$_POST['txtreturn8']);
    
    // if for index 8
    if($returned8 != ''){

      $sqlreturn8="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned8."', '".$total8."', '".$new_notes8."', '".$new_purchaseID."', '".$supplierid8."', '".$suppliesid8."') ";
      $sqlreturned8=mysqli_query($con,$sqlreturn8);

      $sqlminus8="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned8') WHERE supply_description='$description8'";
      $resultminus8=mysqli_query($con,$sqlminus8);

      $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered8', notes='$new_notes8' WHERE po_id='$new_id8' ";
      $result_update8=mysqli_query($con,$sqlupdate8);
    }
    

    $new_id9=mysqli_real_escape_string($con,$_POST['txtpoid9']);
    $new_status9=mysqli_real_escape_string($con,$_POST['txtstatus9']);
    $new_quantity9=mysqli_real_escape_string($con,$_POST['txtquantity9']);
    $new_quantityDelivered9=mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $new_notes9=mysqli_real_escape_string($con,$_POST['txtnotes9']);
    $quantity_returned9 = mysqli_real_escape_string($con,$_POST['txtquantity9']) - mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $amount9= mysqli_real_escape_string($con,$_POST['unit_price9']);
    $total9 = $quantity_returned9*$amount9;
    $supplierid9=mysqli_real_escape_string($con,$_POST['txtsupplierid9']);
    $suppliesid9=mysqli_real_escape_string($con,$_POST['txtsuppliesid9']);
    $addstock9=mysqli_real_escape_string($con,$_POST['txtstock9']) + mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
    $new_supid9=mysqli_real_escape_string($con,$_POST['txtsupid9']);
    $new_pokey9=mysqli_real_escape_string($con,$_POST['txtpokey9']);
    $description9=mysqli_real_escape_string($con,$_POST['txtdesc9']);
    $stock9=mysqli_real_escape_string($con,$_POST['txtstock9']);
    $returned9=mysqli_real_escape_string($con,$_POST['txtreturn9']);
    
    // if for index 9
    if($returned9 != ''){

      $sqlreturn9="INSERT INTO returns (return_date, quantity_returned, cost_amount, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned9."', '".$total9."', '".$new_notes9."', '".$new_purchaseID."', '".$supplierid9."', '".$suppliesid9."') ";
      $sqlreturned9=mysqli_query($con,$sqlreturn9);

      $sqlminus9="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned9') WHERE supply_description='$description9'";
      $resultminus9=mysqli_query($con,$sqlminus9);

      $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9' WHERE po_id='$new_id9' ";
      $result_update9=mysqli_query($con,$sqlupdate9);
    }


    
  
    if($new_quantity == $new_quantityDelivered && $new_quantity1 == $new_quantityDelivered1 && $new_quantity2 == $new_quantityDelivered2 && $new_quantity3 == $new_quantityDelivered3 && $new_quantity4 == $new_quantityDelivered4 && $new_quantity5 == $new_quantityDelivered5 && $new_quantity6 == $new_quantityDelivered6 && $new_quantity7 == $new_quantityDelivered7 && $new_quantity8 == $new_quantityDelivered8 && $new_quantity9 == $new_quantityDelivered9){

      $query="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE purchase_order_id='$new_purchaseID' ";
      $query_result=mysqli_query($con,$query);

      if($query_result){
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Full','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
          echo '<script>window.location.href="deliveries"</script>';
      }
      else{
          echo '<script>alert("Update if Failed")</script>';
      }
    }else{
      $query1="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE purchase_order_id='$new_purchaseID' ";
      $query_result1=mysqli_query($con,$query1);

      if($query_result1){
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Partial','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
          echo '<script>window.location.href="deliveries"</script>';
      }
      else{
          echo '<script>alert("Update else Failed")</script>';
      }
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

<script>
document.getElementById("btnPrint").onclick = function () {
printElement(document.getElementById("printThis"));

window.print();
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    
    $printSection.appendChild(domClone);
}
</script>

<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>
