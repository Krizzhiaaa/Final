<?php
     $conn =mysqli_connect("localhost","root","");
    mysqli_select_db($conn, "itproject");
      $sql = "SELECT * FROM supplies";
      $results = mysqli_query($conn, $sql);

      foreach($results as $department) { 
    ?>
    <option value="<?php echo $department["supply_description"]; ?>" name="desc"><?php echo $department["supply_description"]; ?></option>
    <?php 
      }
    ?>