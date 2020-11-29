<?php

include_once "_dbconn.php";
$errorMsg = "";
$accID = $_POST['ID'];
$sql = "DELETE FROM accounts WHERE AccID = $accID";
$conn->query($sql);



?>