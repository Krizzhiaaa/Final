 <?php
  $connection =mysqli_connect("localhost","root","");
   mysqli_select_db($connection, "itproject");
 if (isset($_POST['medIssueTo'])) {
      $sql = $connection->prepare("INSERT INTO request_supplies (request_date, issued_date, quantity_ordered) VALUES (?, ?, ?)"); 
      $sql2 = $connection->prepare("INSERT INTO supplies (supply_type, supply_description) VALUES (?, ?)");
      $sql3 = $connection->prepare("INSERT INTO departments (department_name) VALUES (?)");
    //   $sql4 = $connection->prepare("UPDATE supplies SET quantity")
    //   $sqlupdate="UPDATE suppliers SET supplier_status='$new_supplierStatus' WHERE supplier_id='$new_id' ";
    // $result_update=mysqli_query($con,$sqlupdate);

     /* $sql2= $connection->prepare("UPDATE supplies SET quantity_in_stock = (supplies.quantity_in_stock - request_supplies.quantity_ordered) FROM  WHERE supplies.supply_id =  request_supplies.supply_id  ") ; */

      $reqDate = $_POST['reqDate'];
      $issueDate = $_POST['issueDate'];
      $description = $_POST['description'];
      $quantity= $_POST['quantity'];
      $department = $_POST['department'];
      $type = 'Medical';
      $sql->bind_param("sss", $reqDate, $issueDate, $quantity);
      $sql2->bind_param("ss", $type, $description);
      $sql3->bind_param("s", $department);

      if($sql->execute()) {
        $success_message = "Added Successfully";
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Medical supply ".$description." with quantity ".$quantity." has been issued to ".$department."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
        } else {
        $error_message = "Problem in Adding New Record";
        }
        $sql->close();   
        $connection->close();

  }
  header("location: ../issuedSupplies");
?>
