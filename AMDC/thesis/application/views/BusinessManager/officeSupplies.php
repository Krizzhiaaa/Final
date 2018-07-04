<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

function unit_measure($connect)
{ 
 $output = '';
 $query = "SELECT DISTINCT unit FROM supplies ORDER BY unit ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
 }
 return $output;
}

function supplier($connect)
{ 
 $output = '';
 $query = "SELECT * FROM suppliers WHERE product = 'Office' AND supplier_status = 'Active' ORDER BY company_name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["supplier_id"].'">'.$row["company_name"].'</option>';
 }
 return $output;
}

function category($connect)
{ 
 $output = '';
 $query = "SELECT DISTINCT category FROM supplies WHERE category IS NOT NULL  ORDER BY category ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["category"].'">'.$row["category"].'</option>';
 }
 return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Business Manager | Office Supplies</title>
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
                          document.getElementById("demo").innerHTML = d
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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active treeview">
              <a href="#"><i class="fa fa-briefcase"></i> Supplies
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo 'medicalSupplies' ?>"><i class="fa fa-medkit"></i>Medical Supplies</a></li>
                <li class="treeview">
                  <li class="active"><a href="<?php echo 'officeSupplies' ?>"><i class="fa fa-pencil-square"></i>Office Supplies</a></li>
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
      <li><a href="<?php echo 'deliveries' ?>"><i class="fa fa-truck"></i>Deliveries</a></li>
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
          <i class="fa fa-pencil-square"></i> <b>Office Supplies</b>
        <!-- <small>Supplies</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</li>
        <li><i class="fa fa-cubes"></i> Inventory</li>
        <li><i class="fa fa-briefcase"></i> Supplies</li>
        <li class="active"><i class="fa fa-pencil-square"></i> Office Supplies</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                <table style="float: left;">
                    <tr>
                        <th> <div class="dropdownButton">
                        <select name="dropdown" class="form-group select2" style="width:100%;" onchange="location=this.value;">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Supplies
                          <span class="caret"></span>
                        </button>
                          <option><b>All Supplies</b></option>
                          <option value="officeSuppliesTotalQuantity">Total Quantity</option>
                        </select>
                      </div></th>
                    </tr>
                </table> 
                <table style="float:right;">
                    <tr>
                        <th><button type="submit" class="btn btn-primary btn-block btn-success" data-toggle="modal" data-target="#modal-info"><i class="glyphicon glyphicon-plus"></i> Add New Item</button>
                        
                        <form name="addSupply" method="post" action="officesupplies/addOfficeSupplies">
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
                                              <center><h4><b>Add New Item</b></h4></center>
                                            </div>
                                        </div>
                                        <div class="box-body">

                                          <!-- /.form group -->
                                                  <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Lot Number</label>
                                                    <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-hashtag"></i>
                                                  </div>
                                                    <input type="text" class="form-control" name="lot_no" id="lot_no" maxlength="12" required />
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
                                                  <input type="text" class="form-control" name="brandname" id="brandname" required />
                                                </div>
                                              </div>
                                              </div>
                                            </div>

                                            <div class="form-group" style="width:100%;">
                                                  <label for="exampleInputEmail1">Item Name</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-shopping-bag"></i>
                                                  </div>
                                                  <input type="text" class="form-control" id="item_name" name="item_name" required />
                                                </div>
                                              </div>

                                            
                                             <div class="form-group" style="width:100%;">
                                                  <label for="exampleInputEmail1">Item Description</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-shopping-bag"></i>
                                                  </div>
                                                  <input type="text" class="form-control" id="Description" name="Description" required />
                                                </div>
                                            </div>
                                      
                                            <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                    
                                                  <label for="exampleInputEmail1">Add new 'Unit' </label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-cubes"></i>
                                                  </div>
                                                  <input class="form-control" type="text" id="newopt"/>
                                                </div>
                                                  <button class="btn btn-default btn-md pull-right" type="button" id="addopt" >Add Unit</button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Unit</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-cubes"></i>
                                                  </div>
                                                  <select id="opt" class="form-control select2" name="Unit" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                                    <option value=""></option>
                                                    <?php echo unit_measure($connect);?>
                                                  </select>
                                           </div>
                                              </div>
                                              </div>
                                            </div>
                                            
                                       <div class="row">
                                                  <div class="col-md-6">
                                              <div class="form-group">
                                                    
                                                  <label for="exampleInputEmail1">Add new 'Category' </label>
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
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1">Category</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-th-large"></i>
                                                  </div>
                                                  <select id="cat" class="form-control select2" name="category" required style="width: 100%;">
                                                    <option value=""></option>
                                                    <?php echo category($connect);?>
                                                  </select>
                                              </div>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Reorder Level</label>
                                                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-reorder"></i>
                                                  </div>
                                                <input type="number" class="form-control" id="reorder_level" name="reorder_level" step=".01" min="0"  />
                                                </div>
                                              </div>

                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <span class="pull-left" id="message"></span>
                                                </div>
                                              </div>
                                        </div>
                                          </div>
                                      
                                            
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" name="addOffSupply"><i class="fa fa-plus"></i> Add</button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                </form>
                            </th> 
                              
                            <!--- END OF ADD -->
                        
                    </tr>
                </table>      
            </div>

       <table>
          <tr>
          <th style="padding-left: 10px;">Filter by a Range of Quantity</th>
          <th style="padding-left: 280px;">Filter by a Range of Price</th>
          </tr>

          <tr>
            <td><div class="input-group input-daterange" style="padding-left: 10px;">
          <input type="text" class="form-control select" id="min" name="min" placeholder="Min Qty">
          <div class="input-group-addon">to</div>
          <input type="text" class="form-control" id="max" name="max" placeholder="Max Qty">
        </div></td>
            
            <td><div class="input-group input-daterange" style="padding-left: 280px;">
            <input type="text" class="form-control select" id="minPrice" name="minPrice" placeholder="Min Price">
            <div class="input-group-addon">to</div>
            <input type="text" class="form-control" id="maxPrice" name="maxPrice" placeholder="Max Price">
          </div></td>

          </tr>
        </table>

        <div class="box-body">
        <table id="example" class="table table-bordered table-striped">
          <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT * FROM supplies WHERE supply_type LIKE 'Office' AND soft_deleted='N' ";
                  $result = $conn->query($sql);    
                ?>
          <thead>
            <tr>
                 <th style="display: none;"> ID </th>            
                  <th style="width:15%;">Lot No</th>
                  <th>Quantity In Stock</th>
                  <th>Unit</th>
                  <th>Brand Name</th>
                  <th>Item Name</th>
                  <th>Item Description</th>
                  <th>Category</th>
                  <th>Unit Price (&#8369;)</th>
                  <th> Action</th> 
            </tr>
        </thead>
        <tbody>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td style="display: none;"><?php echo $row['supply_id']; ?></td>
                         <td><?php echo $row["lot_no"]; ?></td>
                        <td align="right"><?php echo $row["quantity_in_stock"]; ?></td>
                      <td><?php echo $row["unit"]; ?></td>
                           <td><?php echo $row["brand_name"]; ?></td>
                         <td><?php echo $row["item_name"]; ?></td>
                      <td><?php echo $row["supply_description"]; ?></td>
                             <td><?php echo $row["category"]; ?></td>
                      <td align="right" ><?php echo $row["unit_price"]; ?></td>
                   
                      <td>
                        <div class="btn-group">
                            <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["supply_id"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Update</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" id="getRecon" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["supply_id"]; ?>"><i class="glyphicon glyphicon-adjust"></i> Reconcile</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" id="getDelete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["supply_id"]; ?>"><i class="glyphicon glyphicon-trash"></i> Archive</button>
                        </div>
                      </td>
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
        
        <tfoot>
           <tr>
                  <th style="display: none;"> ID </th>             
                  <th class="srch">Lot Number</th>
                  <th class="srch">Quantity In Stock</th>
                  <th class="srch">Unit</th>
                  <th class="srch">Brand Name</th>
                  <th class="srch">Item Name</th>
                  <th class="srch">Item Description</th>
                  <th class="srch">Category</th> 
                  <th class="srch">Unit Price</th>
                  <th> </th>
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
            <!--- PRINT AND PDF -->
             <div class="row no-print">
			
	  <div class="col-xs-1" style="float:left" style="padding-left: 10px;">
          <a href="officeSuppliesRecover" style="color:white;"><button type="button" class="btn btn-danger pull-left" style="margin-right: 1px;"><i class="fa fa-trash"></i> Archived Office Supplies
          </a>
          </button>
		</div>
    <div class="col-xs-1" style="float:right" style="padding-left: 10px;">
           <button  type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#printrep"><i class="fa fa-copy"></i> Generate Report</button>
      </div>
        <!-- END OF PRINT AND PDF -->
        <div class="modal fade" id="printrep">
<form name="form42" id="user_form" method="post" action="officesupplies/generated">
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
                                              <center><h4><b>Generate Medical Supplies Report</b></h4></center>
                                            </div>
                                      </div>
                        <div class="box-body">
                
                        <div class="row">
                    <div class="col-md-6">
                    <h4><b>Include:</b></h4>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="quantity_in_stock" checked>Stock Quantity
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="item_name" checked>Item Name
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="unit" checked>Unit
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="unit_price" checked>Unit Price
                        </div>
                      </div>
                    </div>
                        <h4><b>Department:</b></h4>
                    <div class="form-group" style="width:100%;">
                            <input type="checkbox" name="dep_list[]" value="Imaging Department">Imaging
                        </div>
                        <div class="form-group" style="width:100%;">
                            <input type="checkbox" name="dep_list[]" value="Clinical Laboratory Department">Clinical Laboratory
                        </div>
                        <div class="form-group" style="width:100%;">
                            <input type="checkbox" name="dep_list[]" value="Cardiology Department">Cardiology
                        </div>
                        <div class="form-group" style="width:100%;">
                            <input type="checkbox" name="dep_list[]" value="Endoscopy Department">Endoscopy
                        </div>
                        <div class="form-group" style="width:100%;">
                            <input type="checkbox" name="dep_list[]" value="Managing Department" checked>Managing
                        </div>
                    </div>
                    <div class="col-md-6">
                    <h4><b>&nbsp;</b></h4>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="lot_no" checked>Lot No.
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="dep_name" checked>Department
                        </div>
                      </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group" style="width:100%">
                            <input type="checkbox" name="check_list[]" value="expiration_date" checked>Expiration
                        </div>
                      </div>
                    </div>
                     </div>   
    
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) where inventory_order_status = 'Delivered'";
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
          <!-- /.modal-dialog -->
        </form> 
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
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th.srch').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width:100%;" placeholder="Search '+title+'" />' );
    } );

    // filtering
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var quantity = parseFloat( data[2] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= quantity   && isNaN( max ) ) ||
             ( min <= quantity   && quantity <= max ) )
        {
            return true;
        }
        return false;
    }

    );// for filtering

    // filtering
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var minPrice = parseInt( $('#minPrice').val(), 10 );
        var maxPrice = parseInt( $('#maxPrice').val(), 10 );
        var price = parseFloat( data[8] ) || 0; 

        if ( ( isNaN( minPrice ) && isNaN( maxPrice ) ) ||
             ( isNaN( minPrice ) && price <= maxPrice ) ||
             ( minPrice <= price && isNaN( maxPrice ) ) ||
             ( minPrice <= price && price <= maxPrice ) )
        {
            return true;
        }
        return false;
      }
    );// for filtering

 
    // DataTable
    var table = $('#example').DataTable({
      order : [[ 0, 'desc' ]],
      "lengthMenu": [[5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, -1], [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, "All"]],
      "scrollX": true
    });    
    // Apply the search in table footer
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    // id's for filtering
   $('#min, #max').keyup( function() { 
        table.draw();
    } );
   $('#minPrice, #maxPrice').keyup( function() { 
        table.draw();
    } );
} ); // end of document ready
    </script>

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
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
      
    $('#datepicker4').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
    //Timepicker
   /* $('.timepicker').timepicker({
      showInputs: false,
      format    : '%h:%i:%s %p'
    }) */
  }) 
