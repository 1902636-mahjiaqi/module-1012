<?php

include_once "_dbconn.php";

//conn for DB
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$success = true;

//check connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //Error checking for SQL
if ($conn->connect_error) {
  //$message = "Connection failed: " . $conn->connect_error;
  $message = "Error connecting to database!"; //don't print out real error
  $success = false;
} else {

  if (empty($CompID)) {
    $stmt = $conn->prepare("SELECT * FROM class 
      INNER JOIN accounts 
      ON class.StudID = accounts.AccID");
  } 
  else {
    $stmt = $conn->prepare("SELECT * FROM class 
      INNER JOIN accounts 
      ON class.StudID = accounts.AccID
      INNER JOIN components 
      ON class.ModID = components.ModID
      INNER JOIN grades
      ON components.CompID = grades.CompID 
      AND class.StudID = grades.StudID
      WHERE grades.CompID =" . $CompID);
  }

  $stmt2 = $conn->prepare("SELECT * FROM components WHERE ModID = ". $ModID . " AND subComponentStatus = 2");

  //execute query and check for error at same time
  if (!$stmt->execute()) {
    $message = "Database error."; //. $conn->error;
    $success = false;
  }
  $result = $stmt->get_result();


  if (!($result->num_rows > 0)) {
    $errorMsg = "Table is empty.";
    $success = false;
  }
  $stmt->close(); //close right after executing

  $stmt2->execute();
  $subResult = $stmt2->get_result();
  
}
$conn->close();