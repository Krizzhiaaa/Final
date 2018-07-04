<?php
$connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");


function supply_dropdown($connect)
{ 
 $output = '';
 $query = "SELECT * FROM supplies WHERE soft_deleted='N' ORDER BY supply_description ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["item_name"].'">'.$row["supply_description"].'</option>';
 }
 return $output;
}


function unit_measure($connect)
{ 
 $output = '';
 $query = "SELECT * FROM unit_of_measure ORDER BY unit_name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"].'</option>';
 }
 return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assistant | Purchases</title>
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
        <small> Assistant</small>
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
    <!---------------------------------------------------- SUPPLIES MENU -------------------------------------------------------------->
        <li class="active treeview">
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
                  <a href="<?php echo 'officeSupplies' ?>"><i class="fa fa-pencil-square"></i>Office Supplies</a>
                </li>
              </ul>
            </li>
             <li><a href="<?php echo 'inventoryReconciliation' ?>"><i class="glyphicon glyphicon-adjust"></i>Inventory Reconciliation</a></li>
             <li><a href="<?php echo 'reorderUpdate' ?>"><i class="fa fa-bar-chart"></i>Reorder Level Update</a></li>
            <li><a href="<?php echo 'issuedSupplies' ?>"><i class="fa fa-retweet"></i>Issued Supplies</a></li>
      <li><a href="<?php echo 'departmentsOrder' ?>"><i class="fa fa-list"></i>Deparments Order</a></li>
      <li class="active"><a href="<?php echo 'purchases' ?>"><i class="fa fa-shopping-cart"></i>Purchase Orders</a></li>
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
            <i class="fa fa-shopping-cart"></i> <b>Purchase Orders</b>
        <!-- <small>Supplies</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo '../dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-shopping-cart"></i> Purchases</li>
      </ol>
    </section>

       <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                <table style="float:right;">
                    <tr>
                        
                        <th><button type="submit" class="btn btn-primary btn-block btn-success" data-toggle="modal" data-target="#modal-info"><i class=" fa fa-plus">Add Purchase Order</i></button>
            
                    <form id="add_name" name="add_name" method="post" action="purchases/addPurchases">
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
                                                    <center><h5>Assumption Medical Diagnostic Center, Inc.</h5></center>
                                                    <center><h6>10 Assumption Rd., Baguio City</h6></center>
                                                    <center><h6>Philippines</h6></center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                              <div class="box-header">
                                                  <div class="margin">
                                                        <center><h4><b>Add Purchase Order</b></h4></center>
                                                  </div>
                                        <div class="box-body">                                      
                                              <div class="row">
                                              <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Name</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                      </div>
                                                  <input type="text" class="form-control" id="custName" name="custName" value="<?php echo ( $this->session->userdata('fname')); echo' '; echo ( $this->session->userdata('lname'));?>" style="border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" margin="0px auto" readonly>
                                              </div>
                                              </div>
                                              </div>
                                              </div>

                                              <div class="row">
                                              <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Supplier</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">       
                                                        <i class="fa fa-group"></i>
                                                      </div>
                                                  <select class="form-control" name="supp" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                                <option value="">Select a Supplier</option>
                                                <?php
                                                 $conn =mysqli_connect("localhost","root","");
                                                mysqli_select_db($conn, "itproject");
                                                  $sql = "SELECT * FROM suppliers";
                                                  $results = mysqli_query($conn, $sql);

                                                  foreach($results as $supplier) { 
                                                ?>
                                                <option value="<?php echo $supplier["company_name"]; ?>" name="supp"><?php echo $supplier["company_name"]; ?></option>
                                                <?php 
                                                  }
                                                ?>
                                              </select>
                                              </div>
                                              </div>
                                            </div>
                                              <div class="col-md-6">
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

                                          <div class="row">
                                            <div class="col-md-6 pull-right">
                                              <button type="button" name="plus" id="plus" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Row</button>
                                            </div>
                                          </div>

                                      
                                        <div class="table-responsive">
                                          <span id="error"></span>
                                          <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                              <th width="15%"> Quantity </th>
                                              <th width="52.5%"> Description </th>
                                              <th width="16%"> Unit </th>
                                              <th width="16.5%"> Item Type </th>
                                            </tr>
                                            <tr id="row0">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" required />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" required>
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type0" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row1" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant1" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply1" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit1" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type1" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row2" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant2" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply2" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;">
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit2" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type2" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row3" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant3" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;"min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply3" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit3" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type3" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row4" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant4" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply4" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit4" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type4" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row5" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant5" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply5" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit5" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type5" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row6" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant6" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply6" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit6" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type6" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row7" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant7" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply7" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit7" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type7" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row8" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant8" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply8" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                  <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit8" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type8" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                            <tr id="row9" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant9" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply9" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                    <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit9" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type9" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>
                                            <tr id="row10" class="hidden">
                                              <td>
                                                <input class="form-control" type="number" name="number[]" id="quant10" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" min="1" pattern="^[0-9]$" />
                                              </td>
                                              <td>
                                                <select class="form-control filter" name="neym[]" id="supply10" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" >
                                                  <option value=""></option> 
                                                    <?php echo supply_dropdown($connect);?>
                                                </select>
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" name="unit" id="unit10" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                                
                                              <td>
                                                <input class="form-control" type="text" name="type" id="type10" style="width: 100%; border: 0; outline: 0;  background: transparent; border-bottom: 1px solid black;" readonly>
                                              </td>
                                            </tr>

                                          </table>
                                       
                                        </div>
                                        </div> <!-- BOX-BODY -->
                                      <div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success sendbutton" name="submit" id="submit"><i class="fa fa-plus"></i> Add </button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
            <!-- end of Items FORM -->
                            </div>
              </form>
              </th>
                        
              
                    </tr>
                </table>      
            </div>
            <!-- /.box-header -->
                   <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                      <?php
                        $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                        $sql = "SELECT CONCAT(description, ' and ', COUNT(description)-1, ' other item/s.' ) AS 'Description', purchase_order_uniq_id, po_id, order_date, order_quantity, order_unit, po_remarks, description, delivery_date, supply_type, supplier, unit_price, total, quantity_delivered, notes, quantity_remaining, purchase_order_id, purchase_order_created_date, purchase_order_name, purchase_order_status, purchase_order_remarks, purchase_order_grandtotal, soft_deleted, item_delivery_remarks FROM purchase_orders join purchase_order_bm USING(purchase_order_uniq_id) WHERE order_quantity != 0 GROUP BY purchase_order_uniq_id";
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
                      <?php
                        $status = '';
                          if($row["purchase_order_status"] == 'Pending')
                          {
                              $status = '<span class="label label-danger">Pending</span>';
                          }
                          else
                          {
                              $status = '<span class="label label-success">Delivered</span>';
                          }
                      ?>
                      <td><?php echo $row["purchase_order_uniq_id"]; ?></td>
                      <td><?php echo $row["Description"];?></td>
                      <td><?php echo $row["supplier"]; ?></td>
                      <td><?php echo $row["order_date"]; ?></td>
                      <td><?php echo $row["delivery_date"]; ?></td>
                      <td><?php echo $status; ?></td> 
                      <td><?php echo $row["item_delivery_remarks"]; ?></td>
                      <td>

                      <?php if($row['po_remarks'] == 'Pending' || ($row['po_remarks'] == 'Delivered' && $row['item_delivery_remarks'] == 'Partial')) {?>
                       <!-- <div class="btn-group">
                            <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" data-id="<?php // echo $row["purchase_order_id"]; ?>"><i class="fa fa-edit"></i> Update</button>
                        </div> -->
                        <div class="btn-group">
                            <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                        </div>
                        <div class="btn-group">
                              <button type="button" id="getDel" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="fa fa-check"></i> Deliver</button>
                          </div>
                        <?php }elseif($row['po_remarks'] == 'Delivered') { ?>
                        <div class="btn-group">
                            <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                        </div>
                        <?php }else{ ?>
                          <!-- <div class="btn-group">
                            <button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal" data-id="<?php // echo $row["purchase_order_id"]; ?>"><i class="fa fa-edit"></i> Update</button>
                        </div> -->
                        
                        <div class="btn-group">
                            <button type="button" id="getView" class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="glyphicon glyphicon-search"></i> View</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" name="update" id="getUpdate" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalUpdate" data-id="<?php echo $row["purchase_order_id"]; ?>"><i class="glyphicon glyphicon-random"></i> Change Status</button>
                        </div>
                        <?php } ?>
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
                              <th></th>
                          </tr>
                      </tfoot>
            </table>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
              <button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#printrep"><i class="fa fa-copy"></i> Generate Report</button>
            </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="modal fade" id="printrep">
