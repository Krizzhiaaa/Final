<?php
$connection =mysqli_connect("localhost","root","");
mysqli_select_db($connection, "itproject");
$order_id = uniqid();
  if (isset($_POST['addOrder'])) {
  $sql = $connection->prepare("INSERT INTO inventory_order (inventory_order_uniq_id, inventory_order_created_date, inventory_order_name, inventory_order_dept) VALUES (?, ?, ?, ?)");  
  $inventory_order_id = $order_id;
  $orDate      = $_POST['orDate'];
  $name        = $_POST['custName'];
  $department  = $_POST['department'];

  $sql->bind_param("ssss", $inventory_order_id, $orDate, $name, $department); 
 
   $sql2 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)"); 

  $inventory_order_id = $order_id;
  $supply_name      = $_POST['supply_name'];
  $unit_name        = $_POST['unit_name'];
  $quantity         = $_POST['quantity'];

  $sql2->bind_param("ssss", $inventory_order_id, $supply_name, $unit_name, $quantity);

     $sql3 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name2      = $_POST['supply_name2'];
  $unit_name2        = $_POST['unit_name2'];
  $quantity2         = $_POST['quantity2'];

  $sql3->bind_param("ssss", $inventory_order_id, $supply_name2, $unit_name2, $quantity2);

       $sql4 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name3      = $_POST['supply_name3'];
  $unit_name3        = $_POST['unit_name3'];
  $quantity3         = $_POST['quantity3'];

  $sql4->bind_param("ssss", $inventory_order_id, $supply_name3, $unit_name3, $quantity3);  

       $sql5 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name4      = $_POST['supply_name4'];
  $unit_name4        = $_POST['unit_name4'];
  $quantity4         = $_POST['quantity4'];

  $sql5->bind_param("ssss", $inventory_order_id, $supply_name4, $unit_name4, $quantity4);  

       $sql6 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name5      = $_POST['supply_name5'];
  $unit_name5        = $_POST['unit_name5'];
  $quantity5         = $_POST['quantity5'];

  $sql6->bind_param("ssss", $inventory_order_id, $supply_name5, $unit_name5, $quantity5);  

       $sql7 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name6      = $_POST['supply_name6'];
  $unit_name6        = $_POST['unit_name6'];
  $quantity6         = $_POST['quantity6'];

  $sql7->bind_param("ssss", $inventory_order_id, $supply_name6, $unit_name6, $quantity6);  

       $sql8 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name7      = $_POST['supply_name7'];
  $unit_name7        = $_POST['unit_name7'];
  $quantity7         = $_POST['quantity7'];

  $sql8->bind_param("ssss", $inventory_order_id, $supply_name7, $unit_name7, $quantity7);  

       $sql9 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name8      = $_POST['supply_name8'];
  $unit_name8        = $_POST['unit_name8'];
  $quantity8         = $_POST['quantity8'];

  $sql9->bind_param("ssss", $inventory_order_id, $supply_name8, $unit_name8, $quantity8);  

       $sql10 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name9      = $_POST['supply_name9'];
  $unit_name9        = $_POST['unit_name9'];
  $quantity9         = $_POST['quantity9'];

  $sql10->bind_param("ssss", $inventory_order_id, $supply_name9, $unit_name9, $quantity9);  

       $sql11 = $connection->prepare("INSERT INTO inventory_order_supplies (inventory_order_uniq_id, supply_name, unit_name, quantity) VALUES (?, ?, ?, ?)");  
 
  $inventory_order_id = $order_id;
  $supply_name10      = $_POST['supply_name10'];
  $unit_name10        = $_POST['unit_name10'];
  $quantity10         = $_POST['quantity10'];

  $sql11->bind_param("ssss", $inventory_order_id, $supply_name10, $unit_name10, $quantity10);    

  if($sql->execute() && $sql2->execute() && $sql3->execute() && $sql4->execute()&& $sql5->execute()&& $sql6->execute()&& $sql7->execute()&& $sql8->execute()&& $sql9->execute()&& $sql10->execute()&& $sql11->execute() ) {
  $datetoday = date('Y\-m\-d\ H:i:s A');
        $conn =mysqli_connect("localhost","root","");
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','".$this->session->userdata('type')." ".$this->session->userdata('fname')." ".$this->session->userdata('lname')." has made a request order','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $connection->close();
  } 
  header("Location: ../order");

?>