<?php
include_once "../_dbconn.php";

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$CompID = $_POST['CompID'];
$sql = "DELETE FROM components WHERE CompID=" . $CompID;

if ($conn->query($sql) === TRUE) {
  echo "Record Deleted";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
