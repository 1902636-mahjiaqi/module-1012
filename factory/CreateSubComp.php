<?php
include_once "../_dbconn.php";
session_start();

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$ModID = $_POST['ModID'];
$Weightage = $_POST['Weightage'];
$Type = $_POST['Type'];
$CompName = $_POST['CompName'];
$CompID = $_POST['CompID'];

$sql = "INSERT INTO components(Title, Weightage, ModID, subComponentStatus, MainCompID) VALUES('".$CompName."'," .$Weightage. "," .$ModID. ", 2, ".$CompID." )";
$sql2 = "UPDATE components SET subComponentStatus=1, Weightage=0 WHERE CompID=".$CompID;
$conn->query($sql2);

if ($conn->query($sql) === TRUE) {
  echo "SubComponent: " . $_POST['CompName'] . " Created" ;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>
