<?php
  
include_once "_dbconn.php";

//conn for DB
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$success = true;

//check connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);//Error checking for SQL
  if ($conn->connect_error) {
      //$message = "Connection failed: " . $conn->connect_error;
      $message = "Error connecting to database!"; //don't print out real error
      $success = false;
  } else {
      $stmt = $conn->prepare("SELECT * FROM  sql1902686twr.components WHERE ModID=". $ModID);
      $stmt2 = $conn->prepare("SELECT * FROM  sql1902686twr.components WHERE ModID=". $ModID);
      //execute query and check for error at same time
      if (!$stmt->execute()) {
          $message = "Database error."; //. $conn->error;
          $success = false;
      }
      $result = $stmt->get_result();
      $stmt2->execute();
      $subResult = $stmt2->get_result();
      
      if (!($result->num_rows > 0)) {
        $errorMsg = "Table is empty.";
        $success = false;
        }
      $stmt->close(); //close right after executing
      
  }
$conn->close();
