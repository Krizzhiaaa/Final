<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "itproject";

  $pdo = new PDO("mysql:host=localhost;dbname=itproject","root","");

  $conn =mysqli_connect($host, $user, $password, $database) or die('Error connecting to MySQL server.'); // connection to the database
   $connection =mysqli_connect("localhost","root","");
   mysqli_select_db($connection, "itproject");
                                // MEDICAL SUPPLY
  //CREATE or ADD MEDICAL SUPPLY
  if (isset($_POST['addMedSupply'])) {
      $sql = $connection->prepare("INSERT INTO supplies (supply_description, quantity_in_stock, unit, unit_price, supply_type, expiration_date) VALUES (?, ?, ?, ?, 'Medical', ?)");  
      $description=$_POST['Description'];
      $quantity = $_POST['Quantity'];
      $unit= $_POST['Unit'];
      $priceUnit= $_POST['priceUnit'];
      $expirationDate= $_POST['expirationDate'];
      $sql->bind_param("sssss", $description, $quantity, $unit, $priceUnit, $expirationDate);

      if($sql->execute()) {
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A medical supply has been added','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        $success_message = "Added Successfully";
        } else {
        $error_message = "Problem in Adding New Record";
        }
        $sql->close();   
        $connection->close();
        header("Location: ../medicalSupplies.php");
  } 

  //CREATE or ADD OFFICE SUPPLY
  if (isset($_POST['addOfficeSupply'])) {
      $sql = $connection->prepare("INSERT INTO supplies (supply_description, quantity_in_stock, unit, unit_price, supply_type) VALUES (?, ?, ?, ?, 'OFFICE')");  
      $description=$_POST['Description'];
      $quantity = $_POST['Quantity'];
      $unit= $_POST['Unit'];
      $priceUnit= $_POST['priceUnit'];
      $sql->bind_param("ssss", $description, $quantity, $unit, $priceUnit);

      if($sql->execute()) {
        $success_message = "Added Successfully";
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','An office supply has been added','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        } else {
        $error_message = "Problem in Adding New Record";
        }
        $sql->close();   
        $connection->close();
        header("Location: ../officeSupplies.php");
  }  // end of add Medical Supply

    //DELETE MEDICAL SUPPLIES
  if(isset($_GET['medDelete'])){
    $id=$_GET['medDelete'];
    $sqldelete="DELETE FROM supplies WHERE supply_id='$id'";
    $result_delete=mysqli_query($conn,$sqldelete);
    if($result_delete){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A medical supply has been removed','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo'<script>window.location.href="../medicalSupplies.php"</script>';
    }
    else{
        echo'<script>alert("Delete Failed")</script>';
    }
}// END OF DELETE MEDICAL SUPPLIES

    //DELETE OFFICE SUPPLIES
  if(isset($_GET['offDelete'])){
    $id=$_GET['offDelete'];
    $sqldelete="DELETE FROM supplies WHERE supply_id='$id'";
    $result_delete=mysqli_query($conn,$sqldelete);
    if($result_delete){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','An office supply has been removed','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo'<script>window.location.href="../officeSupplies.php"</script>';
    }
    else{
        echo'<script>alert("Delete Failed")</script>';
    }
}// END OF DELETE OFFICE SUPPLIES

    //EDIT FOR MEDICAL SUPPLIES
if(isset($_POST['medEdit'])){
    $new_id=mysqli_real_escape_string($conn,$_POST['txtid']);
    $new_supplyDescription=mysqli_real_escape_string($conn,$_POST['txtsupplyDescription']);
    $new_supplyUnit=mysqli_real_escape_string($conn,$_POST['txtUnit']);
    $new_supplyQuantityInStock=mysqli_real_escape_string($conn,$_POST['txtQuantityInStock']);
    $new_supplyUnitPrice=mysqli_real_escape_string($conn,$_POST['txtUnitPrice']);
    $new_supplyReorderLevel=mysqli_real_escape_string($conn,$_POST['txtReorderLevel']);
    $new_supplyExpirationDate=mysqli_real_escape_string($conn,$_POST['txtExpirationDate']);
    $new_supplyGoodCondition=mysqli_real_escape_string($conn,$_POST['txtGoodCondition']);
    $new_supplyDamaged=mysqli_real_escape_string($conn,$_POST['txtDamaged']);

    $sqlupdate="UPDATE supplies SET supply_description='$new_supplyDescription', unit='$new_supplyUnit', quantity_in_stock='$new_supplyQuantityInStock', unit_price='$new_supplyUnitPrice', reorder_level='$new_supplyReorderLevel', expiration_date='$new_supplyExpirationDate', good_condition='$new_supplyGoodCondition', damaged='$new_supplyDamaged' WHERE supply_id='$new_id' ";
    $result_update=mysqli_query($conn,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Medical supply ".$new_supplyDescription." has been edited','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="../medicalSupplies.php"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF MEDICAL EDIT


//EDIT FOR OFFICE SUPPLIES
if(isset($_POST['offEdit'])){
    $new_id=mysqli_real_escape_string($conn,$_POST['txtid']);
    $new_supplyDescription=mysqli_real_escape_string($conn,$_POST['txtsupplyDescription']);
    $new_supplyUnit=mysqli_real_escape_string($conn,$_POST['txtUnit']);
    $new_supplyQuantityInStock=mysqli_real_escape_string($conn,$_POST['txtQuantityInStock']);
    $new_supplyUnitPrice=mysqli_real_escape_string($conn,$_POST['txtUnitPrice']);
    $new_supplyReorderLevel=mysqli_real_escape_string($conn,$_POST['txtReorderLevel']);
    $new_supplyExpirationDate=mysqli_real_escape_string($conn,$_POST['txtExpirationDate']);
    $new_supplyGoodCondition=mysqli_real_escape_string($conn,$_POST['txtGoodCondition']);
    $new_supplyDamaged=mysqli_real_escape_string($conn,$_POST['txtDamaged']);

    $sqlupdate="UPDATE supplies SET supply_description='$new_supplyDescription', unit='$new_supplyUnit', quantity_in_stock='$new_supplyQuantityInStock', unit_price='$new_supplyUnitPrice', reorder_level='$new_supplyReorderLevel', expiration_date='$new_supplyExpirationDate', good_condition='$new_supplyGoodCondition', damaged='$new_supplyDamaged' WHERE supply_id='$new_id' ";
    $result_update=mysqli_query($conn,$sqlupdate);

    if($result_update){
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Office supply ".$new_supplyDescription." has been edited','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        echo '<script>window.location.href="../officeSupplies.php"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
} // END OF OFFICE EDIT


  // ISSUE TO FOR MEDICAL SUPPLIES
   if (isset($_POST['medIssueTo'])) {
      $sql = $connection->prepare("INSERT INTO issuedsupplies(requestdate, issueddate, description,supplyType, unitInStock, unit, unitPrice, departmentName, branchLocation) VALUES (?, ?, 'Medical', ?, ?, ? ,?)");  
      $date=$_POST['date'];
      $description = $_POST['description'];
      $quantity= $_POST['quantity'];
      $unit= $_POST['unit'];
      $price= $_POST['price'];
      $dep= $_POST['dep'];
      $brn= $_POST['brn'];
      $sql->bind_param("ssssss", $date, $date, $description, $quantity, $unit, $price, $dep, $brn);

      if($sql->execute()) {
      $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Supplies has been issued','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
      $success_message = "Added Successfully";
      } else {
      $error_message = "Problem in Adding New Record";
      }
      $sql->close();   
      $connection->close();
      header("Location: ../medicalSupplies.php");
  } 

