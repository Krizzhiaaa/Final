<?php
$connection =mysqli_connect("localhost","root","");
mysqli_select_db($connection, "itproject");

  if (isset($_POST['addDep'])) {
  $sql = $connection->prepare("INSERT INTO departments (department_name, location) VALUES (?, ?)");  
  $depName=$_POST['depName'];
  $branch = $_POST['branch'];

  $sql->bind_param("ss", $depName, $branch); 
  if($sql->execute()) {
      $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','New ".$depName." ".$branch." has been added','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $result = $conn->query($notif);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $connection->close();
  } 
  header("Location: ../departments");
?>