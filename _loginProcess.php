<?php

include_once "_dbconn.php";
include_once "factory/usersFactory.php";
include_once "factory/usersClass.php";

session_start();

$errorMsg = $password = $email = "";
$success = true;

if (empty($_POST["loginUser"])) {
  $errorMsg .= "Email is required";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:index.php");
}

else {
  $email = sanitize_input($_POST["loginUser"]);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg .= "Invalid email format. <br>";
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:index.php");
  }

  else if (!preg_match('/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/', $email)) {
    $errorMsg .= "Invalid email format. <br>";
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:index.php");
  }
}

if (empty($_POST['password'])) {
  $errorMsg .= "Password is required. <br>";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:index.php");
}

else {
  $password = sanitize_input($_POST["password"]);
  if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,15}$/', $password)) {
    $errorMsg .= "Invalid password format.<br>";
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:index.php");
  }
}

if ($success == true) {
  if ($conn->connect_error) {
    $errorMsg = "Connection failed " . $conn->connect_error;
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:index.php");
  }

  else {
    $sql = "SELECT * FROM accounts WHERE Email = '$email' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $result->free_result();
      $user = $row['AccID'];
      
      $_SESSION['sessionToken'] = usersFactory::createUser($row);
      $_SESSION['status'] = time();
      $_SESSION['AcType'] = $_SESSION['sessionToken']->getUserType();
      $_SESSION['UserNum'] = $_SESSION['sessionToken']->getUser();
      $_SESSION['AcName'] = $_SESSION['sessionToken']->getName();
      if ($_SESSION['sessionToken']->getUserType() == 0) {
        header('Location:adminDashboard.php');
      }
      
      else if ($_SESSION['sessionToken']->getUserType() == 1) {
        header('Location:professorDashboard.php');
      }

      else if ($_SESSION['sessionToken']->getUserType() == 2) {
        $sql3 = "SELECT data FROM game WHERE AccID = '" .$_SESSION['sessionToken']->getUser(). "'";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows == 1) {
          $row3 = $result3->fetch_assoc();
          $result3->free_result();
          $_SESSION['sessionToken']->setData($row3['data']);
        }
        else {
          $data = "";
        }
        header('Location:studDashboard.php' .$_SESSION['sessionToken']->getData());
      }
    }

    else {
      $errorMsg .= "Email not found or password doesn't match. <br>";
      $success = false;
      $_SESSION['errorMsg'] = $errorMsg;
      header("Location:index.php");
    }
  }
  unset($row);
  $conn->close();
}


function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}