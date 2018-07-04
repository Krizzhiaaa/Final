<?php
$connection =mysqli_connect("localhost","root","");
mysqli_select_db($connection, "itproject");

  if (isset($_POST['addSuppliers'])) {
    $sql = $connection->prepare("INSERT INTO suppliers (sole_proprietor, company_name, supplier_contact, address, product, remarks) VALUES (?, ?, ?, ?, ?, ?)");  
    $prop = $_POST['prop'];
    $suppName = $_POST['suppName'];
    $suppContact = $_POST['suppContact'];
    $suppAddress = $_POST['suppAddress'];
    $suppProduct = $_POST['suppProduct'];
    $suppRemarks = $_POST['suppRemarks'];
    $sql->bind_param("ssssss", $prop, $suppName, $suppContact, $suppAddress, $suppProduct, $suppRemarks); 
    if($sql->execute()) {
      $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','new supplier ".$suppName." has been added with contact# ".$suppContact." and location ".$suppAddress."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
      echo' "Added Successfully"';
    } else {
      echo' "Problem in Adding New Record"';
    }
    $sql->close();   
    $connection->close();
  }
  //$this->load->view('../../BusinessManager/suppliers');
  header("Location: ../suppliers");
  //redirect('/BusinessManager/suppliers');
?>