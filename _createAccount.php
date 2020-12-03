<?php

include_once "_dbconn.php";

session_start();

$errorMsg = "";
$success = true;
if (empty($_POST["accountID"])) {
	$errorMsg .= "Account ID is required";
	$success = false;
	$_SESSION['errorMsg'] = $errorMsg;
	header("Location:adminDashboard.php");
}

else {
	$accID = $_POST["accountID"];
}

if (empty($_POST["name"])) {
	$errorMsg .= "Name is required";
	$success = false;
	$_SESSION['errorMsg'] = $errorMsg;
	header("Location:adminDashboard.php");
}

else {
	$name = $_POST["name"];
}

if (empty($_POST["email"])) {
	$errorMsg .= "Email is required";
	$success = false;
	$_SESSION['errorMsg'] = $errorMsg;
	header("Location:adminDashboard.php");
}

else {
  $email = sanitize_input($_POST["email"]);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg .= "Invalid email format. <br>";
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:adminDashboard.php");
  }

   else if (!preg_match('/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/', $email)) {
    $errorMsg .= "Invalid email format. <br>";
    $success = false;
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location:adminDashboard.php");
  }

  else {
	$email = $_POST["email"];
  }
}

if (empty($_POST['password'])) {
  $errorMsg .= "Password is required. <br>";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:adminDashboard.php");
}

if (empty($_POST['cfmPassword'])) {
  $errorMsg .= "Confirm password is required. <br>";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:adminDashboard.php");
}

if ($_POST['password'] != $_POST['cfmPassword']) {
  $errorMsg .= "Passwords does not match. <br>";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:adminDashboard.php");
}

else {
  $password = sanitize_input($_POST["password"]);
  if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,15}$/', $password)) {
  $errorMsg .= "Invalid password format.<br>";
  $success = false;
  $_SESSION['errorMsg'] = $errorMsg;
  header("Location:adminDashboard.php");
 }
}

if ($success == true) {
	if ($conn->connect_error) {
		$errorMsg = "Connection failed " . $conn->connect_error;
		$success = false;
		$_SESSION['errorMsg'] = $errorMsg;
		header("Location:adminDashboard.php");
	}

	else {
		$checkEmail = "SELECT * FROM accounts WHERE Email = '$email'";
		$checkEmailResult = $conn->query($checkEmail);
		if ($checkEmailResult->num_rows > 0) {
			$errorMsg = "Email already exists";
			$_SESSION['errorMsg'] = $errorMsg;
			header("Location:adminDashboard.php");
		}

		$checkID = "SELECT * FROM accounts WHERE AccID = $accID";
		$checkIDResult = $conn->query($checkID);
		if ($checkIDResult->num_rows > 0) {
			$errorMsg = "Account ID already exists";
			$_SESSION['errorMsg'] = $errorMsg;
			header("Location:adminDashboard.php");
		}
		else {
			$sql = "INSERT INTO accounts (AccID, Name, Email, Password, AccType) VALUES ($accID, '$name', '$email', '$password', 1)";
			$result = $conn->query($sql);

			if ($result) {
				$_SESSION['success'] = 1;
                echo "<script> alert('Account Created successfully');</script>";
                header("Location:adminDashboard.php");
			}
			else {
                                $_SESSION['errorMsg'] = $errorMsg;
				header("Location:adminDashboard.php");
			}			
		}


	}
}

function sanitize_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}