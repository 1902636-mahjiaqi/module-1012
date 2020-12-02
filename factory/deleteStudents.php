<?php
include_once __DIR__ .  "/../_dbconn.php";

session_start();

$ModID = $_POST['ModID'];
$students = $_POST['students'];
$success = 1;

$sql = "SELECT CompID FROM components WHERE ModID = $ModID";
$result = $conn->query($sql);

for ($i = 0; $i < $result->num_rows; $i++) {
	$row = $result->fetch_assoc();
	$CompID = $row['CompID'];
	for ($x = 0; $x < count($students); $x++) {
		$sql0 = "DELETE FROM grades WHERE CompID = $CompID AND StudID = $students[$x];";
		$sql1 = "DELETE FROM feedback WHERE CompID = $CompID AND StudID = $students[$x];";

		$conn->query($sql0);
		$conn->query($sql1);
	}
}


$conn->close();