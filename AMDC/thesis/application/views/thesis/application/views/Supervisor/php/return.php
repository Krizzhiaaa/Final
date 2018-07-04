<?php
    $datetoday = date('Y\-m\-d\ H:i:s A');
    $con2 =mysqli_connect("localhost","root","");
        mysqli_select_db($con2, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A supply has been returned','".$this->session->userdata('username')."','".$this->session->userdata('type')."')";
        $res1 = $con2->query($notif1);
    $conn =mysqli_connect("localhost","root","");
    mysqli_select_db($conn, "itproject");
    
    $id = $_GET['returnSupp'];
    $supid = $_GET['supid'];
    $qty= $_GET['qty'];
    $qtyReturn= $_GET['qtyReturn'];
    $add=$_GET['qty'] + $_GET['qtyReturn'];
 
    $sql = $conn->prepare("UPDATE returns join supplies on supplies_id = supply_id SET return_status='Returned' WHERE return_id='$id'");
    $sqladd = $conn->prepare("UPDATE supplies join returns on supplies_id = supply_id SET quantity_in_stock='$add' WHERE supply_id='$supid'");
    $sql->execute();
    $sqladd->execute();
    $sql->close(); 
    $sqladd->close();  
    $conn->close();
        
       

    header ('Location: ../dashboard');
?> 
