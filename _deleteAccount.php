<?php

include_once "_dbconn.php";
$errorMsg = "";
$accID = $_POST['ID'];
echo $email;
$sql = "DELETE FROM accounts WHERE AccID = $accID";
$conn->query($sql);
echo "success";

if ($conn->connect_error) {
    $errorMsg = "Connection failed " . $conn->connect_errpr;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:adminDashboard.php");
   	echo "<script> alert('test') </script>";

}

else {
    $sql = "DELETE FROM accounts WHERE AccID = $accID";
    if ($conn->query($sql)) {
        header("Location:adminDashboard.php");
    }
}

?>