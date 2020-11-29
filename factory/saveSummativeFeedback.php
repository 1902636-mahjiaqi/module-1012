<?php
include_once __DIR__ .  "/../_dbconn.php";

$sql = "INSERT INTO feedback (FeedbkType, Comments, StudID, ModID, CompID, Publish)
VALUES (2, '" . $_POST['comments'] . "', " . $_POST['StudID'] . ", " . $_POST['ModID'] . ", " . $_POST['CompID'] . ", 0)";

if ($conn->query($sql)) {
  echo "Summative Feedback Saved";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();