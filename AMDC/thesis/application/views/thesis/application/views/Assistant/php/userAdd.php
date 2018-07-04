<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['addUser'])) {
  $sql = $con->prepare("INSERT INTO users (username, user_type, fname, lname, user_contact, password, user_email, dept_name) VALUES (?, ?, ?, ?, ?, MD5(?), ?, ?)");  
  $username = $_POST['username'];
  $user = $_POST['usertype'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_contact = $_POST['user_contact'];
  $password = $_POST['password'];
  $user_email = $_POST['user_email'];
  $dept_name = $_POST['dept_name'];


  $sql->bind_param("ssssssss", $username, $user, $fname, $lname, $user_contact, $password, $user_email, $dept_name);

  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Added new user with username ".$username." and user email  ".$user_email."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $con->close();
  
  } 

  header("Location: ../userAccounts");
?>