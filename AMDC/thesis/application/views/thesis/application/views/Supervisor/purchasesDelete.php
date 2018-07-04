<?php 
	$conn =mysqli_connect("localhost","root","");
	mysqli_select_db($conn, "itproject");

	//$desc_id = $conn->escape_string($_REQUEST('department_ID'));
	$purc_id = $_GET['pDelete'];
	$sql = $conn->prepare("DELETE FROM purchase_orders WHERE po_id='$purc_id'");
    $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A purchase order has been deleted','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
	//$sql->bind_param("s", $desc_id); 
	$sql->execute();
	$sql->close(); 
	$conn->close();
	//header('location:../data5.php');		
?>