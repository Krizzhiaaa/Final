<?php
  if (isset($_POST['number'])) {
    $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
    $order_id = uniqid();
    $random = mt_rand();

  $sql = "INSERT INTO purchase_order_bm (purchase_order_uniq_id, purchase_order_created_date, purchase_order_name, po_key) 
                                VALUES (:purchase_order_uniq_id, :purchase_order_created_date, :purchase_order_name, :po_key)";  

  $statement2 = $connect->prepare($sql);
  $statement2->execute(
   array(
    ':purchase_order_uniq_id'   => $order_id,
    ':purchase_order_created_date' => $_POST["orDate"],
    ':purchase_order_name' => $_POST["custName"],
    ':po_key'     => $random
   )
  );
 
   for($count = 0; $count < count($_POST["number"]); $count++ ) {
    $sql2 = "INSERT INTO purchase_orders (order_date, purchase_order_uniq_id, description, order_quantity, supplier, po_key) VALUES (:order_date, :purchase_order_uniq_id, :description, :order_quantity, :supplier, :po_key)";
    $statement = $connect->prepare($sql2);
    $statement->execute(
   array(
    ':purchase_order_uniq_id'   => $order_id,
    ':order_quantity'  => $_POST["number"][$count], 
    ':description' => $_POST["neym"][$count],
    ':order_date' => $_POST["orDate"], 
    ':supplier'   => $_POST['supp'],
    ':po_key'     => $random
   )
  );
   } 
  if($statement2->execute() && $statement->execute()) {
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }   
  } 
  header("Location: ../purchases");

    // :purchase_order_grandtotal,
  // ':total'      => $_POST['unit_price'] * $_POST['quantity'],

?>