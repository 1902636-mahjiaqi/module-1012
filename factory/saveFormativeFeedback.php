<?php
include_once __DIR__ .  "/../_dbconn.php";

$sql = "INSERT INTO feedback (StudID, FeedbkType, Comments, ModID, CompID, Publish) 
VALUES (00000000, 1, " . "'" . $_POST['comments'] . "'" . ", " . $_POST['ModID'] . ", " . $_POST['CompID'] . ", 1) ON DUPLICATE KEY UPDATE Comments ='" .$_POST['comments']. "'";

if ($conn->query($sql) === TRUE) {
  echo "Formative Feedback Saved";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();