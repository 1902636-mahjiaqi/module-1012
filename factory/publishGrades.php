<?php
include_once __DIR__ .  "/../_dbconn.php";

session_start();

$CompID = $_POST['CompID'];
$students = $_POST['students'];
$success = 1;

for ($i = 0; $i < count($students); $i++) {
	$sql = "UPDATE grades SET Publish = 1 WHERE CompID = $CompID and StudID = $students[$i]";
	if (!($conn->query($sql))) {
		$success = 0;
	}
}

if ($success = 0) {
	echo "ERROR";
}

$conn->close();