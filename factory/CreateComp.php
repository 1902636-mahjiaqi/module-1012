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
$ModName = $_POST['CompName'];
$Weightage = $_POST['Weightage'];
$Type = $_POST['Type'];

$sql = "INSERT INTO components(Title, Weightage, ModID, subComponentStatus) VALUES('".$ModName."'," .$Weightage. "," .$ModID. ",  " .$Type. ")";

if ($conn->query($sql) === TRUE) {
    $_SESSION['CompID'] = $conn->insert_id;
    $_SESSION['CompTitle'] = $ModName;
  echo "Module: " . $_POST['CompName'] . " Created" ;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>
