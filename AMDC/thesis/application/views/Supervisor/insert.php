<?php
//insert.php;

if(isset($_POST["supply_name]"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
 $inventory_order_id = uniqid();
 for($count = 0; $count < count($_POST["supply_name"]); $count++)
 {  
  $query = "INSERT INTO inventory_order_supplies
  (supply_name, quantity, inventory_unit) 
  VALUES (:inventory_order_id, :supply_name, :quantity, :inventory_unit)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':inventory_order_id'   => $inventory_order_id,
    ':supply_name'  => $_POST["supply_name"][$count], 
    ':quantity' => $_POST["quantity"][$count], 
    ':inventory_unit'  => $_POST["inventory_unit"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>