<?php

include_once "_dbconn.php";

session_start();

$coins = $_POST['coinsFromAjax'];
$data = $_POST['buildingsData'];
$ID = $_POST['ID'];
$sql = "INSERT INTO game (AccID, coins, data) VALUES ($ID, $coins, '$data') ON DUPLICATE KEY UPDATE coins = $coins, data = '$data'";
$conn->query($sql);
echo "Success!";


?>