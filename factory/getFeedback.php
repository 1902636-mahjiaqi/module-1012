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
    $CurrUser = $_SESSION['UserNum'];
    $stmt = $conn->prepare("SELECT * 
        FROM (SELECT DISTINCT g.CompID AS MainID, g.StudID, g.Grade, c.Title As CTitle, m.Title AS MTitle, g.Publish 
        FROM grades g 
        INNER JOIN components c 
                ON c.CompID = g.CompID
        INNER JOIN module m
                ON c.ModID = m.ModID
        WHERE g.Publish = 1 AND g.StudID=".$CurrUser.") p
        LEFT JOIN feedback f
	ON p.StudID = f.StudID AND p.MainID = f.CompID;");

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
  
}
