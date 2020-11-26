<?php

include_once "_dbconn.php";

session_start();
$errorMsg = "";
$email = $_POST['email'];
if ($conn->connect_error) {
    $errorMsg = "Connection failed " . $conn->connect_errpr;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:adminDashboard.php");
}

else {
    $sql = "DELETE FROM accounts WHERE Email = $email";
    if ($conn->query($sql)) {
        header("Location:adminDashboard.php");
    }
}