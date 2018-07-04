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
                    $sql7 = "select log_id,log_date,log_description from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND (log_description like '%order%' OR log_description like '%profile%') <> (log_description like '%accepted%' OR log_description like '%declined%') order by log_id DESC";
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
                        <center><small><p><?php echo $dateyesterdayval ?></p></small></center>
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
                            <td><small><a display="block" style="color:black" href="<?php echo 'departmentsOrder' ?>"><?php echo $row["log_description"];?></a></small></td>
                        <?php
                        }else if(strpos($logvalue, 'profile') !== false){
                        if($dated == $datetoday) { 
                        ?>
                        <td>
                            <center><small><p><?php echo $datetodayval ?></p></small></center>
                        </td>
                        <?php
                        }else if($dated == $dateyesterday) {
                        ?>
                        <td>
                        <center><small><p><?php echo $dateyesterdayval ?></p></small></center>
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
                            <td><small><?php echo $row["log_description"];?></small></td>
                        <?php
                        }else{
                        if($dated == $datetoday) {
                        ?>
                        <td>
                            <center><small><p><?php echo $datetodayval ?></p></small></center>
                        </td>
                        <?php
                        }else if($dated == $dateyesterday) {
                        ?>
                        <td>
                        <center><small><p><?php echo $dateyesterdayval ?></p></small></center>
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
                              date_default_timezone_set("Asia/Manila");
                                $daysval = $row["value2"];
                                $datenow = strtotime(date("Y/m/d"));
                                $daysval2 = strtotime(date("Y-m-d",strtotime('+'.$daysval.' days')));
                                $daysvalue = $daysval2 - $datenow;
                                $num1 = 0;
                            }
                          }
                    ?>
                  <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                date_default_timezone_set("Asia/Manila");
                $dtoday = date("Y/m/d");
                $date_futr = date("Y-m-d", strtotime('+30 days') ) ;
                $date_past = date("Y-m-d", strtotime('-1 year') ) ;
                $date_select = date("Y-m-d", strtotime('-3 days') ) ;//minus three days
                $sql5 = "SELECT COUNT(*) AS total from supplies where accounted_for = 'N' group by supply_description having SUM(quantity_in_stock) < MAX(reorder_level) order by SUM(quantity_in_stock)/MAX(reorder_level)";
                $number1 = $conn->query($sql5);
                if ($number1->num_rows > 0) {
                    $num1 = 0;
                        while($row = $number1->fetch_assoc()) {
                            $num1++;
                        }
                }
                $ddtyy = strtotime(date('Y-m-d'));
                $ddtyy = strtotime('+'.$daysval.' days',$ddtyy);
                $ddtyy = date('Y-m-d',$ddtyy);
                $ddty = date('Y-m-d');
                $sqlfive = "SELECT COUNT(*) AS total from supplies where expiration_date >= '".$ddty."' AND expiration_date <= '".$ddtyy."' order by expiration_date";
                $number2 = $conn->query($sqlfive);
                if ($number2->num_rows > 0) {
                        while($row = $number2->fetch_assoc()) {
                            $num2 = $row["total"];
                        }
                }
                $sqlV = "SELECT COUNT(*) AS total from supplies where expiration_date <= '".$ddty."' AND soft_deleted = 'N'";
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
                      date_default_timezone_set("Asia/Manila");
                        $conn =mysqli_connect("localhost","root","");
                        mysqli_select_db($conn, "itproject");
                        $sql3 = "SELECT supply_description,expiration_date from supplies where expiration_date >= '".$ddty."' AND expiration_date <= '".$ddtyy."' order by expiration_date";
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
                      date_default_timezone_set("Asia/Manila");
                        $conn =mysqli_connect("localhost","root","");
                        mysqli_select_db($conn, "itproject");
                        $sql4 = "SELECT supply_description,expiration_date from supplies where expiration_date <= '".$ddty."' AND soft_deleted = 'N'";
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
               <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='user-image' height='100' src='../upload/default.jpg' alt='Default Profile Pic'>";
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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='../upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>

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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default.jpg' alt='Default Profile Pic'>";
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
                                        echo "<img width='100' class='img-circle' height='100' src='../upload/default.jpg' alt='Default Profile Pic'>";
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
  <!---------------------------------------------------- USER ACCOUNTS MENU -------------------------------------------------------------->
        <li>
              <a href="<?php echo 'userAccounts' ?>">
                  <i class="fa fa-user-circle"></i><span>Manage Accounts</span>  
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
<li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-stats"></i>Stock Movement
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo 'inventoryReconciliation' ?>"><i class="glyphicon glyphicon-adjust"></i>Inventory Reconciliation</a></li>
                <li class="treeview">
                  <li><a href="<?php echo 'reorderUpdate' ?>"><i class="fa fa-bar-chart"></i>Reorder Level Update</a></li>
                  <li><a href="<?php echo 'unitPriceUpdate' ?>"><i class="glyphicon glyphicon-ruble"></i> Price Update</a></li>
                </li>
              </ul>
            </li>
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
                  $sql = "SELECT CONCAT(description, IF((COUNT(description)-1) = 0, '', CONCAT(' and ',COUNT(description)-1,' other items.'))) AS 'Description', po_id, purchase_order_uniq_id, order_date, order_quantity, order_unit, po_remarks, description, po.delivery_date, supply_type, supplier, unit_price, total, po.po_key, quantity_delivered, po.item_delivery_remarks, notes, quantity_remaining, po.order_no, purchase_order_id, purchase_order_created_date, purchase_order_name, purchase_order_status, purchase_order_remarks, purchase_order_grandtotal, soft_deleted, delivery_id, delivery_status, delivery_remarks, supplier_id, courier_name, qty_delivered, items_delivered FROM purchase_orders po JOIN purchase_order_bm pob USING(purchase_order_uniq_id) JOIN deliveries d USING(po_id) WHERE soft_deleted='N' GROUP BY purchase_order_uniq_id";
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
                      <td><?php echo $row["order_no"]; ?></td>
                      <td><?php echo $row["Description"]; ?></td>
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
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-share"></i><i class="fa fa-truck"></i> Return</button>
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
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-share"></i><i class="fa fa-truck"></i> Return</button>
                          </div>
                        <?php }else{?>
                          <!-- <div class="btn-group">
                              <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-check"></i> Check</button>
                          </div> -->
                          <div class="btn-group">
                              <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-search"></i> View</button>
                          </div>
                          <div class="btn-group">
                              <button type="button" id="getReturn" class="btn btn-success btn-xs" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-share"></i><i class="fa fa-truck"></i> Return</button>
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
        <button  type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#printrep"><i class="fa fa-copy"></i> Generate Report</button>
        
        </div>
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
                <button type="submit" class="btn btn-primary" name="generated"><i class="fa fa-copy"></i> Generate</button>
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
  $(function(){
    $('[data-mask]').inputmask()
  })
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
          "lengthMenu": [[5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, -1], [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, "All"]]
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

// if(isset($_POST['btnReturn'])){
//     $new_purchaseID=mysqli_real_escape_string($con,$_POST['txtid']);

//     $new_id=mysqli_real_escape_string($con,$_POST['txtpoid0']);
//     $new_quantityDelivered=mysqli_real_escape_string($con,$_POST['txtquantitydelivered0']);
//     $new_notes=mysqli_real_escape_string($con,$_POST['txtnotes0']);
//     $supplierid=mysqli_real_escape_string($con,$_POST['txtsupplierid0']);
//     $suppliesid=mysqli_real_escape_string($con,$_POST['txtsuppliesid0']);
//     $description=mysqli_real_escape_string($con,$_POST['txtdesc0']);
//     $returned=mysqli_real_escape_string($con,$_POST['txtreturn0']);

//     // if for index 0
//     if($returned != '' || $description != ''){

//       $sqlreturn="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned."', '".$new_notes."', '".$new_purchaseID."', '".$supplierid."', '".$suppliesid."') ";
//       $sqlreturned=mysqli_query($con,$sqlreturn);

//       $sqlminus="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned') WHERE supply_description='$description'";
//       $resultminus=mysqli_query($con,$sqlminus);

//       $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
//       $result_update=mysqli_query($con,$sqlupdate);

//       $sqlupdate="UPDATE purchase_order_bm SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' WHERE po_id='$new_id' ";
//       $result_update=mysqli_query($con,$sqlupdate);
//     }

//     $new_id1=mysqli_real_escape_string($con,$_POST['txtpoid1']);
//     $new_quantityDelivered1=mysqli_real_escape_string($con,$_POST['txtquantitydelivered1']);
//     $new_notes1=mysqli_real_escape_string($con,$_POST['txtnotes1']);
//     $supplierid1=mysqli_real_escape_string($con,$_POST['txtsupplierid1']);
//     $suppliesid1=mysqli_real_escape_string($con,$_POST['txtsuppliesid1']);
//     $description1=mysqli_real_escape_string($con,$_POST['txtdesc1']);
//     $returned1=mysqli_real_escape_string($con,$_POST['txtreturn1']);
    
//     // if for index 1
//     if($returned1 != '' || $description1 != ''){

//       $sqlreturn1="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned1."', '".$new_notes1."', '".$new_purchaseID."', '".$supplierid1."', '".$suppliesid1."') ";
//       $sqlreturned1=mysqli_query($con,$sqlreturn1);

//       $sqlminus1="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned1') WHERE supply_description='$description1'";
//       $resultminus1=mysqli_query($con,$sqlminus1);

//       $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1' WHERE po_id='$new_id1' ";
//       $result_update1=mysqli_query($con,$sqlupdate1);
//     }

//     $new_id2=mysqli_real_escape_string($con,$_POST['txtpoid2']);
//     $new_quantityDelivered2=mysqli_real_escape_string($con,$_POST['txtquantitydelivered2']);
//     $new_notes2=mysqli_real_escape_string($con,$_POST['txtnotes2']);
//     $supplierid2=mysqli_real_escape_string($con,$_POST['txtsupplierid2']);
//     $suppliesid2=mysqli_real_escape_string($con,$_POST['txtsuppliesid2']);
//     $description2=mysqli_real_escape_string($con,$_POST['txtdesc2']);
//     $returned2=mysqli_real_escape_string($con,$_POST['txtreturn2']);
    
//     // if for index 2
//     if($returned2 != '' || $description2 != ''){

//       $sqlreturn2="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned2."', '".$new_notes2."', '".$new_purchaseID."', '".$supplierid2."', '".$suppliesid2."') ";
//       $sqlreturned2=mysqli_query($con,$sqlreturn2);

//       $sqlminus2="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned2') WHERE supply_description='$description2'";
//       $resultminus2=mysqli_query($con,$sqlminus2);

//       $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2' WHERE po_id='$new_id2' ";
//       $result_update2=mysqli_query($con,$sqlupdate2);
//     }

//     $new_id3=mysqli_real_escape_string($con,$_POST['txtpoid3']);
//     $new_quantityDelivered3=mysqli_real_escape_string($con,$_POST['txtquantitydelivered3']);
//     $new_notes3=mysqli_real_escape_string($con,$_POST['txtnotes3']);
//     $supplierid3=mysqli_real_escape_string($con,$_POST['txtsupplierid3']);
//     $suppliesid3=mysqli_real_escape_string($con,$_POST['txtsuppliesid3']);
//     $description3=mysqli_real_escape_string($con,$_POST['txtdesc3']);
//     $returned3=mysqli_real_escape_string($con,$_POST['txtreturn3']);
    
//     // if for index 3
//     if($returned3 != '' || $description3 != ''){

//       $sqlreturn3="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned3."', '".$new_notes3."', '".$new_purchaseID."', '".$supplierid3."', '".$suppliesid3."') ";
//       $sqlreturned3=mysqli_query($con,$sqlreturn3);

//       $sqlminus3="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned3') WHERE supply_description='$description3'";
//       $resultminus3=mysqli_query($con,$sqlminus3);

//       $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3' WHERE po_id='$new_id3' ";
//       $result_update3=mysqli_query($con,$sqlupdate3);
//     }

//     $new_id4=mysqli_real_escape_string($con,$_POST['txtpoid4']);
//     $new_quantityDelivered4=mysqli_real_escape_string($con,$_POST['txtquantitydelivered4']);
//     $new_notes4=mysqli_real_escape_string($con,$_POST['txtnotes4']);
//     $supplierid4=mysqli_real_escape_string($con,$_POST['txtsupplierid4']);
//     $suppliesid4=mysqli_real_escape_string($con,$_POST['txtsuppliesid4']);
//     $description4=mysqli_real_escape_string($con,$_POST['txtdesc4']);
//     $returned4=mysqli_real_escape_string($con,$_POST['txtreturn4']);
    
//     // if for index 4
//     if($returned4 != '' || $description4 != ''){

//       $sqlreturn4="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned4."', '".$new_notes4."', '".$new_purchaseID."', '".$supplierid4."', '".$suppliesid4."') ";
//       $sqlreturned4=mysqli_query($con,$sqlreturn4);

//       $sqlminus4="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned4') WHERE supply_description='$description4'";
//       $resultminus4=mysqli_query($con,$sqlminus4);

//       $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4' WHERE po_id='$new_id4' ";
//       $result_update4=mysqli_query($con,$sqlupdate4);
//     }

//     $new_id5=mysqli_real_escape_string($con,$_POST['txtpoid5']);
//     $new_quantityDelivered5=mysqli_real_escape_string($con,$_POST['txtquantitydelivered5']);
//     $new_notes5=mysqli_real_escape_string($con,$_POST['txtnotes5']);
//     $supplierid5=mysqli_real_escape_string($con,$_POST['txtsupplierid5']);
//     $suppliesid5=mysqli_real_escape_string($con,$_POST['txtsuppliesid5']);
//     $description5=mysqli_real_escape_string($con,$_POST['txtdesc5']);
//     $returned5=mysqli_real_escape_string($con,$_POST['txtreturn5']);
    
//     // if for index 5
//     if($returned5 != '' || $description5 != ''){

//       $sqlreturn5="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned5."', '".$new_notes5."', '".$new_purchaseID."', '".$supplierid5."', '".$suppliesid5."') ";
//       $sqlreturned5=mysqli_query($con,$sqlreturn5);

//       $sqlminus5="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned5') WHERE supply_description='$description5'";
//       $resultminus5=mysqli_query($con,$sqlminus5);

//       $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5' WHERE po_id='$new_id5' ";
//       $result_update5=mysqli_query($con,$sqlupdate5);
//     }

//     $new_id6=mysqli_real_escape_string($con,$_POST['txtpoid6']);
//     $new_quantityDelivered6=mysqli_real_escape_string($con,$_POST['txtquantitydelivered6']);
//     $new_notes6=mysqli_real_escape_string($con,$_POST['txtnotes6']);
//     $supplierid6=mysqli_real_escape_string($con,$_POST['txtsupplierid6']);
//     $suppliesid6=mysqli_real_escape_string($con,$_POST['txtsuppliesid6']);
//     $description6=mysqli_real_escape_string($con,$_POST['txtdesc6']);
//     $returned6=mysqli_real_escape_string($con,$_POST['txtreturn6']);
    
//     // if for index 6
//     if($returned6 != '' || $description6 != ''){

//       $sqlreturn6="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned6."', '".$new_notes6."', '".$new_purchaseID."', '".$supplierid6."', '".$suppliesid6."') ";
//       $sqlreturned6=mysqli_query($con,$sqlreturn6);

//       $sqlminus6="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned6') WHERE supply_description='$description6'";
//       $resultminus6=mysqli_query($con,$sqlminus6);

//       $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6' WHERE po_id='$new_id6' ";
//       $result_update6=mysqli_query($con,$sqlupdate6);
//     }

//     $new_id7=mysqli_real_escape_string($con,$_POST['txtpoid7']);
//     $new_quantityDelivered7=mysqli_real_escape_string($con,$_POST['txtquantitydelivered7']);
//     $new_notes7=mysqli_real_escape_string($con,$_POST['txtnotes7']);
//     $supplierid7=mysqli_real_escape_string($con,$_POST['txtsupplierid7']);
//     $suppliesid7=mysqli_real_escape_string($con,$_POST['txtsuppliesid7']);
//     $description7=mysqli_real_escape_string($con,$_POST['txtdesc7']);
//     $returned7=mysqli_real_escape_string($con,$_POST['txtreturn7']);

//     // if for index 7
//     if($returned7 != '' || $description7 != ''){

//       $sqlreturn7="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned7."', '".$new_notes7."', '".$new_purchaseID."', '".$supplierid7."', '".$suppliesid7."') ";
//       $sqlreturned7=mysqli_query($con,$sqlreturn7);

//       $sqlminus7="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned7') WHERE supply_description='$description7'";
//       $resultminus7=mysqli_query($con,$sqlminus7);

//       $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7' WHERE po_id='$new_id7' ";
//       $result_update7=mysqli_query($con,$sqlupdate7);
//     }

//     $new_id8=mysqli_real_escape_string($con,$_POST['txtpoid8']);
//     $new_quantityDelivered8=mysqli_real_escape_string($con,$_POST['txtquantitydelivered8']);
//     $new_notes8=mysqli_real_escape_string($con,$_POST['txtnotes8']);
//     $supplierid8=mysqli_real_escape_string($con,$_POST['txtsupplierid8']);
//     $suppliesid8=mysqli_real_escape_string($con,$_POST['txtsuppliesid8']);
//     $description8=mysqli_real_escape_string($con,$_POST['txtdesc8']);
//     $returned8=mysqli_real_escape_string($con,$_POST['txtreturn8']);
    
//     // if for index 8
//     if($returned8 != '' || $description8 != ''){

//       $sqlreturn8="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned8."', '".$new_notes8."', '".$new_purchaseID."', '".$supplierid8."', '".$suppliesid8."') ";
//       $sqlreturned8=mysqli_query($con,$sqlreturn8);

//       $sqlminus8="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned8') WHERE supply_description='$description8'";
//       $resultminus8=mysqli_query($con,$sqlminus8);

//       $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered8', notes='$new_notes8' WHERE po_id='$new_id8' ";
//       $result_update8=mysqli_query($con,$sqlupdate8);
//     }
    
//     $new_id9=mysqli_real_escape_string($con,$_POST['txtpoid9']);
//     $new_quantityDelivered9=mysqli_real_escape_string($con,$_POST['txtquantitydelivered9']);
//     $new_notes9=mysqli_real_escape_string($con,$_POST['txtnotes9']);
//     $supplierid9=mysqli_real_escape_string($con,$_POST['txtsupplierid9']);
//     $suppliesid9=mysqli_real_escape_string($con,$_POST['txtsuppliesid9']);
//     $description9=mysqli_real_escape_string($con,$_POST['txtdesc9']);
//     $returned9=mysqli_real_escape_string($con,$_POST['txtreturn9']);
    
//     // if for index 9
//     if($returned9 != '' || $description9 != ''){

//       $sqlreturn9="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (CURDATE() , '".$returned9."', '".$new_notes9."', '".$new_purchaseID."', '".$supplierid9."', '".$suppliesid9."') ";
//       $sqlreturned9=mysqli_query($con,$sqlreturn9);

//       $sqlminus9="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - '$returned9') WHERE supply_description='$description9'";
//       $resultminus9=mysqli_query($con,$sqlminus9);

//       $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9' WHERE po_id='$new_id9' ";
//       $result_update9=mysqli_query($con,$sqlupdate9);
//     }


    
  
    // if($new_quantity == $new_quantityDelivered && $new_quantity1 == $new_quantityDelivered1 && $new_quantity2 == $new_quantityDelivered2 && $new_quantity3 == $new_quantityDelivered3 && $new_quantity4 == $new_quantityDelivered4 && $new_quantity5 == $new_quantityDelivered5 && $new_quantity6 == $new_quantityDelivered6 && $new_quantity7 == $new_quantityDelivered7 && $new_quantity8 == $new_quantityDelivered8 && $new_quantity9 == $new_quantityDelivered9){

    //   $query="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE purchase_order_id='$new_purchaseID' ";
    //   $query_result=mysqli_query($con,$query);

    //   if($query_result){
    //       $conn =mysqli_connect("localhost","root","");
    //       $datetoday = date('Y\-m\-d\ H:i:s A');
    //       mysqli_select_db($conn, "itproject");
    //       $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Full','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
    //       $result = $conn->query($notif);
    //       echo '<script>window.location.href="deliveries"</script>';
    //   }
    //   else{
    //       echo '<script>alert("Update if Failed")</script>';
    //   }
    // }else{
    //   $query1="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE purchase_order_id='$new_purchaseID' ";
    //   $query_result1=mysqli_query($con,$query1);

    //   if($query_result1){
    //       $conn =mysqli_connect("localhost","root","");
    //       $datetoday = date('Y\-m\-d\ H:i:s A');
    //       mysqli_select_db($conn, "itproject");
    //       $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery with id# ".$new_purchaseID." status has been changed to Partial','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
    //       $result = $conn->query($notif);
    //       echo '<script>window.location.href="deliveries"</script>';
    //   }
    //   else{
    //       echo '<script>alert("Update else Failed")</script>';
    //   }
    // }
    
// }

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
