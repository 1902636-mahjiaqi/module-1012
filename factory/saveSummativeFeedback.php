<?php
include_once "../_dbconn.php";

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO feedback (FeedbkType, Comments, StudID, ModID, CompID, Publish)
VALUES (2, \'" . $_POST['comments'] . "', " . $_POST['StudID'] . ", " . $_POST['ModID'] . ", " . $_POST['CompID'] . ", 0)";

if ($conn->query($sql) === TRUE) {
  echo "Summative Feedback Saved";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();