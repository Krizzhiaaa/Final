<?php
$conn =mysqli_connect("localhost","root","");
                    mysqli_select_db($conn, "itproject");
                    $sql2 = "DELETE FROM logs WHERE log_description='{$_POST['log_description']}' LIMIT 1";
                    $result2 = $conn->query($sql2);
?>
<?php
if ($result2 == 1) { 
//if it updated
?>

            <strong>Notification Has Been Deleted</strong>

<?php
 } else { 
//if it failed
?>

            <strong>Deletion Failed</strong>


<?php
} 
?>

