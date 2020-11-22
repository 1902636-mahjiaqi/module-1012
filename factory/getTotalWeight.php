<?php

include_once "../_dbconn.php";

//conn for DB
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$success = true;

//check connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //Error checking for SQL
if ($conn->connect_error) {
    //$message = "Connection failed: " . $conn->connect_error;
    $message = "Error connecting to database!"; //don't print out real error
    $success = false;
} else {
    $stmt = $conn->prepare("SELECT Weightage FROM components WHERE ModID=" . $_POST['ModID']);
    //execute query and check for error at same time
    if (!$stmt->execute()) {
        $message = "Database error."; //. $conn->error;
        $success = false;
    }
    $result = $stmt->get_result();

    //check if empty
    if (!($result->num_rows > 0)) {
        echo "0";
    } else {
        //count total weightage
        $TotalWeight = 0;
        for ($a = 0; $a < $result->num_rows; $a++) {
            $arow = $result->fetch_assoc();
            $TotalWeight = $TotalWeight + $arow['Weightage'];
        }
        echo $TotalWeight;
    }


    $stmt->close(); //close right after executing
}
$conn->close();
