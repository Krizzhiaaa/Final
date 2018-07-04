<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['generated'])) { 
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];
  $arr = $_POST['check_list'];
      
if(!empty($_POST['check_list'])) {
$val = implode(",",$_POST['check_list']);
}
  $date = date("Y/m/d");
  $sql = $con->prepare("SELECT ".$val." FROM supplies WHERE expiration_date <= '$date' AND soft_deleted='N' AND (expiration_date BETWEEN '".$date1."' AND '".$date2."')");
    
  $conn = mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
  $date = date("Y/m/d");
  $sql2 = "SELECT ".$val." FROM supplies WHERE expiration_date <= '$date' AND soft_deleted='N' AND (expiration_date BETWEEN '".$date1."' AND '".$date2."')";
  $result = $conn->query($sql2);     
?>
<html>
<head>
  <title>Business Manager | Purchases</title>
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
  <!-- DataTables
  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- <script src="../assets/jquery/jquery-1.12.4.js"></script>
  <!- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
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
  <link rel="stylesheet" href="../assets/table/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/table/buttons.dataTables.min.css">

    <script src="../assets/table/jquery-1.12.4.js"></script>
    <script src="../assets/table/jquery.dataTables.min.js"></script>
    <script src="../assets/table/dataTables.buttons.min.js"></script>
    <script src="../assets/table/buttons.flash.min.js"></script>
    <script src="../assets/table/jszip.min.js"></script>
    <script src="../assets/table/pdfmake.min.js"></script>
    <script src="../assets/table/vfs_fonts.js"></script>
    <script src="../assets/table/buttons.html5.min.js"></script>
    <script src="../assets/table/buttons.print.min.js"></script>
    <script src="../assets/table/buttons.colVis.min.js"></script>
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables
<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
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
</head>
<body>
    <div class="theone">
    <div class="company">
    <span><img src="http://amdc.com.ph/wp-content/uploads/2017/10/AMDC-Header-1.png" alt="User Image" style="width:200px;height:100px;"></span>
    </div>
    </div>
    <div class="id">
    <center><h1 class="idtitle">Expired Supplies Report</h1></center>
    </div>
    <div>
    <hr class="first">
    </div>
    </div>
    <div style="width:100%;height:auto;">
    <div>
    <div class="div1">
    <h4>Delivery Details</h4>
    <table class="top1">
    <tr class="tr1">
    <td class="td1"><b><h4>Date Today:</h4></b></td>
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td1"><h4>PO number:</h4></td>
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td1"><h4>PO reference:</h4></td>
    <td class="td11"><h4></h4></td>
    </tr>
    </table>
    </div>
    <div class="div2">
    <h4>Reciever Information</h4>
    <table class="top2">
    <tr class="tr2">
    <td class="td2"><b><h4>Ship To:</h4></b></td>
    <td class="td21"><h4></h4></td>
    </tr>
    <tr class="tr2">
    <td class="td2"><h4>Department:</h4></td>
    <td class="td21"><h4></h4></td>
    </tr>
    <tr class="tr2">
    <td class="td2"><h4>Contact Number:</h4></td>
    <td class="td21"><h4></h4></td>
    </tr>
    </table>
    </div>
    </div>
    </div>
<div>
<table class="main">
            <thead>
              <tr class="main">
                  <?php
                  if(in_array("expiration_date",$_POST['check_list']) == true ){
                  ?>
                  <th class="main">Expiration Date</th>
                  <?php
                  }
                  if(in_array("supply_description",$_POST['check_list']) == true ){
                  ?>
                  <th class="main">Item Description</th>
                  <?php
                  }
                  if(in_array("brand_name",$_POST['check_list']) == true ){
                  ?>
                  <th class="main">Brand Name</th>
                  <?php
                  }
                  if(in_array("quantity_in_stock",$_POST['check_list']) == true ){
                  ?>
                  <th class="main" class="main">Quantity In Stock</th>
                  <?php
                  }
                  if(in_array("unit",$_POST['check_list']) == true ){
                  ?>
                  <th class="main">Unit</th>
                  <?php
                  }
                  ?>
              </tr>
            </thead>
                <?php if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    if(in_array("expiration_date",$_POST['check_list']) == true ){
                    $expdate = $row['expiration_date'];
                    }
                    if(in_array("supply_description",$_POST['check_list']) == true ){
                    $desc = $row['supply_description'];
                    }
                    if(in_array("brand_name",$_POST['check_list']) == true ){
                    $brand = $row['brand_name'];
                    }
                    if(in_array("quantity_in_stock",$_POST['check_list']) == true ){
                    $quant = $row['quantity_in_stock'];
                    }
                    if(in_array("unit",$_POST['check_list']) == true ){
                    $unit = $row['unit'];
                    }
                ?>
                    <tr class="main" id="row0">
                      <?php
                      if(in_array("expiration_date",$_POST['check_list']) == true ){
                      ?>
                      <td class="main"><?php echo $expdate; ?></td>
                      <?php
                      }
                      if(in_array("supply_description",$_POST['check_list']) == true ){
                      ?>
                      <td class="main"><?php echo $desc; ?></td>
                      <?php
                      }
                      if(in_array("brand_name",$_POST['check_list']) == true ){
                      ?>
                      <td class="main"><?php echo $brand; ?></td>
                      <?php
                      }
                      if(in_array("quantity_in_stock",$_POST['check_list']) == true ){
                      ?>
                      <td class="main" class="main"><?php echo $quant; ?></td>
                      <?php
                      }
                      if(in_array("unit",$_POST['check_list']) == true ){
                      ?>
                      <td class="main" class="main"><?php echo $unit; ?></td>
                      <?php
                      }
                      ?>
                      </tr>
                  <?php 
                      }
                    }
                  ?>
