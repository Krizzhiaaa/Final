<?php
if(isset($_POST["number"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");

 for($count = 0; $count < count($_POST["ID"]); $count++)
 {  
  $query2 = "UPDATE inventory_order_supplies SET supply_name=:supply_name, quantity=:quantity, unit_name=:unit_name WHERE inventory_order_supplies_id=:inventory_order_supplies_id ";
  $statement2 = $connect->prepare($query2);
  $statement2->execute(
   array(
    ':inventory_order_supplies_id' => $_POST["ID"][$count], 
    ':supply_name' => $_POST["supplyDesc"][$count],
    ':quantity'  => $_POST["qty"][$count],
    ':unit_name'  => $_POST["unitName"][$count]
   )
  );
 }

 for($count = 0; $count < count($_POST["number"]); $count++)
 {  
  $query = "INSERT INTO inventory_order_supplies
  (inventory_order_uniq_id, supply_name, quantity) 
  VALUES (:inventory_order_uniq_id, :supply_name, :quantity)";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':inventory_order_uniq_id'   => $_POST["uniq_ID"],
    ':quantity'  => $_POST["number"][$count], 
    ':supply_name' => $_POST["neym"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
 $datetoday = date('Y\-m\-d\ H:i:s A');
       $conn =mysqli_connect("localhost","root","");
       mysqli_select_db($conn, "itproject");
       $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','".$this->session->userdata('type')." ".$this->session->userdata('fname')." ".$this->session->userdata('lname')." has updated a request order','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
       $res1 = $conn->query($notif1);
}
header("Location: ../order");
?>

