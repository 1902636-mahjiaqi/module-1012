<!-- <!DOCTYPE html>
<html>

<body>
    <form enctype="multipart/form-data" method="post" role="form">
        <input type="file" name="file" id="file" size="150">
        <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
    </form>
</body>

</html> -->

<?php

session_start();

$ModID = $_SESSION['ModID'];
$_SESSION['error'] = 0;

if (isset($_POST["submit"])) {


    define("DBHOST", "rm-gs595dd89hu8175hl6o.mysql.singapore.rds.aliyuncs.com");
    define("DBNAME", "sql1902686twr");
    define("DBUSER", "ict1902686twr");
    define("DBPASS", "RWT6862091");

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_errno());
    }

    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $c = 1;

    $extension = pathinfo($file, PATHINFO_EXTENSION);
    if ($extension != "csv") {
        $_SESSION['error'] = 1;
        header('Location:manageCL.php');
    }

    else {
        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
            $StudID = $filesop[0];
            $StudName = $filesop[1];
            $StudEmail = $filesop[2];
            $StudPass = $filesop[3];
            $stmt = $conn->prepare("INSERT INTO accounts 
            VALUES ('$StudID', '$StudName', '$StudEmail', '$StudPass', 2)");
            $stmt->execute();

            $stmt2 = $conn->prepare("INSERT INTO game (AccID, coins)
            VALUES ('$StudID', 0)");
            $stmt2->execute();

            $stmt3 = $conn->prepare("INSERT INTO class (ModID, StudID, TotalCoins)
            VALUES ($ModID, '$StudID', 0)");
            $stmt3->execute();

            $stmt4 = $conn->prepare("SELECT * FROM components WHERE ModID = " . $ModID . " AND MainCompID IS NOT NULL");
            $stmt4->execute();
            $result = $stmt4->get_result();

            for ($i = 0; $i < $result->num_rows; $i++) {

                $row = $result->fetch_assoc();
                $thisCompID = $row['CompID'];
                //for loop to find number of subcomponents in module
                $stmt5 = $conn->prepare("INSERT INTO grades (CompID, StudID, Grade, Publish)
                VALUES ($thisCompID, '$StudID', 0, 0)");
                $stmt5->execute();

                //for loop to find number of subcomponents in module
                $stmt6 = $conn->prepare("INSERT INTO feedback (FeedbkType, StudID, ModID, CompID, Publish)
                VALUES (2, '$StudID', $ModID, $thisCompID, 0)");
                $stmt6->execute();
            }

            if (!$stmt->execute()) {
                $message = "Database error."; //. $conn->error;
                $success = false;
            }

            $c = $c + 1;
        }        
    $stmt->close(); //close right after executing
    $stmt2->close(); //close right after executing
    $stmt3->close(); //close right after executing
    $stmt4->close(); //close right after executing
    $stmt5->close(); //close right after executing
    $stmt6->close(); //close right after executing
    header('Location:manageCL.php');
    }
}

else {
    echo "Error";
}
?>