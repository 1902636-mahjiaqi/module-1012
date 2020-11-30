<!DOCTYPE html>
<html>

<body>
    <form enctype="multipart/form-data" method="post" role="form">
        <!-- <label>Upload Class List</label><br> -->
        <input type="file" name="file" id="file" size="150">
        <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
    </form>
</body>

</html>

<?php
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
    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
        $StudID = $filesop[0];
        $StudName = $filesop[1];
        $StudEmail = $filesop[2];
        $StudPass = $filesop[3];
        $sql = "INSERT INTO accounts 
          VALUES ('$StudID', '$StudName', '$StudEmail', '$StudPass', 2)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);

        if (!$stmt->execute()) {
            $message = "Database error."; //. $conn->error;
            $success = false;

            $stmt->close(); //close right after executing

            // $sql2 ="INSERT INTO grades (CompID, StudID, Publish)
            // VALUES ($_POST['CompID'], '$StudID', 0)";
            // $stmt2 = mysqli_prepare($conn, $sql2);
            // mysqli_stmt_execute($stmt2);

            $c = $c + 1;
        }
    }
}
?>