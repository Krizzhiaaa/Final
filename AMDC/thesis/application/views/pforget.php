<?php
$con=mysqli_connect('localhost','root','','itproject');  

 //CREATE or ADD User Account
  if (isset($_POST['passforget'])) { 
  $username = $_POST['username'];
      
      
      
      $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
      $sql2 = "SELECT value from defaults where attribute = 'defpass' LIMIT 1";
      $result = $conn->query($sql2); 
      if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
          $sql = $con->prepare("UPDATE users SET password = '".$row['value']."' where username = '".$username."' AND user_type = 'BusinessManager'");
            
              if($sql->execute()) {
              $conn =mysqli_connect("localhost","root","");
                    $datetoday = date('Y\-m\-d\ H:i:s A');
                    mysqli_select_db($conn, "itproject");
                    $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','User ".$username." petition for password reset','','')";
                    $res1 = $conn->query($notif1);
              $success_message = "Added Successfully";
              } else {
              $error_message = "Please proceed to the business manager for password reset";
              }
              $sql->close();   
              $con->close();
              }
            
            
        }
      } 

$conn =mysqli_connect("localhost","root","");
mysqli_select_db($conn, "itproject");
$sql2 = "Select user_type from users where username = '".$username."'";
$result2 = $conn->query($sql2);
$typebm = "BusinessManager";
?>
<?php 
if ($result2->num_rows > 0) {
while($row = $result2->fetch_assoc()) {
  if($typebm == $row['user_type']){
 ?>
    <script type="text/javascript">alert("Password has been reset");history.go(-1);</script>
<?php
    }else if($row['user_type'] = 'Supervisor' || $row['user_type'] = 'Assistant'){
                    $conn =mysqli_connect("localhost","root","");
                    $datetoday = date('Y\-m\-d\ H:i:s A');
                    mysqli_select_db($conn, "itproject");
                    $notif1 = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','User ".$username." petition for password reset','','')";
                    $res1 = $conn->query($notif1);
?>
      <script type="text/javascript">alert("Please proceed to the business manager for password reset");history.go(-1);</script>
  <?php
}
  }
}else{
    ?>
    <script type="text/javascript">alert("Username not recognized");history.go(-1);</script>
<?php 
}

?>