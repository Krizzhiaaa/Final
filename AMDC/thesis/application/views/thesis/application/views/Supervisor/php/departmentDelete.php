<?php 
    $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A department has been removed','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
	$conn =mysqli_connect("localhost","root","");
	mysqli_select_db($conn, "itproject");

	//$desc_id = $conn->escape_string($_REQUEST('department_ID'));
	$desc_id = $_GET['dDelete'];
	$sql = $conn->prepare("DELETE FROM departments WHERE department_id='$desc_id'");  
	//$sql->bind_param("s", $desc_id); 
	$sql->execute();
	$sql->close(); 
	$conn->close();
	//header('location:../data4.php');		
?>