<form name="form42" id="user_form" method="post" action="purchases/generated">
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
                                              <center><h4><b>Generate Purchase Order Report</b></h4></center>
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
                            <label>End date</label>

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
                            <input type="checkbox" name="check_list[]" value="order_quantity" checked>Quantity
                        </div>
                      </div>
                    </div>
                     </div>   
    
                <?php
                  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                  $date = date("Y/m/d");
                  $sql = "SELECT * FROM purchase_orders po join purchase_order_bm pob USING(purchase_order_uniq_id) where po.description != ''";
                  $result = $conn->query($sql);    
                ?>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-primary" name="generated" id=""><i class="fa fa-copy"></i> Generate</button>
              </div>
            </div>
            <!-- /.modal-content -->

          </div>
          <!-- /.modal-dialog -->
        </form> 
        </div>
          </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; AMDC INVENTORY MANAGEMENT SYSTEM. </strong> All rights
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

table#addItem, tr.no_border td {
  border: 0;
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
      "lengthMenu": [[5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, -1], [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, "All"]]
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

<script>
 // date and time 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#date1').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd'
    })
    //Date picker
    $('#date2').datepicker({
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
        <div class="modal fade" id="viewModal" role="dialog">
            <div class="modal-dialog">
                <div id="view-data"></div>
            </div>
        </div>
        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
                <div id="edit-data"></div>
            </div>
        </div>
          <div class="modal fade" id="modalUpdate" role="dialog">
            <div class="modal-dialog">
                <div id="data-content"></div>
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="position: absolute;margin-left: 15%;">
                <div id="content-data"></div>
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
            $('#edit-data').html('');
            $.ajax({
                url:'purchases/editPurchases',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#edit-data').html('');
                $('#edit-data').html(data);
            }).fial(function(){
                $('#edit-data').html('<p>Error</p>');
            });
        });
    </script>
    <script>
        $(document).on('click','#getDel',function(e){
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
                url:'purchases/viewPurchases',
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
        $(document).on('click','#getUpdate',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#data-content').html('');
              $.ajax({
                  url:'purchases/getChange',
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

<?php
$con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
if(isset($_POST["purchEdit"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

 for($count = 0; $count < count($_POST["txtpoid"]); $count++)
 {  
  $query2 = "UPDATE purchase_orders SET description=:description, order_quantity=:order_quantity WHERE po_id=:po_id ";
  $statement2 = $connect->prepare($query2);
  $statement2->execute(
   array(
    ':po_id' => $_POST["txtpoid"][$count], 
    ':description' => $_POST["neym"][$count],
    ':order_quantity'  => $_POST["number"][$count]
   )
  );
 }

 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo '<script>alert("Record Inserted Successfully.");</script>';
 }
}

if(isset($_POST['btnUpdate'])){
    $new_pid=mysqli_real_escape_string($con,$_POST['txtpID']);
    $new_purchasesStatus=mysqli_real_escape_string($con,$_POST['txtstat']);
     $new_deliveryDate=mysqli_real_escape_string($con,$_POST['orDate']);

    if($new_purchasesStatus == 'Pending' && $new_pid == $new_pid){
      $new_purchasesStatus = 'Delivered';
    }else{
      $new_purchasesStatus = 'Pending';
      // $new_deliveryDate = NULL;
    }

    $sqldel="UPDATE purchase_order_bm SET purchase_order_bm.purchase_order_status='$new_purchasesStatus', purchase_order_created_date='CURDATE()' WHERE po_key='$new_pid' ";
    $result_del=mysqli_query($con,$sqldel);

       $sqldel2="UPDATE purchase_orders SET purchase_orders.po_remarks='$new_purchasesStatus', purchase_orders.delivery_date='CURDATE()' WHERE po_key='$new_pid' ";
    $result_del2=mysqli_query($con,$sqldel2);

    if($result_del && $sqldel2){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Purchase ID #".$new_pid." status has been changed to ".$new_purchaseStatus."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="deliveries"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}
?>

<?php
$con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
$pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
if(isset($_POST['btnEdit'])){

    $new_pid=mysqli_real_escape_string($con,$_POST['txtpID']);
    $new_purchasesStatus=mysqli_real_escape_string($con,$_POST['txtstat']);
     $new_deliveryDate=mysqli_real_escape_string($con,$_POST['orDate']);

    if($new_purchasesStatus == 'Pending' && $new_pid == $new_pid){
      $new_purchasesStatus = 'Delivered';
    }else{
      $new_purchasesStatus = 'Pending';
      $new_deliveryDate = NULL;
    }

    $sqldel="UPDATE purchase_order_bm SET purchase_order_bm.purchase_order_status='$new_purchasesStatus', purchase_order_created_date='$new_deliveryDate' WHERE po_key='$new_pid' ";
    $result_del=mysqli_query($con,$sqldel);

       $sqldel2="UPDATE purchase_orders SET purchase_orders.po_remarks='$new_purchasesStatus', purchase_orders.delivery_date='$new_deliveryDate' WHERE po_key='$new_pid' ";
    $result_del2=mysqli_query($con,$sqldel2);

    if($result_del && $sqldel2){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Purchase ID #".$new_pid." status has been changed to ".$new_purchasesStatus."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="deliveries"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }

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
      $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered', notes='$new_notes', order_no='$ordrNo' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);

      $sqlupd="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id' ";
      $result_upd=mysqli_query($con,$sqlupd);

      if($description != "" || $new_quantityDelivered != ""){
        $sqldeliveries="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes."', '".$new_id."', '".$supplierid."', '".$new_pokey."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery=mysqli_query($con,$sqldeliveries);
      }

      if($new_inputExp == $new_OrigExp){
         $sqladd="UPDATE supplies SET quantity_in_stock='$addstock' WHERE supply_id='$new_supid' ";
      $result_add=mysqli_query($con,$sqladd);
      }else{
        $sqlexp="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description, $brand, $unit, $stock, $amount, $new_inputExp, $new_purchaseID, $supplierid)";
        $resultexp=mysqli_query($con,$sqlexp);
      }
    }else {
      $sqlupdate="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered', notes='$new_notes' , quantity_remaining='$quantity_returned', order_no='$ordrNo' WHERE po_id='$new_id' ";
      $result_update=mysqli_query($con,$sqlupdate);

      $sqlupd="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id' ";
      $result_upd=mysqli_query($con,$sqlupd);

      if($description != "" || $new_quantityDelivered != ""){
      $sqldeliveries="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes."', '".$new_id."', '".$supplierid."', '".$new_pokey."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery=mysqli_query($con,$sqldeliveries);
      }
      
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
      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1', order_no='$ordrNo' WHERE po_id='$new_id1' ";
      $result_update1=mysqli_query($con,$sqlupdate1);

      $sqlupd1="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id1' ";
      $result_upd1=mysqli_query($con,$sqlupd1);

      if($description1 != "" || $new_quantityDelivered1 != ""){
      $sqldeliveries1="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes1."', '".$new_id1."', '".$supplierid1."', '".$new_pokey1."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery1=mysqli_query($con,$sqldeliveries1);
      }

      if($new_inputExp1 == $new_OrigExp1){
         $sqladd1="UPDATE supplies SET quantity_in_stock='$addstock1' WHERE supply_id='$new_supid1' ";
      $result_add1=mysqli_query($con,$sqladd1);
      }else{
        $sqlexp1="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description1, $brand1, $unit1, $stock1, $amount1, $new_inputExp1, $new_purchaseID, $supplierid1)";
        $resultexp1=mysqli_query($con,$sqlexp1);
      }
    }else {
      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered1', notes='$new_notes1', quantity_remaining='$quantity_returned1', order_no='$ordrNo' WHERE po_id='$new_id1' ";
      $result_update1=mysqli_query($con,$sqlupdate1);

      $sqlupd1="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id1' ";
      $result_upd1=mysqli_query($con,$sqlupd1);

      if($description1 != "" || $new_quantityDelivered1 != ""){
      $sqldeliveries1="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes1."', '".$new_id1."', '".$supplierid1."', '".$new_pokey1."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery1=mysqli_query($con,$sqldeliveries1);
      }

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
      $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2', order_no='$ordrNo' WHERE po_id='$new_id2' ";
      $result_update2=mysqli_query($con,$sqlupdate2);

      $sqlupd2="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id2' ";
      $result_upd2=mysqli_query($con,$sqlupd2);

      if($description2 != "" || $new_quantityDelivered2 != ""){
      $sqldeliveries2="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes2."', '".$new_id2."', '".$supplierid2."', '".$new_pokey2."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery2=mysqli_query($con,$sqldeliveries2);
      }

      
      if($new_inputExp2 == $new_OrigExp2){
        $sqladd2="UPDATE supplies SET quantity_in_stock='$addstock2' WHERE supply_id='$new_supid2' ";
      $result_add2=mysqli_query($con,$sqladd2);
      }else{
        $sqlexp2="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description2, $brand2, $unit2, $stock2, $amount2, $new_inputExp2, $new_purchaseID, $supplierid2)";
        $resultexp2=mysqli_query($con,$sqlexp2);
      }
    }else {
      $sqlupdate2="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered2', notes='$new_notes2', quantity_remaining='$quantity_returned2', order_no='$ordrNo' WHERE po_id='$new_id2' ";
      $result_update2=mysqli_query($con,$sqlupdate2);

      $sqlupd2="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id2' ";
      $result_upd2=mysqli_query($con,$sqlupd2);

      if($description2 != "" || $new_quantityDelivered2 != ""){
      $sqldeliveries2="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes2."', '".$new_id2."', '".$supplierid2."', '".$new_pokey2."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery2=mysqli_query($con,$sqldeliveries2);
      }

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
      $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3', order_no='$ordrNo' WHERE po_id='$new_id3' ";
      $result_update3=mysqli_query($con,$sqlupdate3);

      $sqlupd3="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id3' ";
      $result_upd3=mysqli_query($con,$sqlupd3);

      if($description3 != "" || $new_quantityDelivered3 != ""){
      $sqldeliveries3="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes3."', '".$new_id3."', '".$supplierid3."', '".$new_pokey3."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery3=mysqli_query($con,$sqldeliveries3);
      }
      
      if($new_inputExp3 == $new_OrigExp3){
        $sqladd3="UPDATE supplies SET quantity_in_stock='$addstock3' WHERE supply_id='$new_supid3' ";
      $result_add3=mysqli_query($con,$sqladd3);
      }else{
        $sqlexp3="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description3, $brand3, $unit3, $stock3, $amount3, $new_inputExp3, $new_purchaseID, $supplierid3)";
        $resultexp3=mysqli_query($con,$sqlexp3);
      }
    }else {
      $sqlupdate3="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered3', notes='$new_notes3', quantity_remaining='$quantity_returned3', order_no='$ordrNo' WHERE po_id='$new_id3' ";
      $result_update3=mysqli_query($con,$sqlupdate3);

      $sqlupd3="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id3' ";
      $result_upd3=mysqli_query($con,$sqlupd3);

      if($description3 != "" || $new_quantityDelivered3 != ""){
      $sqldeliveries3="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes3."', '".$new_id3."', '".$supplierid3."', '".$new_pokey3."', '".$ordrNo."', '".$delBy."')";
      }

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
      $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4', order_no='$ordrNo' WHERE po_id='$new_id4' ";
      $result_update4=mysqli_query($con,$sqlupdate4);

      $sqlupd4="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id4' ";
      $result_upd4=mysqli_query($con,$sqlupd4);

      if($description4 != "" || $new_quantityDelivered4 != ""){
      $sqldeliveries4="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes4."', '".$new_id4."', '".$supplierid4."', '".$new_pokey4."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery4=mysqli_query($con,$sqldeliveries4);
      }
      
      if($new_inputExp4 == $new_OrigExp4){
        $sqladd4="UPDATE supplies SET quantity_in_stock='$addstock4' WHERE supply_id='$new_supid4' ";
      $result_add4=mysqli_query($con,$sqladd4);
      }else{
        $sqlexp4="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description4, $brand4, $unit4, $stock4, $amount4, $new_inputExp4, $new_purchaseID, $supplierid4)";
        $resultexp4=mysqli_query($con,$sqlexp4);
      }
    }else {
      $sqlupdate4="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered4', notes='$new_notes4', quantity_remaining='$quantity_returned4', order_no='$ordrNo' WHERE po_id='$new_id4' ";
      $result_update4=mysqli_query($con,$sqlupdate4);

      $sqlupd4="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id4' ";
      $result_upd4=mysqli_query($con,$sqlupd4);

      if($description4 != "" || $new_quantityDelivered4 != ""){
      $sqldeliveries4="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes4."', '".$new_id4."', '".$supplierid4."', '".$new_pokey4."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery4=mysqli_query($con,$sqldeliveries4);
      }

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
      $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5', order_no='$ordrNo' WHERE po_id='$new_id5' ";
      $result_update5=mysqli_query($con,$sqlupdate5);

      $sqlupd5="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id5' ";
      $result_upd5=mysqli_query($con,$sqlupd5);

      if($description5 != "" || $new_quantityDelivered5 != ""){
      $sqldeliveries5="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes5."', '".$new_id5."', '".$supplierid5."', '".$new_pokey5."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery5=mysqli_query($con,$sqldeliveries5);
      }
      
      if($new_inputExp5 == $new_OrigExp5){
        $sqladd5="UPDATE supplies SET quantity_in_stock='$addstock5' WHERE supply_id='$new_supid5' ";
      $result_add5=mysqli_query($con,$sqladd5);
      }else{
        $sqlexp5="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description5, $brand5, $unit5, $stock5, $amount5, $new_inputExp5, $new_purchaseID, $supplierid5)";
        $resultexp5=mysqli_query($con,$sqlexp5);
      }
    }else {
      $sqlupdate5="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered5', notes='$new_notes5', quantity_remaining='$quantity_returned5', order_no='$ordrNo' WHERE po_id='$new_id5' ";
      $result_update5=mysqli_query($con,$sqlupdate5);

      $sqlupd5="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id5' ";
      $result_upd5=mysqli_query($con,$sqlupd5);

      if($description5 != "" || $new_quantityDelivered5 != ""){
       $sqldeliveries5="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes5."', '".$new_id5."', '".$supplierid5."', '".$new_pokey5."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery5=mysqli_query($con,$sqldeliveries5);
      }

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
      $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6', order_no='$ordrNo' WHERE po_id='$new_id6' ";
      $result_update6=mysqli_query($con,$sqlupdate6);

      $sqlupd6="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id6' ";
      $result_upd6=mysqli_query($con,$sqlupd6);

      if($description6 != "" || $new_quantityDelivered6 != ""){
      $sqldeliveries6="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes6."', '".$new_id6."', '".$supplierid6."', '".$new_pokey6."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery6=mysqli_query($con,$sqldeliveries6);
      }
      
      if($new_inputExp6 == $new_OrigExp6){
        $sqladd6="UPDATE supplies SET quantity_in_stock='$addstock6' WHERE supply_id='$new_supid6' ";
      $result_add6=mysqli_query($con,$sqladd6);
      }else{
        $sqlexp6="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description6, $brand6, $unit6, $stock6, $amount6, $new_inputExp6, $new_purchaseID, $supplierid6)";
        $resultexp6=mysqli_query($con,$sqlexp6);
      }
    }else {
      $sqlupdate6="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered6', notes='$new_notes6', quantity_remaining='$quantity_returned6', order_no='$ordrNo' WHERE po_id='$new_id6' ";
      $result_update6=mysqli_query($con,$sqlupdate6);

      $sqlupd6="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id6' ";
      $result_upd6=mysqli_query($con,$sqlupd6);

      if($description6 != "" || $new_quantityDelivered6 != ""){
      $sqldeliveries6="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes6."', '".$new_id6."', '".$supplierid6."', '".$new_pokey6."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery6=mysqli_query($con,$sqldeliveries6);
      }

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
      $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7', order_no='$ordrNo' WHERE po_id='$new_id7' ";
      $result_update7=mysqli_query($con,$sqlupdate7);

      $sqlupd7="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id7' ";
      $result_upd7=mysqli_query($con,$sqlupd7);

      if($description7 != "" || $new_quantityDelivered7 != ""){
      $sqldeliveries7="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes7."', '".$new_id7."', '".$supplierid7."', '".$new_pokey7."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery7=mysqli_query($con,$sqldeliveries7);
      }
      
      if($new_inputExp7 == $new_OrigExp7){
        $sqladd7="UPDATE supplies SET quantity_in_stock='$addstock7' WHERE supply_id='$new_supid7' ";
      $result_add7=mysqli_query($con,$sqladd7);
      }else{
        $sqlexp7="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description7, $brand7, $unit7, $stock7, $amount7, $new_inputExp7, $new_purchaseID, $supplierid7)";
        $resultexp7=mysqli_query($con,$sqlexp7);
      }
    }else {
      $sqlupdate7="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered7', notes='$new_notes7', quantity_remaining='$quantity_returned7', order_no='$ordrNo' WHERE po_id='$new_id7' ";
      $result_update7=mysqli_query($con,$sqlupdate7);

      $sqlupd7="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id7' ";
      $result_upd7=mysqli_query($con,$sqlupd7);

      if($description7 != "" || $new_quantityDelivered7 != ""){
      $sqldeliveries7="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes7."', '".$new_id7."', '".$supplierid7."', '".$new_pokey7."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery7=mysqli_query($con,$sqldeliveries7);
      }

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
      $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered8', notes='$new_notes8', order_no='$ordrNo' WHERE po_id='$new_id8' ";
      $result_update8=mysqli_query($con,$sqlupdate8);

      $sqlupd8="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id8' ";
      $result_upd8=mysqli_query($con,$sqlupd8);

      if($description8 != "" || $new_quantityDelivered8 != ""){
      $sqldeliveries8="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes8."', '".$new_id8."', '".$supplierid8."', '".$new_pokey8."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery8=mysqli_query($con,$sqldeliveries8);
      }
      
      if($new_inputExp8 == $new_OrigExp8){
        $sqladd8="UPDATE supplies SET quantity_in_stock='$addstock8' WHERE supply_id='$new_supid8' ";
      $result_add8=mysqli_query($con,$sqladd8);
      }else{
        $sqlexp8="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description8, $brand8, $unit8, $stock8, $amount8, $new_inputExp8, $new_purchaseID, $supplierid8)";
        $resultexp8=mysqli_query($con,$sqlexp8);
      }
    }else {
      $sqlupdate8="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered8', notes='$new_notes', quantity_remaining='$quantity_returned8', order_no='$ordrNo' WHERE po_id='$new_id8' ";
      $result_update8=mysqli_query($con,$sqlupdate8);

      $sqlupd8="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id8' ";
      $result_upd8=mysqli_query($con,$sqlupd8);

      if($description8 != "" || $new_quantityDelivered8 != ""){
      $sqldeliveries8="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes8."', '".$new_id8."', '".$supplierid8."', '".$new_pokey8."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery8=mysqli_query($con,$sqldeliveries8);
      }

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
      $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Full', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9', order_no='$ordrNo' WHERE po_id='$new_id9' ";
      $result_update9=mysqli_query($con,$sqlupdate9);

      $sqlupd9="UPDATE purchase_order_bm SET item_delivery_remarks='Full' WHERE po_id='$new_id9' ";
      $result_upd9=mysqli_query($con,$sqlupd9);

      if($description9 != "" || $new_quantityDelivered9 != ""){
      $sqldeliveries9="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Full', '".$new_notes9."', '".$new_id9."', '".$supplierid9."', '".$new_pokey9."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery9=mysqli_query($con,$sqldeliveries9);
      }
      
      if($new_inputExp9 == $new_OrigExp9){
        $sqladd9="UPDATE supplies SET quantity_in_stock='$addstock9' WHERE supply_id='$new_supid9' ";
      $result_add9=mysqli_query($con,$sqladd9);
      }else{
        $sqlexp9="INSERT INTO supplies (supply_description, brand_name, unit, quantity_in_stock, unit_price, expiration_date, delivery_id, suppliers_id) VALUES ($description9, $brand9, $unit9, $stock9, $amount9, $new_inputExp9, $new_purchaseID, $supplierid9)";
        $resultexp9=mysqli_query($con,$sqlexp9);
      }
    }else {
      $sqlupdate9="UPDATE purchase_orders SET item_delivery_remarks='Partial', quantity_delivered='$new_quantityDelivered9', notes='$new_notes9', quantity_remaining='$quantity_returned9', order_no='$ordrNo' WHERE po_id='$new_id9' ";
      $result_update9=mysqli_query($con,$sqlupdate9);

      $sqlupd9="UPDATE purchase_order_bm SET item_delivery_remarks='Partial' WHERE po_id='$new_id9' ";
      $result_upd9=mysqli_query($con,$sqlupd9);

      if($description9 != "" || $new_quantityDelivered9 != ""){
      $sqldeliveries9="INSERT INTO deliveries (delivery_date, delivery_status, delivery_remarks, po_id, supplier_id, po_key, order_no, courier_name) VALUES (CURDATE(), 'Partial', '".$new_notes9."', '".$new_id9."', '".$supplierid9."', '".$new_pokey9."', '".$ordrNo."', '".$delBy."')";
      $sqldelivery9=mysqli_query($con,$sqldeliveries9);
      }

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
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery status with id# ".$new_purchaseID." has been changed to Full','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
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
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A delivery status with id# ".$new_purchaseID." has been changed to Partial','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
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
$(document).on('click','#getAdd',function(e){
    e.preventDefault();
    var per_id=$(this).data('id');
    //alert(per_id);
    $('#content-data').html('');
    $.ajax({
        url:'purchases/addUser2',
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
        url:'purchases/generated',
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
<!--
<script>
 function printcontent(el){
     var restorepage = document.body.innerHTML;
     //var iframe2 = document.getElementById('getView').click().innerHTML;
     var printcontent = document.getElementById(el).click().innerHTML;
     document.body.innerHTML = printcontent;
     window.print();
     document.body.innerHTML = restorepage;
 }
</script>
-->
        
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
    
</body>
</html>