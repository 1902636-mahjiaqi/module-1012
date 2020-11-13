<?php

define("DBHOST", "rm-gs595dd89hu8175hl6o.mysql.singapore.rds.aliyuncs.com");
define("DBNAME", "sql1902686twr");
define("DBUSER", "ict1902686twr");
define("DBPASS", "RWT6862091");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if(!$conn) {
  die('Could not connect: ' . mysqli_connect_errno());
}


?>