<!--?php 
	$conn =mysqli_connect('localhost','root','', 'itproject');

	//$del_id = $_GET['suppDelete'];
	//if (isset($_GET['suppDelete'])) { 
		//$desc_id = $conn->escape_string($_REQUEST('supplyDesc'));
		//$del_id = $conn->escape_string($_REQUEST['suppDelete']);
	//	$sql = "DELETE FROM supplies WHERE supplierProduct='$del_id'";  
		//$sql->bind_param('i', $_GET['suppDelete']); 
	//	$result = mysqli_query($sql, $query);
		//$sql->execute();
		//$sql->close(); 
		//$conn->close();
	//	header('location:../data3.php');
	//}
	$desc = $conn->escape_string($_GET['purDelete']);
	$sql = "DELETE from purchase_orders WHERE description='$desc'"; 
	if($result = mysqli_query($conn, $sql)) {
      echo' "Deleted Successfully"';
    } else {
      echo' "Problem in Deleting the Record"';
    }

	//header("Location: ../purchases.php");
?>