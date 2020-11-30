<?php
include_once __DIR__ .  "/../_dbconn.php";

$sql = "UPDATE grades 
SET Publish = 1 
WHERE CompID =" . $_POST['CompID'];

if ($conn->query($sql) === TRUE) {
  echo "Grade Sucessfully Published";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();