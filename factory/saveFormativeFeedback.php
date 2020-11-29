<?php
include_once __DIR__ .  "/../_dbconn.php";

$sql = "INSERT INTO feedback (FeedbkType, Comments, ModID, CompID, Publish) 
VALUES (1, " . "'" . $_POST['comments'] . "'" . ", " . $_POST['ModID'] . ", " . $_POST['CompID'] . ", 0)";

if ($conn->query($sql) === TRUE) {
  echo "Formative Feedback Saved";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();