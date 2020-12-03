<?php
include_once __DIR__ .  "/../_dbconn.php";

$grades = $_POST['grades'];
$studID = $_POST['StudID'];
$compID = $_POST['CompID'];

$sql = "INSERT INTO grades(StudID, Grade, CompID) VALUES ($studID, $grades, $compID) ON DUPLICATE KEY UPDATE Grade = $grades";

if ($conn->query($sql)) {
  echo "Grades Updated";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();