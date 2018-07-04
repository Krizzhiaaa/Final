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
<!--REMOVE EXPIRED ITEMS-->
<?php
    $conn =mysqli_connect("localhost","root","");
    mysqli_select_db($conn, "itproject");
    $datetoday = date("Y/m/d");
    $sql1 = "UPDATE supplies SET accounted_for = 'Y' where (expiration_date < '".$datetoday."' AND soft_deleted = 'N') AND accounted_for = 'N'";
    $result1 = $conn->query($sql1);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assistant | Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
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

  <script>
    history.forward();
  </script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
           <script>window.location.href = "Assistant/lockscreen"</script>
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
      <span class="logo-lg"><img src="assets/dist/img/amdc2.png" alt="User Image" style="width:160px;height:49px;"></span>
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
          <!-- Messages: style can be found in dropdown.less-->
                   
          <!-- Notifications: style can be found in dropdown.less -->
          <!--            BELL START-->
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
                            <td><small><a display="block" style="color:black" href="<?php echo 'Assistant/departmentsOrder' ?>"><?php echo $row["log_description"];?></a></small></td>
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
                        <form action="Assistant/delete" method="post">
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
              <form action="Assistant/deleteall" method="post">
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
            <li>
            <button type="submit" class="btn btn-default btn-flat" style="background-color:#00a65a; border:none;" data-toggle="modal" data-target="#editflag"><i class="glyphicon glyphicon-cog" style="font-size:25px"></i></button>
          </li>
   <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <?php

                        $con = mysqli_connect("localhost","root","","itproject");
                        $q = "SELECT * FROM users WHERE username = '".$this->session->userdata('username')."' ";
                        $result = $con->query($q);

                        while($row = $result->fetch_assoc()){
                   
                                if($row['image'] == ""){
                                        echo "<img width='100' class='user-image' height='100' src='upload/default.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='user-image' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                              
                        }
                ?>
              <span class="hidden-xs"> <?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?></span>
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
                                        echo "<img width='100' class='img-circle' height='100' src='upload/default.jpg' alt='Default Profile Pic'>";
                                } else {
                                        echo "<img width='100' height='100'  class='img-circle' src='upload/".$row['image']."' alt='Profile Pic'>";
                                }
                                echo "<br>";
                        }
                ?>

                <p><?php echo ( $this->session->userdata('fname'));?> <?php echo ( $this->session->userdata('lname'));?>
                  <small><?php echo ( $this->session->userdata('dept_name'));?> </small>
        <small>Assistant</small>
        </p>
                </li>
                
              <!-- Menu Footer-->
              <li class="user-footer">
        
                <div class="pull-right">
                  <a href="<?php echo 'logout' ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> Sign out</a>
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
<div class="modal fade" id="editflag">
<form name="form1" id="user_form" method="post" action="dashboard/addUser2">
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
                                              <center><h4><b>Update Notification Parameters</b></h4></center>
                                            </div>
                                      </div>
                <div class="box-body">

                        <?php
                          $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                          $date = date("Y/m/d");
                          $sql = "SELECT * From defaults where attribute = 'expirerange'";
                          $result = $conn->query($sql);    
                        ?>
                        <?php if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) { ?>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Day/s to expiration notice</label>
                          <input type="text" class="form-control" name="days" id="days" value="<?php echo $row['value2'] ?>" required />
                        </div>
                          <?php 
                              }
                            }
                          ?>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="addUser2"><i class="fa fa-edit"></i> Update</button>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </form> 
        </div> 
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
                          <label for="exampleInputEmail1">Contact Number</label>
                          <input type="text" class="form-control" name="user_contact" id="user_contact" value="<?php echo $row['user_contact'] ?>" pattern="^[0-9]{11}$" required />
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
                                        echo "<img width='100' class='img-circle' height='100' src='upload/default.jpg' alt='Default Profile Pic'>";
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
                <li><a href="<?php echo 'Assistant/medicalSupplies' ?>"><i class="fa fa-medkit"></i>Medical Supplies</a></li>
                <li class="treeview">
                  <li><a href="<?php echo 'Assistant/officeSupplies' ?>"><i class="fa fa-pencil-square"></i>Office Supplies</a></li>
                </li>
              </ul>
            </li>
            <li><a href="<?php echo 'Assistant/inventoryReconciliation' ?>"><i class="glyphicon glyphicon-adjust"></i>Inventory Reconciliation</a></li>
            <li><a href="<?php echo 'Assistant/reorderUpdate' ?>"><i class="fa fa-bar-chart"></i>Reorder Level Update</a></li>
            <li><a href="<?php echo 'Assistant/issuedSupplies' ?>"><i class="fa fa-retweet"></i>Issued Supplies</a></li>
      <li><a href="<?php echo 'Assistant/departmentsOrder' ?>"><i class="fa fa-list"></i>Departments Order</a></li>
      <li><a href="<?php echo 'Assistant/purchases' ?>"><i class="fa fa-shopping-cart"></i>Purchases</a></li>
      <li><a href="<?php echo 'Assistant/deliveries' ?>"><i class="fa fa-truck"></i>Deliveries</a></li>
          </ul>
        </li>
    <!---------------------------------------------------- SUPPLIERS MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'Assistant/suppliers' ?>">
            <i class="fa fa-user"></i> <span>Suppliers</span>
          </a>
        </li>
    <!---------------------------------------------------- DEPARTMENTS MENU -------------------------------------------------------------->
    <li>
          <a href="<?php echo 'Assistant/departments' ?>">
            <i class="fa fa-building"></i> <span>Departments</span>
          </a>
        </li>
    <!---------------------------------------------------- CALENDAR MENU -------------------------------------------------------------->
    <li>
          <a href="<?php echo 'Assistant/memo' ?>">
            <i class="fa fa-tasks"></i> <span>Memo</span>
          </a>
        </li>
          <!---------------------------------------------------- LOCKSCREEN MENU -------------------------------------------------------------->
        <li>
          <a href="<?php echo 'Assistant/lockscreen' ?>">
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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');

                  $sql = "SELECT COUNT(*) AS total FROM supplies WHERE quantity_in_stock <= reorder_level+10 OR quantity_in_stock = 0";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Reorder Supplies</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <button onclick="myFunction('Demo1')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <!-- ./col -->
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT COUNT(*) as total FROM returns INNER JOIN supplies ON supplies_id = supply_id INNER JOIN suppliers ON returns.supplier_id = suppliers.supplier_id INNER JOIN purchase_orders USING(po_id) WHERE return_status ='Pending'";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Returned Supplies</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <button onclick="myFunction2('Demo2')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $sql = "SELECT COUNT(*) as total FROM deliveries";
                  $result = $conn->query($sql);    
              ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Deliveries</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <button onclick="myFunction3('Demo3')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT COUNT(*) AS total FROM supplies WHERE expiration_date <= '$date' AND soft_deleted='N'";
                  $result = $conn->query($sql);    
                ?>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <h3><?php echo $row["total"]; ?></h3>
                  <?php 
                      }
                    }
                  ?>

              <p>Expired Supplies</p>
            </div>
            <div class="icon">
              <i class="fa fa-exclamation-triangle"></i>
            </div>
            <button onclick="myFunction4('Demo4')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <!-- ./col -->
          
          <!-- TABLE FOR HIDDEN REORDER SUPPLIES TABLE -->
          <div id="Demo1" class="box-body w3-hide">
                <table id="example1" class="table table-bordered table-striped">
                    <center><h2>Reorder Supplies</h2></center>
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
          $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                  $sql = "SELECT supply_id, supply_type, supply_description, brand_name, quantity_in_stock, unit, reorder_level, company_name FROM supplies JOIN suppliers WHERE quantity_in_stock <= reorder_level+10 OR quantity_in_stock = 0 GROUP BY supply_description";
                  $result = $conn->query($sql);
                ?>
                <thead> 
                <tr>
                  <th>Supply Type</th>
                  <th>Brandname</th>
                  <th>Description</th>
                  <th>Supplier</th>
                  <th>Quantity in Stock</th>
                  <th>Unit</th>
                  <th>Reorder Level</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { 
                    $reorder_id = $row["supply_id"];
                    $desc = $row["supply_description"];
                    ?>
                    <tr>
                    <td><?php echo $row["supply_type"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["supply_description"]; ?></td>
                    <td><?php echo $row["company_name"]; ?></td>
                    <td><?php echo $row["quantity_in_stock"]; ?></td>
                    <td><?php echo $row["unit"]; ?></td>
                    <td><?php echo $row["reorder_level"]; ?></td>
                    <td>
                      <a href="Assistant/purchases">
                        <input class="hidden" type="text" name="reorderSupp" id="reorderSupp" hidden value="<?php echo $row["supply_id"]; ?>">
                        <button type="button" class="btn btn-primary"><i class="fa fa-repeat"></i> Reorder </button>
                      </a>
                    </td>
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
                <tfoot>
                   <tr>
                  <th>Supply Type</th>
                  <th>Brandname</th>
                  <th>Description</th>
                  <th>Supplier</th>
                  <th>Quantity in Stock</th>
                  <th>Unit</th>
                  <th>Reorder Level</th>
                  <th>Action</th>
                </tr> 
                </tfoot>
              </table>
          </div>
          <!-- TABLE FOR HIDDEN RETURNED SUPPLIES TABLE -->
          <div id="Demo2" class="box-body w3-hide">
              <table id="example3" class="table table-bordered table-striped">
                  <center><h2>Returned Supplies</h2></center>
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
          $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                  $sql = "SELECT returns.return_id, supply_id, supplies.supply_type, return_date, supply_description, brand_name, company_name, quantity_returned, quantity_in_stock, unit, reason FROM returns INNER JOIN supplies ON supplies_id = supply_id INNER JOIN suppliers ON returns.supplier_id = suppliers.supplier_id INNER JOIN purchase_orders USING(po_id) WHERE return_status ='Pending'";
                  $result = $conn->query($sql);   
                  
                ?>
                <thead>
                <tr>
                  <th class="hidden"></th>
                  <th>Supply Type</th>
                  <th>Date Returned</th>
                  <th>Description</th>
                  <th>Brandname</th>
                  <th>Supplier</th>
                  <th>Quantity</th>
                  <th class="hidden"></th>
                  <th>Unit</th>
                  <th>Reason</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                   ?>
                    <tr>
                    <form action="<?php echo 'Assistant/returns'?>" method="get">
                      <td class="hidden"><input class="hidden" type="hidden" name="supid" hidden value="<?php echo $row["supply_id"]; ?>"></td>
                      <td class="hidden"><?php $return_id = $row['return_id']; ?></td>
                      <td><?php echo $row["supply_type"]; ?></td>
                      <td><?php echo $row["return_date"]; ?></td>
                      <td><?php echo $row["supply_description"]; ?></td>
                      <td><?php echo $row["brand_name"]; ?></td>
                      <td><?php echo $row["company_name"]; ?></td>
                      <td><input type="text" class="form-control" name="qtyReturn" value="<?php echo $row["quantity_returned"]; ?>"  style="border: 0; outline: 0;  background: transparent;" readonly></td>
                      <td class="hidden"><input class="hiden" type="hidden" hidden name="qty" value="<?php echo $row["quantity_in_stock"]; ?>" readonly></td>
                      <td><?php echo $row["unit"]; ?></td>
                      <td><?php echo $row["reason"]; ?></td>
                      <td>
                          <input class="hidden" type="text" name="returnSupp" id="returnSupp" hidden value="<?php echo $row["return_id"]; ?>">
                          <button type="button" id="getEdit" class="btn btn-success" data-toggle="modal" data-target="#returnModal" data-id="<?php echo $row["return_id"]; ?>"><i class="fa fa-undo"></i>Returned </button>
                        
                      </td>
                      </form> 
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="hidden"></th>
                    <th>Supply Type</th>
                    <th>Date Returned</th>
                    <th>Description</th>
                    <th>Brandname</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th class="hidden"></th>
                    <th>Unit</th>
                    <th>Reason</th>
                    <th></th>
                  </tr> 
                </tfoot>
              </table>
          </div>
          <!-- TABLE FOR HIDDEN DELIVERIES SUPPLIES TABLE -->
          <div id="Demo3" class="box-body w3-hide">
              <table id="example5" class="table table-bordered table-striped">
                  <center><h2>Deliveries</h2></center>
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
          $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                  $sql = "SELECT * FROM deliveries";
                  $result = $conn->query($sql);    
                ?>
                <thead>
                <tr>
                  <th>PO Key</th>
                  <th>Delivery Date</th>
                  <th>Delivery Status</th>
                  <th>Delivery Remarks</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <tr>
                    <form action="<?php echo 'Assistant/returns'?>" method="get">
                      <td><?php echo $row["po_key"]; ?></td>
                      <td><?php echo $row["delivery_date"]; ?></td>
                      <td><?php echo $row["delivery_status"]; ?></td>
                      <td><?php echo $row["delivery_remarks"]; ?></td>
                      </form> 
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>PO Key</th>
                    <th>Delivery Date</th>
                    <th>Delivery Status</th>
                    <th>Delivery Remarks</th>
                  </tr> 
                </tfoot>
              </table>
          </div>
          <!-- TABLE FOR HIDDEN EXPIRED SUPPLIES TABLE ------>
          <div id="Demo4" class="box-body w3-hide">
              <table id="example7" class="table table-bordered table-striped">
                  <center><h2>Expired Supplies</h2></center>
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT supply_id, expiration_date, supply_description, brand_name, quantity_in_stock, unit, soft_deleted FROM supplies WHERE expiration_date <= '$date' AND soft_deleted='N'";
                  $result = $conn->query($sql);    
                ?>
                <thead>
                <tr>
                  <th>Expiration Date</th>
                  <th>Description</th>
                  <th>Brandname</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $row["expiration_date"]; ?></td>
                      <td><?php echo $row["supply_description"]; ?></td>
                      <td><?php echo $row["brand_name"]; ?></td>
                      <td><?php echo $row["quantity_in_stock"]; ?></td>
                      <td><?php echo $row["unit"]; ?></td>
                      <td>
                         
                        <form action="Assistant/dispose" method="get">
                          <input type="text" name="disposeSupp" hidden value="<?php echo $row["supply_id"]; ?>">
                          <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash">&nbsp;</i>Dispose</button>
                        </form> 
                      </td>
                    </tr>
                  <?php 
                      }
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                      <th>Expiration Date</th>
                      <th>Description</th>
                      <th>Brandname</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      <th>Action</th>
                  </tr> 
                </tfoot>
              </table>
          </div>
        </div>

        <section class="content">
          <div class="row">
        <h3>Total Expenses per Department</h3>
        
          <!-- BAR CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
                Legend: <i class="fa fa-square text-red"></i> Medical Supplies
                <i class="fa fa-square text-blue"></i> Office Supplies

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $query="SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name GROUP BY inventory_order_dept";
                  $query_result=$conn->query($query);

                  $sql = "SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE supply_type = 'Medical' GROUP BY inventory_order_dept";
                  $result = $conn->query($sql);

                  $sql2 = "SELECT SUM(supplies.unit_price*inventory_order_supplies.quantity) AS 'Total Expense', supplies.supply_type AS 'Type', inventory_order.inventory_order_dept AS 'Department' FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name WHERE supply_type = 'Office' GROUP BY inventory_order_dept";
                  $result2 = $conn->query($sql2);

                  $location = '';
                  while ($row = mysqli_fetch_array($query_result)) {
                    $location .= '"'.$row["Department"].'", ';
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
                  $chart_data1 = $location;
                  $chart_data2 = $total_data1;
                  $chart_data3 = $total_data2;

                ?>
                <canvas id="barChart" style="height:300px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="row">
            <div class="col-md-6">
          <!-- DONUT CHART -->
        <h3>Top 10 used supplies</h3>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Medical Supplies</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                 <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                    $sql = "SELECT supply_name, SUM(quantity) FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) join supplies on inventory_order_supplies.supply_name = supplies.supply_description WHERE inventory_order_status='Fully Issued' AND supply_type='Medical' GROUP BY supply_name ORDER BY quantity DESC LIMIT 10";
                    $result = $conn->query($sql);    
                  ?>
                 <thead>
                        <tr>
                            <th>Description</th>
                            <th>Total Quantity Used</th>
                        </tr>
                 </thead>
                    <tbody>
                      <?php if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) { ?>
                        <tr>
                        <td><?php echo $row["supply_name"]; ?></td>
                        <td><?php echo $row["SUM(quantity)"]; ?></td>
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
          
        <div class="col-md-6">

         
        <!-- DONUT CHART -->
            <h3>&nbsp;</h3>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Office Supplies</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                   <?php
                    $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                    $sql = "SELECT supply_name, SUM(quantity) FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) join supplies on inventory_order_supplies.supply_name = supplies.supply_description WHERE inventory_order_status='Fully Issued' AND supply_type='Office' GROUP BY supply_name ORDER BY quantity DESC LIMIT 10";
                    $result = $conn->query($sql);    
                  ?>
                 <thead>
                        <tr>
                            <th>Description</th>
                            <th>Total Quantity Used</th>
                        </tr>
                 </thead>
                    <tbody>
                      <?php if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) { ?>
                        <tr>
                        <td><?php echo $row["supply_name"]; ?></td>
                        <td><?php echo $row["SUM(quantity)"]; ?></td>
                        </tr>
                      <?php 
                          }
                        }
                      ?>
                    </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
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
      <div class="modal fade" id="reorderModal">
        <form name="form1" id="user_form" method="post">
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
                    <center><h4><b>Reorder Supplies</b></h4></center>
                  </div>
                </div>
              <div class="box-body">
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT * FROM inventory_order JOIN inventory_order_supplies USING(inventory_order_uniq_id) JOIN supplies ON supplies.supply_description=inventory_order_supplies.supply_name JOIN suppliers WHERE supply_description='$desc'";
                  $result = $conn->query($sql);    
                ?>
                <?php 
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <div class="form-group hidden">
                            <label class="col-sm-4 control-label hidden" for="txtid">Order ID</label>
                            <div class="col-sm-6 hidden">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" hidden value="<?php echo $row['inventory_order_id'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="col-sm-4 control-label hidden" for="txtuniqid">Order Unique ID</label>
                            <div class="col-sm-6 hidden">
                                <input type="hidden" class="form-control" id="txtuniqid" name="txtuniqid" hidden value="<?php echo $row['inventory_order_uniq_id'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="col-sm-8 control-label hidden" for="txtstatus"></label>
                            <div class="col-sm-1 hidden">
                                <input type="hidden" class="form-control" id="txtstatus" name="txtstatus" hidden value="<?php echo $row['inventory_order_status'];?>" readonly>
                            </div>
                        </div>

                      <div class="row">      
                        <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supervisor Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" id="custName" name="custName" value="<?php echo $row['inventory_order_name'] ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" margin="0px auto" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                        <input type="text" class="form-control" id="deptName" name="deptName" value="<?php echo $row['inventory_order_dept'];?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                    </div>
                                </div>
                            </div>
                      </div>

                      <div class="row">
                        <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">       
                                            <i class="fa fa-group"></i>
                                        </div>
                                        <input class="form-control" type="text" name="supp" id="supp" value="<?php echo $row['company_name'] ?>" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purchase Order Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?php $date = date("Y-m-d"); ?>
                                        <input type="text" class="form-control" name="orDate" value="<?php echo $date; ?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                    </div>
                                                    <!-- /.input group -->
                                </div>
                            </div>
                      </div>
                    <?php }
                    } ?>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-success" name="btnReturn"><i class="fa fa-undo"></i> Return</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
        </form> 
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

