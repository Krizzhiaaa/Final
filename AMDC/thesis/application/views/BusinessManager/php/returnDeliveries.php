<?php 
if(isset($_POST['txtreturn'])){
    $con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
    $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
    $new_purchaseID=$_POST['txtid'];
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");

    for($count = 0; $count < count($_POST["txtreturn"]); $count++ ) {
      $sqlreturn="INSERT INTO returns (return_date, quantity_returned, reason, po_id, supplier_id, supplies_id) VALUES (:return_date , :quantity_returned, :reason, :po_id, :supplier_id, :supplies_id) ";
      $sqlreturned=$connect->prepare($sqlreturn);
      $sqlreturned->execute(
        array(
          ':return_date'   => $date,
          ':quantity_returned'   => $_POST['txtreturn'][$count],
          ':reason' => $_POST['txtnotes'][$count],
          ':po_id' => $_POST['txtid'],
          ':supplier_id'     => $_POST['txtsupplierid'][$count],
          ':supplies_id'     => $_POST['txtsuppliesid'][$count]
         )
      );
    }

    for($count = 0; $count < count($_POST["txtreturn"]); $count++ ) {
      $sqlminus="UPDATE supplies SET quantity_in_stock=(quantity_in_stock - :quantity_returned) WHERE supply_description=:description";
      $resultminus=$connect->prepare($sqlminus);
      $resultminus->execute(
        array(
          ':quantity_returned'   => $_POST['txtreturn'][$count],
          ':description'     => $_POST['txtdesc'][$count]
         )
      );
    }

    for($count = 0; $count < count($_POST["txtreturn"]); $count++ ) {
      $sqlupdate1="UPDATE purchase_orders SET item_delivery_remarks=:item_delivery_remarks, quantity_delivered=:quantity_delivered, notes=:notes WHERE po_id=:po_id ";
      $result_update1=$connect->prepare($sqlupdate1);
      $result_update1->execute(
        array(
          ':item_delivery_remarks' => 'Partial',
          ':quantity_delivered'   => $_POST['txtquantitydelivered'][$count],
          ':notes'     => $_POST['txtnotes'][$count],
          ':po_id' => $_POST['txtid']
         )
      );
    }

    // for($count = 0; $count < count($_POST["txtreturn"]); $count++ ) {
    //   $sqlupdate2="UPDATE purchase_orders_bm SET item_delivery_remarks=:item_delivery_remarks, quantity_delivered=:quantity_delivered, notes=:notes WHERE po_id=:po_id ";
    //   $result_update2=$connect->($sqlupdate2);
    //   $result_update2->execute(
    //     array(
    //       ':item_delivery_remarks' => 'Partial',
    //       ':quantity_delivered'   => $_POST['txtquantitydelivered'][$count],
    //       ':notes'     => $_POST['txtnotes'][$count],
    //       ':po_id' => $_POST['txtid']
    //      )
    //   );
    // }
    //   $new_id=$_POST['txtpoid'][$count];
    //   $new_quantityDelivered=$_POST['txtquantitydelivered'][$count];
    //   $new_notes=$_POST['txtnotes'][$count];
    //   $supplierid=$_POST['txtsupplierid'][$count];
    //   $suppliesid=$_POST['txtsuppliesid'][$count];
    //   $description=$_POST['txtdesc'][$count];
    //   $returned=$_POST['txtreturn'][$count];

    //   if($returned != '' || $description != ''){
    // }
    
    // if for index 0
    header("Location: ../deliveries");
    
}
?>