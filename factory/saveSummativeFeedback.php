<?php
include_once __DIR__ .  "/../_dbconn.php";

$comments = $_POST['comments'];
$studID = $_POST['StudID'];
$modID = $_POST['ModID'];
$compID = $_POST['CompID'];

$sql = "INSERT INTO feedback(FeedbkType, Comments, StudID, ModID, CompID, Publish) VALUES (2, '$comments', $studID, $modID, $compID, 0) ON DUPLICATE KEY UPDATE Comments = '$comments', Publish = 0";
// $sql = "INSERT INTO feedback (FeedbkType, Comments, StudID, ModID, CompID, Publish)
// VALUES (2, '" . $_POST['comments'] . "', " . $_POST['StudID'] . ", " . $_POST['ModID'] . ", " . $_POST['CompID'] . ", 0)";

if ($conn->query($sql)) {
  echo "Summative Feedback Saved";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
