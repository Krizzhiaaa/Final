<?php 
	$conn =mysqli_connect("localhost","root","");
	mysqli_select_db($conn, "itproject");

	//$desc_id = $conn->escape_string($_REQUEST('department_ID'));
	$purc_id = $_GET['pDelete'];
	$sql = $conn->prepare("DELETE FROM purchase_orders WHERE po_id='$purc_id'");  
	//$sql->bind_param("s", $desc_id); 
	$sql->execute();
	$sql->close(); 
	$conn->close();
	//header('location:../data5.php');		
?>