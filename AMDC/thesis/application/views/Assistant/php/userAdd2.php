

<?php
 
 //CREATE or ADD User Account
  if (isset($_POST['addUser'])) { 
    move_uploaded_file($_FILES['file']['tmp_name'],"./upload/".$_FILES['file']['name']); 
  $con=mysqli_connect('localhost','root','','itproject'); 

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $user_contact = $_POST['user_contact'];
  $password = $_POST['password'];
  $user_email = $_POST['user_email'];
  $passconfirm = $_POST['password2'];
  $_SESSION['fname'] = $fname;
  $_SESSION['lname'] = $lname;
  $_SESSION['username'] = $username;
  $_SESSION['user_email'] = $user_email;
  $_SESSION['password'] = $password;
  $_SESSION['image'] = $_FILES['file']['name'];
  
  $sql = $con->prepare("UPDATE users SET username='".$username."', fname='".$fname."',lname='".$lname."',user_contact='".$user_contact."',password='".$password."',user_email='".$user_email."', image = '".$_FILES['file']['name']."' where user_id = '".$this->session->userdata('id')."' ");

  if($passconfirm == $password){
  
  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','".$this->session->userdata('type')." ".$fname." ".$lname." has edited their profile','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
  $success_message = "Added Successfully";
  } else {
  $error_message = "Problem in Adding New Record";
  }
  $sql->close();   
  $con->close();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  }else{
  ?>
  <script type="text/javascript">alert("Password does not match");</script>
  <?php
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  }  
  } 
?>