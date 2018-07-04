<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['addUser'])) {
  $sql = $con->prepare("INSERT INTO users (username, user_type, fname, lname, user_contact, password, user_email, dept_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");  
  $username = $_POST['username'];
  $role = $_POST['roletype'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_contact = $_POST['user_contact'];
  $password = $_POST['password'];
  $user_email = $_POST['user_email'];
  $dept_name = $_POST['dept_name'];
  $confirmpassword = $_POST['confirmpassword'];
  $addUser= $_POST['addUser'];
  $usernamelength= strlen($username);
  $passwordlength= strlen($password);

  $sql->bind_param("ssssssss", $username, $role, $fname, $lname, $user_contact, $password, $user_email, $dept_name);


if (isset($addUser)){
if ($usernamelength < 6){
$output= "<br><redtext> Invalid username. Username must be at least 6 characters</redtext>";
}elseif ($usernamelength > 15){
$output= "<br><redtext> Invalid username. Username cannot be greater than 15 characters</redtext>";
}

if ($passwordlength < 6){
$output2= "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
}elseif ($passwordlength > 15){
$output2= "<br><redtext> Invalid password. Password cannot be greater than 15 characters</redtext>";
}
    
}  
if($confirmpassword == $password){
   
  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Added new user ".$username."','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
        ?>
  <script type="text/javascript">alert("Added Successfully");history.go(-1);</script>
  <?php             
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $con->close();
  }else{
?>
      <script type="text/javascript">alert("Password does not match");history.go(-1);</script>
  <?php
  }
  } 
//
//  header("Location: ../userAccounts");
?>


<!--       <script type="text/javascript">alert("SUCCESS");history.go(-1);</script> -->