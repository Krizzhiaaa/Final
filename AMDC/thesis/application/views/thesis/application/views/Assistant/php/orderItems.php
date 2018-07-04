<?php
if(isset($_POST["QTY"]))
{
 $connect = new PDO("mysql:host=localhost;itproject", "root", "");
 $inventory_order_supplies_id = uniqid();
 for($count = 0; $count < count($_POST["QTY"]); $count++)
 {  
  $query = "INSERT INTO inventory_order_supplies 
  (inventory_order_supplies_id, supply_name, quantity, inventory_unit) 
  VALUES (:inventory_order_supplies_id, :supply_name, :quantity, :inventory_unit)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':inventory_order_supplies_id'   => $inventory_order_supplies_id,
    ':supply_name'  => $_POST["QTY"][$count], 
    ':quantity' => $_POST["item"][$count], 
    ':inventory_unit'  => $_POST["unit"][$count]
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