</script>

<!--create modal dialog for display detail info for edit on button cell click-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>
   
   <!-- <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                'autoWidth' : false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url:"officesupplies/getOfficeSupplies",
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
                url:'officesupplies/editOfficeSupplies',
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
        $(document).on('click','#getAdd',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'officesupplies/OfficeSuppliesadd',
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
    
    <!--script js for get reconcile data-->
    <script>
        $(document).on('click','#getRecon',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'officeSupplies/reconcileOfficeSupplies',
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

    <!--script js for release data-->
    <script>
        $(document).on('click','#getDelete',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'officesupplies/deleteOfficeSupplies',
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

<?php 
$conn=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");

//ADD on table FOR Office SUPPLIES
if(isset($_POST['offAdd'])){

    $sqladd= $conn->prepare("INSERT INTO supplies (quantity_in_stock, good_condition, damaged) VALUES (?, ?, ?)");
    $addQty = $_POST['addQty'];
    $addGC  = $_POST['addGC'];
    $addDam = $_POST['addDam'];
    $sqladd->bind_param("sss", $addQty, $addGC, $addDam);

    if($sql->execute()) {
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','An office supply has been added with ".$addQty." status in good condition is ".$addGC."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="officeSupplies"</script>';
        } else {
        echo '<script>alert("Update Failed")</script>';
        }
        $sql->close();   
        $connection->close();
} // END OF OFFICE Add on table

//EDIT FOR OFFICE SUPPLIES
if(isset($_POST['offEdit'])){
  $conn=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
  $conn2=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
    $new_id=mysqli_real_escape_string($conn,$_POST['txtid']);
    $new_itemName=mysqli_real_escape_string($conn,$_POST['txtItemName']);
    $new_lotNo=mysqli_real_escape_string($conn,$_POST['txtlotNo']);
    $new_brandName=mysqli_real_escape_string($conn,$_POST['txtbrandName']);
    $new_supplyDescription=mysqli_real_escape_string($conn,$_POST['txtsupplyDescription']);
    $old_supplyUnitPrice=mysqli_real_escape_string($conn,$_POST['oldUnitPrice']);
    $new_supplyUnitPrice=mysqli_real_escape_string($conn,$_POST['unitPrice']);
    $new_supplyReorderLevel=mysqli_real_escape_string($conn,$_POST['txtReorderLevel']);
    $new_supplyExpirationDate=mysqli_real_escape_string($conn,$_POST['txtExpirationDate']);
    $new_supplyStock=mysqli_real_escape_string($conn,$_POST['addQty']);
    $new_supplyUnit=mysqli_real_escape_string($conn,$_POST['txtUnit']);
    $new_category=mysqli_real_escape_string($conn,$_POST['txtCategory']);
    $new_dep=mysqli_real_escape_string($conn,$_POST['txtDep']);
    $new_supplier=mysqli_real_escape_string($conn,$_POST['txtSupplier']);

    $old_supplyUnitPrice2=mysqli_real_escape_string($conn,$_POST['oldUnitPrice']);
    $new_supplyUnitPrice2=mysqli_real_escape_string($conn,$_POST['unitPrice']);
    $priceChange= $old_supplyUnitPrice2-$new_supplyUnitPrice2;

    date_default_timezone_set('Asia/Manila');
    $date = date('Y/m/d h:i:s a', time());
    
    $sqlupdate="UPDATE supplies SET item_name = '$new_itemName', supply_description='$new_supplyDescription', lot_no = '$new_lotNo', brand_name = '$new_brandName', category = '$new_category', unit='$new_supplyUnit', suppliers_name = '$new_supplier', unit_price='$new_supplyUnitPrice', quantity_in_stock='$new_supplyStock', reorder_level='$new_supplyReorderLevel', expiration_date='$new_supplyExpirationDate' WHERE supply_id='$new_id' ";
    $result_update=mysqli_query($conn,$sqlupdate);

    $sqlinsert1="INSERT INTO unitPriceUpdate (date_time, description, supply_type, old_price, new_price, priceChange, user) VALUES ('".$date."', 'The unit price of the product <b>".$new_supplyDescription." </b> has been updated from the old price of  <b>&#8369; ".$old_supplyUnitPrice."</b> to the new price of  <b>&#8369; ".$new_supplyUnitPrice."</b>.' , 'Office', '".$old_supplyUnitPrice2."', '".$new_supplyUnitPrice2."', '".$priceChange."' , '".$this->session->userdata('fname')." ".$this->session->userdata('lname')."') ";
    $result_update2=mysqli_query($conn2,$sqlinsert1);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Office supply ".$new_supplyDescription." has been edited with ".$new_supplyUnitPrice." unit price,".$new_supplyReorderLevel." reorder level,".$new_supplyExpirationDate." expiration date,".$new_supplyStock." supply stock,".$new_supplyUnit." unit and ".$new_category." category','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="officeSupplies"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF OFFICE EDIT


//RECONCILE FOR OFFICE SUPPLIES
if(isset($_POST['offRecon'])){
    $conn=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
  $conn2=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
  $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
    $new_id=mysqli_real_escape_string($conn,$_POST['txtid']);
    $item=mysqli_real_escape_string($conn,$_POST['txtsupplyDescription']);
    $logical=mysqli_real_escape_string($conn,$_POST['txtLogicalCount']);
    $physical=mysqli_real_escape_string($conn,$_POST['txtPhysicalCount']);
    $logical1=mysqli_real_escape_string($conn,$_POST['txtLogicalCount']);
    $physical1=mysqli_real_escape_string($conn,$_POST['txtPhysicalCount']);
    $difference = $logical1-$physical1;
    $remarks=mysqli_real_escape_string($conn,$_POST['remarks']);

    date_default_timezone_set('Asia/Manila');
    $date = date('Y/m/d h:i:s a', time());

  
     $sqlinsert1="INSERT INTO reconciliation (date_time, description, supply_type, quantity, old_quantity, new_quantity, user) VALUES ('".$date."', 'The product  <b>".$item."</b> has reconciled from the logical count of  <b>".$logical."</b>  to physical count of  <b>".$physical."</b>  because ".$remarks."', 'Office', '".$difference."', '".$logical1."', '".$physical1."', '".$this->session->userdata('fname')." ".$this->session->userdata('lname')."')  ";
    $result_update2=mysqli_query($conn2,$sqlinsert1);

    $sqlupdate1="UPDATE supplies SET quantity_in_stock='$physical' WHERE supply_id='$new_id' ";
    $result_update=mysqli_query($conn,$sqlupdate1);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Office supply ".$item." has been reconciled with logical count of ".$logical." and physical count of ".$physical." to logical count of ".$logical1." to physical count of ".$physical1." with the difference of ".$difference." and remarked with ".$remarks."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="officeSupplies"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF OFFICE RECONCILE
?>

<?php 
$con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");

//SOFT DELETED OFFICE SUPPLIES
if(isset($_POST['offDelete'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $sqlupdate="UPDATE supplies SET soft_deleted='Y' WHERE supply_id='$new_id' ";
    $result_update=mysqli_query($con,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','An office supply with id# ".$new_id." has been removed','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="officeSupplies"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF SOFT DELETE OFFICE SUPPLIES

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
          var message = document.getElementById('message');
          var badColor = "#ff6666";
            $(function () {
                $('#addopt').click(function () {
                    var newopt = $('#newopt').val();
                    if (newopt == '') {
                        message.style.color = badColor;
                        message.innerHTML = "Please enter a value";
                        return;
                    }
 
                    //check if the option value is already in the select box
                    $('#opt option').each(function (index) {
                        if ($(this).val() == newopt) {
                          message.style.color = badColor;
                          message.innerHTML = "The unit already exists, please enter another value";
                        }
                    })
 
                    //add the new option to the select box
                    $('#opt').append('<option value=' + newopt + '>' + newopt + '</option>');
 
                    //select the new option (particular value)
                    $('#opt option[value="' + newopt + '"]').prop('selected', true);
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

<script>
$(document).on('click','#getAdd',function(e){
    e.preventDefault();
    var per_id=$(this).data('id');
    //alert(per_id);
    $('#content-data').html('');
    $.ajax({
        url:'officesupplies/generated',
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