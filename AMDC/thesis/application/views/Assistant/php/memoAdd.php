<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['addMemo'])) {
  $sql = $con->prepare("INSERT INTO memo (memo_user, memo_date, memo_description, memo_title, soft_deleted) VALUES (?,?,?,?, 'N')");  
  $memo_user = $_POST['memo_user'];
  $memo_date = $_POST['memo_date'];
  $memo_description = $_POST['memo_description'];
  $memo_title = $_POST['memo_title'];

  $sql->bind_param("ssss", $memo_user, $memo_date, $memo_description, $memo_title);

  if($sql->execute()) {
        $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A new memo with title ".$memo_title." has been created by ".$memo_user." on ".$memo_date."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $con->close();
  
  } 

  header("Location: ../memo");
?>