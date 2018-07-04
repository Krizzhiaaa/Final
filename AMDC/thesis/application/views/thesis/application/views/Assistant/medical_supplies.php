<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Assistant | Data</title>
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
    <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
          <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
      <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo 'dashboard' ?>" class="logo">
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
                            var d = new Date();
                            document.getElementById("demo").innerHTML = d.toUTCString();
                        </script>
                    </a>
                </li>
       
          <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                $dtoday = date("Y/m/d");
                $date_select = date("Y-m-d", strtotime('-3 days') ) ;//minus three days
                $sql6 = "SELECT COUNT(*) AS total from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND log_description like '%order%'";
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
                    $sql7 = "select log_id,log_date,log_description from logs where ((log_date BETWEEN '".$date_select."' AND '".$dtoday."') AND log_status = 1) AND log_description like '%order%' order by log_id DESC";
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
              <li>
              <center>
              <form action="deleteall" method="post">
                        <button class="btn-danger" type="submit" name="submit"><i class="glyphicon glyphicon-trash"></i> Delete all Logs</button>
              </form>
              </center>
              </li>
            </ul>
          </li>
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
                $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");
                $dtoday = date("Y/m/d");
                $date_futr = date("Y-m-d", strtotime('+30 days') ) ;
                $date_past = date("Y-m-d", strtotime('-1 year') ) ;
                $date_select = date("Y-m-d", strtotime('-3 days') ) ;//minus three days
                $sql5 = "SELECT COUNT(*) AS total FROM supplies where quantity_in_stock < reorder_level";
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
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/dist/img/assistant.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Assistant</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/dist/img/assistant.png" class="img-circle" alt="User Image">

                <p>
                 Assistant
                  <small>Member since Oct. 2017</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                      <button type="submit" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editprof">Edit Profile</button>
                </div>
                <div class="pull-right">
                  <a href="<?php echo '../logout' ?>" class="btn btn-default btn-flat">Sign out</a>
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
                <div class="margin">
                    <center><h3><b>Edit Profile</b></h3></center>
                  </div>
              </div>
                <!-- end of modal header -->
              <div class="modal-body">
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
                    
                       <div class="form-group">
                          <label for="exampleInputEmail1">Username</label>
                          <input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'] ?>" required />
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="name" class="form-control" name="fname" id="fname" value="<?php echo $row['fname'] ?>" required />
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input type="name" class="form-control" name="lname" id="lname" value="<?php echo $row['lname'] ?>" required />
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact Number</label>
                          <input type="text" class="form-control" name="user_contact" id="user_contact" value="<?php echo $row['user_contact'] ?>" pattern="^[0-9]{11}$" required />
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $row['user_email'] ?>" required />
                        </div>
                    
                          <?php 
                              }
                            }
                          ?>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
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
          <img src="../assets/dist/img/assistant.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Assistant</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Inventory System</li>
  <!-- DASHBOARD MENU -->
         <li>
          <a href="<?php echo 'dashboard' ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
    <!-- SUPPLIES MENU -->
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i> <span>Supplies</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      <li class ="active"><a href="<?php echo 'medicalSupplies' ?>"><i class= "fa fa-medkit"></i> Medical Supplies</a></li>
      <li><a href="<?php echo 'officeSupplies' ?>"><i class="fa fa-pencil-square-o"></i> Office Supplies</a></li>
          </ul>
        </li>
        <!-- PURCHASES -->
          <li>
              <a href="<?php echo 'purchases' ?>">
                  <i class="fa fa-tags"></i><span>Purchases</span>  
              </a>
          </li>
        <!-- ISSUED SUPPLIES -->
            <li><a href="<?php echo 'issuedSupplies' ?>">
                <i class="fa fa-truck"></i><span>Issued Supplies</span> 
                </a>
          </li>
    <!-- SUPPLIERS MENU -->
        <li>
          <a href="<?php echo 'suppliers' ?>">
            <i class="fa fa-user"></i> <span>Suppliers</span>
          </a>
        </li>
    <!-- DEPARTMENTS MENU -->
        <li>
          <a href="<?php echo 'departments' ?>">
            <i class="fa fa-building"></i> <span>Departments</span>
          </a>
        </li>
    <!-- CALENDAR MENU -->
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
<!-- LOCKSCREEN MENU -->
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
          <b>Medical Supplies</b>
        <!-- <small>Supplies</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Medical Supplies</a></li>
        <li class="active">Supplies</li>
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
                        <select name="dropdown" onchange="location =this.value;">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Supplies
                          <span class="caret"></span>
                        </button>
                          <option><b>All Supplies</b></option>
                          <option value="php/medTotalQty.php">Total Quantity</optiom>
                        </select>
                      </div></th>
                    </tr>
                </table> 
                <table style="float:right;">
                    <tr>
                        <th><button type="submit" class="btn btn-primary btn-block btn-warning" data-toggle="modal" data-target="#modal-info">Add</button>
                        
                        <form name="addSupply" method="post" action="php/suppliesFunctions.php">
                        <div class="modal fade" id="modal-info">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <div class="margin">
                                            <h3>Add Supply</h3>
                                          </div>
                                      </div>
                                        <!-- end of modal header -->
                                      <div class="modal-body">
                                        <div class="box-body">

                                                  <!-- DATE -->
                                                <!-- <div class="form-group">
                                                    <label>Date Received</label>
                                                <div class="input-group date"/>
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                                  <input type="date" class="form-control pull-right" id="datepicker" required />
                                                </div>
                                                     /.input group
                                              </div> -->
                                            
                                            <!-- TIME 
                                                <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                  <label>Time Received</label>

                                                  <div class="input-group">
                                                    <input type="time" class="form-control timepicker" required />

                                                    <div class="input-group-addon">
                                                      <i class="fa fa-clock-o"></i>
                                                    </div>
                                                  </div>
                                                       /.input group
                                                </div>
                                                      /.form group
                                              </div> -->
                                          <!-- /.form group -->
                                            <div class="form-group">
                                                  <label for="exampleInputEmail1">Description</label>
                                                  <input type="text" class="form-control" id="Description" name="Description" required />
                                                </div>
                                              
                                              <!-- <div class="form-group">
                                                  <label for="exampleInputEmail1">Supplier</label>
                                                  <input type="text" class="form-control" name=Supplier""
                                                  required />
                                                </div> -->
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Quantity</label>
                                                  <input type="number" class="form-control" id="Quantity" name="Quantity" required />
                                                </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Unit</label>
                                                  <input type="text" class="form-control" id="Unit" name="Unit" required />
                                                </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Unit Price</label>
                                                  <input type="number" class="form-control" id="priceUnit" name="priceUnit" required />
                                                </div>
                                              <!-- Date and Time -->
                                                <div class="form-group">
                                                    <label>Expiration Date</label>

                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control pull-right" id="datepicker2" name="expirationDate">
                                                    </div>
                                                          <!-- /.input group --> 
                                                  </div>                                
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" class="btn btn-success" data-toggle="modal" data-target="#modal-success">Save Supply</button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>

                                <div class="modal modal-success fade" id="modal-success">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>Are you sure to add this item?&hellip;</h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-outline" name="addMedSupply">Save changes</button>

                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
                                </form>
                            </th> 
                              
                            <!--- END OF ADD -->
                        <!---  ISSUE BUTTON -->
                        <th><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                        Issue To
                                      </button>
                                <form name ="form2" method="post" action="suppliesFunctions.php">
                                <div class="modal fade" id="modal-default">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <div class="margin">
                                            <h3>Issue Supplies</h3>
                                          </div>
                                      </div>
                                        <!-- end of modal header -->
                                      <div class="modal-body">
                                              <!-- Date and Time -->
                                                 <div class="form-group">
                                                    <label>Issue Date</label>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control pull-right" id="datepicker3" name="date">
                                                    </div>
                                                    <!-- /.input group -->
                                                  </div>
                                          <!-- /.form group -->
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Description</label>
                                                  <input type="text" class="form-control" name="description">
                                                </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Quantity</label>
                                                  <input type="number" class="form-control" name="quantity">
                                                </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Unit</label>
                                                  <input type="text" class="form-control" name="unit">
                                            </div>
                                            <div class="form-group">
                                                  <label for="exampleInputEmail1">Price</label>
                                                  <input type="number" class="form-control" name="price">
                                            </div>
                                            <div class="department">
                                                <select name = "department">
                                                <option value="">Select a Department</option>
                                                <?php
                                                  require("../../../db.php");
                                                  $sql = "SELECT * FROM departments";
                                                  $results = mysqli_query($conn, $sql);

                                                  foreach($results as $department) { 
                                                ?>
                                                <option value="<?php echo $department["department_id"]; ?>" name="dep"><?php echo $department["department_name"]; ?></option>
                                                <?php 
                                                  }
                                                ?>
                                              </select>

                                              <select name = "department">
                                                <option value="">Select a branch</option>
                                                <?php
                                                  require("../../../db.php");
                                                  $sql = "SELECT * FROM departments";
                                                  $results = mysqli_query($conn, $sql);

                                                  foreach($results as $branch) { 
                                                ?>
                                                <option value="<?php echo $branch["department_id"]; ?>" name="brn"><?php echo $branch["branch_location"]; ?></option>
                                                <?php 
                                                  }
                                                ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="medIssueTo">Issue Supplies</button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                              </form>
                                <!-- /.modal --></th>
                    </tr>
                </table>      
            </div>
              
      <div class="box-body">
        <table id="example" class="table table-bordered table-striped">
         
          <thead>
            <tr>
             <!-- <th>Date Received</th>
                  <th>Time Received</th> -->
                  <th>Expiration Date</th> 
                  <th>Description</th>
                  <th>Quantity in Stock</th>
                  <th>Unit</th>
                  <th>Unit Price</th>
             <!-- <th>Total Amount</th> -->
                  <th>Reorder Level</th>
                  <th>Good Condition</th>
                  <th>Damaged</th>
                  <th> Action</th> 
            </tr>
        </thead>
        

        <tfoot>
           <tr>
             <!-- <th>Date Received</th>
                  <th>Time Received</th> -->
                  <th>Expiration Date</th> 
                  <th>Description</th>
                  <th>Quantity in Stock</th>
                  <th>Unit</th>
                  <th>Unit Price</th>
             <!-- <th>Total Amount</th> -->
                  <th>Reorder Level</th>
                  <th>Good Condition</th>
                  <th>Damaged</th>
                  <th> Action</th> 
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
        <div class="col-xs-12">
          <button type="button" class="btn btn-default pull-right" style="margin-right: 1px;"><i class="fa fa-print"></i>
            <a href="../examples/medicalSuppliesPrint.php"> Print</a>
          </button>
        </div>
      </div>
        <!-- END OF PRINT AND PDF -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; Bigornia, Cabalse, Calimlim, Calub, Duco, Malong, Siapno, Soy. </strong> All rights
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
   
    <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                'autoWidth' : false,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url:"php/medicalSuppliesFetch.php",
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
                url:'php/medicalSuppliesEdit.php',
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
</body>
</html>
