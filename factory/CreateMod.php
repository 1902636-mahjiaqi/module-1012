<?php
include_once "../_dbconn.php";

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO module(Title, ProfID) VALUES('". $_POST['Title']."'," . $_POST['ProfID'] . ")";

if ($conn->query($sql) === TRUE) {
  echo "Module: " . $_POST['Title'] . " Created" ;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
