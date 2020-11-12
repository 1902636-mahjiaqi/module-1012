<?php

define("DBHOST", "sql12.freemysqlhosting.net");
define("DBNAME", "sql12374841");
define("DBUSER", "sql12374841");
define("DBPASS", "GBpfzhtYQ5");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if(!$conn) {
  die('Could not connect: ' . mysqli_connect_errno());
}


?>