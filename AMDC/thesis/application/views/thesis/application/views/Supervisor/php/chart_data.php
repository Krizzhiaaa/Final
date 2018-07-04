<?php
  $conn =mysqli_connect("localhost","root","", "itproject") or die('Error connecting to MySQL server.');
  $sql = "SELECT SUM(supplies.total_amount) AS 'Total Expense', supplies.supply_type FROM supplies INNER JOIN issuedsupplies USING(supply_type) GROUP BY supply_type";
  $result = $conn->query($sql);
  //initialize the array to store the processed data
  $jsonArray = array();
  //check if there is any data returned by the SQL Query
  if ($result->num_rows > 0) {
  //Converting the results into an associative array
    while($row = $result->fetch_assoc()) {
      $jsonArrayItem = array();
      $jsonArrayItem['label'] = $row['supply_type'];
      $jsonArrayItem['value'] = $row['Total Expense'];
      //append the above created object into the main array.
      array_push($jsonArray, $jsonArrayItem);
    }
  }
  //Closing the connection to DB
  $conn->close();
  //set the response content type as JSON
  // header('Content-type: application/json');
  //output the return value of json encode using the echo function. 
  echo json_encode($jsonArray);   
?>