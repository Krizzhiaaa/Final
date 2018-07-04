<?php 
if(isset($_POST['returnFrom'])){
    $con=mysqli_connect('localhost','root','','itproject') or die('Error connecting to MySQL server.');
    $connect = new PDO("mysql:host=localhost;dbname=itproject", "root", "");
    // $new_purchaseID=$_POST['txtid'];
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");

    
      $sqlminus="UPDATE supplies SET quantity_in_stock=(quantity_in_stock + :qty_returned) WHERE supply_id = :supply_id";
      $resultminus=$connect->prepare($sqlminus);
      $resultminus->execute(
        array(
          ':qty_returned'   => $_POST['returnFrom'],
          ':supply_id'     => $_POST['supplyID']
         )
      );

      $sqlupdate1="UPDATE returns SET return_status=:return_status WHERE return_id=:return_id ";
      $result_update1=$connect->prepare($sqlupdate1);
      $result_update1->execute(
        array(
          ':return_status' => 'Returned',
          ':return_id'   => $_POST['returnID']
         )
      );

    header("Location: ../dashboard");
    
}
?>