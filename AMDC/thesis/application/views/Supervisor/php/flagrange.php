<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['addUser2'])) {
  $expirationdays = $_POST['days'];
  $sql = $con->prepare("UPDATE defaults SET value2='".$expirationdays."' where attribute = 'expirerange'"); 
  if($sql->execute()) {
  $conn =mysqli_connect("localhost","root","");
        $datetoday = date('Y\-m\-d\ H:i:s A');
        mysqli_select_db($conn, "itproject");
        $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','Altered notification parameters to Expiration range = ".$expirationdays." day/s','".$this->session->userdata('type')."')";
        $res1 = $conn->query($notif1);
  header('Location: ' . $_SERVER['HTTP_REFERER']);          
  } else {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  $sql->close();   
  $con->close(); 
//
//  header("Location: ../userAccounts");
}
?>


<!--       <script type="text/javascript">alert("SUCCESS");history.go(-1);</script> -->