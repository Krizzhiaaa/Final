<?php
$connection =mysqli_connect("localhost","root","");
mysqli_select_db($connection, "itproject");

  if (isset($_POST['addDep'])) {
  $sql = $connection->prepare("INSERT INTO departments (department_name, location) VALUES (?, ?)");  
  $depName=$_POST['depName'];
  $branch = $_POST['branch'];

  $sql->bind_param("ss", $depName, $branch);

$conns =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
  $sql2 = "SELECT * FROM departments WHERE department_name = '$depName' && location = '$branch'";
   $results = $conns->query($sql2);

if ($results->num_rows <= 0) {
      if(preg_match("/^ /", $depName) || preg_match("/^ /", $branch)){?>
          <script>alert('Please fill out the Entry');
          document.location='../departments';
          </script>;
          <?php
          exit();
      } else {
        if($sql->execute()) {
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','new department ".$depName." has been added','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
          $success_message = "Added Successfully";
          $conn =mysqli_connect("localhost","root","");
          $datetoday = date('Y\-m\-d\ H:i:s A');
          mysqli_select_db($conn, "itproject");
          $notif = "insert into logs (log_date,log_description,user,module) VALUES ('".$datetoday."','A department has been added','".$this->session->userdata('fname')." ".$this->session->userdata('lname')."','".$this->session->userdata('type')."')";
          $result = $conn->query($notif);
        } else {
           $error_message = "Problem in Adding New Record";
        }
        $sql->close();   
        $connection->close();
      }
  
} else{?>
  <script>alert('This Entry Already Exists');
document.location='../departments';
</script>;
<?php
// echo "<h2>This Entry Already Exist</h2>";
// header("Location: ../departments");
// <script>alert('This Entry Already Exists');
// window.location.href='departments';
// document.location='admin/ahm/panel'</script>;
}
// echo "<h2>This Entry Already Exist</h2>";
}
header("Location: ../departments");
?>