<?php
$value = $_POST['log_description'];
$idvalue = $_POST['log_id'];
$converted = urldecode($value);
$conn =mysqli_connect("localhost","root","");
                    mysqli_select_db($conn, "itproject");
                    $sql2 = "UPDATE logs SET log_status = false WHERE log_description='".$converted."' AND log_id ='".$idvalue."' LIMIT 1";
                    $result2 = $conn->query($sql2);
?>
<?php
if ($result2 == 1) { 
//if it updated
            header('Location: ' . $_SERVER['HTTP_REFERER']); /* Redirect browser */
            exit();
} else { 
//if it failed

            header('Location: ' . $_SERVER['HTTP_REFERER']); /* Redirect browser */
            exit();
} 
?>