</table>
</div>
<div>
<div class="foot1 div1">
    <table class="top1 lasttab">
    <thead>
    <tr class="main">
    <th class="main">Remarks</th>
    </tr>
    </thead>
    <tr class="tr1">
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td11"><h4></h4></td>
    </tr>
    <tr class="tr1">
    <td class="td11"><h4></h4></td>
    </tr>
    </table>
</div>
<div class="foot2 div2">
    <table class="top2 lasttab">
    <thead>
    <tr class="main">
    <th class="main">Total</th>
    <th class="main"></th>
    </tr>
    </thead>
    <tr class="tr2">
    <td class="td2"><b><h4>Total Quantity</h4></b></td>
    <td class="td21"><h4></h4></td>
    </tr>
    <tr class="tr2">
    <td class="td2"><h4>Total Costs</h4></td>
    <td class="td21"><h4></h4></td>
    </tr>
    <tr class="tr2">
    <td class="td2"><h4>TAX/VAT</h4></td>
    <td class="td21"><h4></h4></td>
    </tr>
    </table>
</div>
</div>
<div>
<div class="div1 leftsign">
<hr class="ending1">
<h4 class="ending1title">Section Head</h4>    
</div>
<div class="div2 rightsign">
<hr class="ending2">
<h4 class="ending2title">Purchasing Officer</h4>
</div>
</div>
</body>
</html>
<?php
  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Generated a report for Expired supplies from ".$date1." to ".$date2."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
        
  
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $con->close();
  
  } 

  //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<style>
    html{
        font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif;
    }
    table.main {
        width: 100%;
        border:solid black 2px;
        border-radius:6px;
        border-collapse: collapse;
    }
    th.main{
        height: 50%;
        text-align: left;
        background-color: white;
        color: black;
    }
    th.main, td.main{
        padding: 5px;
    }
    td.main{
        border: 1px solid #ddd;
        text-align: left;
    }
    th{
        color: black;
    }
    table.top1 {
        width: 100%;
        float: left;
        margin-bottom: 10px;
        border-collapse: collapse;
    }
    
    table.top2 {
        width: 100%;
        float: right;
        margin-bottom: 10px;
        border-collapse: collapse;
    }
    td.td1,td.td2{
        width: 40%;
        text-align: left;
    }
    td.td11,td.td21{
        width: auto;
        border: 1px solid #ddd;
        text-align: left;
    }
    h1.compname{
        font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif;
        color: black;
        font-size:2em;
    }
    div.company{
        width: 40%;
    }
    hr.first{
    display: block;
    margin-bottom: 10px;
    border-style: solid;
    border-width: 3px;
    color: black;
    }
    div.id{
        width: 100%;
        margin-bottom: 10px;
        text-align: right;
    }
    h1.idtitle{
        font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif;
        color: black;
        font-size:1.5em;
    }
    div.foot1, div.foot2{
        margin-top: 10px;
    }
    .ending1{
        margin-top: 155px;
        align-content: left;
        margin-right: 20%;
        margin-left: 20%;
        border-style: solid;
        border-width: 1.5px;
    }
    .ending2{
        margin-top: 150px;
        align-content: right;
        margin-left: 20%;
        margin-right: 20%;
        border-style: solid;
        border-width: 1.5px;
    }
    .ending1title{
        align-content: left;
        margin-right: 20%;
        margin-left: 40%;
    }
    .ending2title{
        align-content: right;
        margin-left: 40%;
        margin-right: 20%;
    }
    div.leftsign,div.rightsign{
        width: 20%;
    }
    div.rightsign{
        float: right;
    }
    div.leftsign{
        float: left;
    }
    .lower{
        margin-top: 178px;
    }
    h4{
        color:black;
        margin: none;
    }
    div.div1{
        width: 49%;
        float: left;
    }
    div.div2{
        width: 49%;
        float: right;
    }
    lasttab{
        margin-bottom: 20px;
    }
        @media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
</style>

<script>
window.print();
history.go(-2);
</script>