<script>
setTimeout(onUserInactivity, 1000 * 1800)
function onUserInactivity() {
  <?php unset($_SESSION['logged_in']);
  if(!isset($_SESSION['logged_in'])) { ?>
    window.location.href = "Assistant/lockscreen"
   <?php } ?>
}
</script>

<!-- <script type="text/javascript">
setTimeout(onUserInactivity, 1000 * 120)
function onUserInactivity() {
   window.location.href = "<?php //echo 'Assistant/lockscreen'?>"
}
</script> -->
<!-- <?php
//$time = $_SESSION['Time'];
//$time_check=$time-120;
//if($time<$time_check) {
//  $_SESSION['login'] = 'False';
//  if($_SESSION['login'] == 'False'){
//    echo '<script>window.location.href="<?php echo "Assistant/lockscreen" ?>"</script>';
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
    var barChart       = new Chart(barChartCanvas)
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

<!-- SCRIPT ON HIDDEN TABLES -->
<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script>
function myFunction2(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script>
function myFunction3(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script>
function myFunction4(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
    
<!-- DATA TABLES -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    $('#example3').DataTable()
    $('#example4').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example5').DataTable()
    $('#example6').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example7').DataTable()
    $('#example8').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

  })
</script>


<div class="modal fade" id="returnModal" role="dialog">
            <div class="modal-dialog" style="position: absolute;margin-left: 20%;">
                <div id="return-data"></div>
            </div>
        </div>  

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
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#return-data').html('');
            $.ajax({
                url:'deliveries/returnDashboard',
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
