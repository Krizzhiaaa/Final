<?php
if(isset($_POST["number"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
 $order_id = uniqid();
 $datetoday = date('Y\-m\-d\ H:i:s A');
        $conn =mysqli_connect("localhost","root","");
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','".$this->session->userdata('type')." ".$this->session->userdata('fname')." ".$this->session->userdata('lname')." has made a request order','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
$query2 = "INSERT INTO inventory_order (inventory_order_uniq_id, inventory_order_created_date, inventory_order_name, inventory_order_dept, order_id) VALUES (:inventory_order_uniq_id, :inventory_order_created_date, :inventory_order_name, :inventory_order_dept, :order_id)";
  $statement = $connect->prepare($query2);
  $statement->execute(
   array(
    ':inventory_order_uniq_id'       => $order_id,
    ':inventory_order_created_date'  => $_POST["orDate"], 
    ':inventory_order_name' => $_POST["custName"],
    ':inventory_order_dept' => $_POST["department"],
    ':order_id' => $_POST["ordid"]
   )
  );

 for($count = 0; $count < count($_POST["number"]); $count++)
 {  
  $query = "INSERT INTO inventory_order_supplies
  (inventory_order_uniq_id, quantity, supply_name ) 
  VALUES (:inventory_order_uniq_id, :quantity, :supply_name)";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':inventory_order_uniq_id'   => $order_id,
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
}
header("Location: ../order");
?>

